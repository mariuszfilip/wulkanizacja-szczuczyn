<?php
class PaymentCollection extends DBObjectsCollection {

  protected $sql = '';
  protected $sql_conditions = '';
  protected $sql_order = '';
  protected $s = null;
  protected $xml = '';
  protected $total = 0;
  protected $field_type = array (
			"txn_id"=>"text",
			"payer_email"=>"varchar(255)",
			"mc_gross_1"=>"float(10,2)",
			"added"=>"timestamp",
			"active"=>"enum(\'1\',\'2\',\'3\')"
	);
  private $field_align = array ( # wyśrodkowanie wybanych pól jeśli automatyczne komuś nie pasi [ left | right | center ] CDN...
			"txn_id"=>"",
			"payer_email"=>"",
			"mc_gross_1"=>"right",
			"added"=>"center",
			"active"=>""
	);
  
  public function __construct( $page, $sort ) {
    $this->sql_order = $sort;    
    parent::__construct( $page );
  }
  
  protected function setSql( $_sql_conditions = '') {
    $this->sql = 'SELECT txn_id,payer_email, 
					CONCAT(`payment`.`mc_gross_1`,\' $\') AS `mc_gross_1_value`,
					added,active,id_payment 
					FROM payment
  	        WHERE deleted=\'N\' ' . $_sql_conditions . '';
  }
  
  protected function getSql() {
    return $this->sql;
  }

  protected function setSqlConditions( $s_arr ) {
	  
	  
	  if( trim( $s_arr['txn_id'] ) != '' )
		{
			$m_arr = array();
			$m_arr = explode(" ", trim( $s_arr['txn_id'] ) );
			for( $i = 0; $i < count( $m_arr ); $i ++ )
			{
				$m = trim( $m_arr[ $i ] );
				if( $m != '' )
				{
					$this->sql_conditions .= ' AND `payment`.`txn_id` LIKE \'%'.$m.'%\' ';
				}
			}
		}
		
		
		if( trim( $s_arr['payer_email'] ) != '' )
		{
			$m_arr = array();
			$m_arr = explode(" ", trim( $s_arr['payer_email'] ) );
			for( $i = 0; $i < count( $m_arr ); $i ++ )
			{
				$m = trim( $m_arr[ $i ] );
				if( $m != '' )
				{
					$this->sql_conditions .= ' AND `payment`.`payer_email` LIKE \'%'.$m.'%\' ';
				}
			}
		}	  
	  
	  
	  if( trim( $s_arr['price_from'] ) != '' )
		{
			$this->sql_conditions .= ' AND `payment`.`mc_gross_1` >= \''.$s_arr['price_from'].'\' ';
		}

		if( trim( $s_arr['price_to'] ) != '' )
		{
			$this->sql_conditions .= ' AND `payment`.`mc_gross_1` <= \''.$s_arr['price_to'].'\' ';
		}
		
		
		
		if( $s_arr[ 'date_from' ] != '') {
        $this->sql_conditions .= 'AND `payment`.`added`>=\''. $s_arr[ 'date_from' ] .'\'';
      }
      if( $s_arr[ 'date_to' ] != '') {
        $this->sql_conditions .= 'AND `payment`.`added`<=\''. $s_arr[ 'date_to' ] .' 23:59:59\'';
      }
	  
	  
	  if( trim( $s_arr['payed'] ) != '' )
	{
		$this->sql_conditions .= 'AND `payment`.`active` = \'' . $s_arr['payed'] . '\'';
	}
	
		
  }

  protected function setSqlOrder( $s_arr = "") {
    if( !empty( $this->sql_order ) ) {
      $this->sql_order = ' ORDER BY ' . $this->sql_order;
    } else {
      $this->sql_order = '';
    }
  }

  protected function getSqlConditions() {
    return $this->sql_conditions;
  }

  protected function load() {
  
    $this->setSqlOrder();
    $s = Session::getInstance();
    if( $s->is_set( 's_payment' ) ) {
      $this->setSqlConditions( $s->getAttribute( 's_payment' ) );
    }
    $this->setSql( $this->getSqlConditions() );
    
    $stmt = $this->DB->query( $this->getSql() );
    if( (int)$stmt ){
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
      $this->total = count( $rows );
    }
        
    $this->xml = '<?xml version="1.0" encoding="UTF-8"?>';
    
    $this->xml .= '<records total="'.$this->total.'" maxPerPage="'.$this->rows_per_view.'" page="'.$this->current.'">'; 
    
    $this->xml .= '<type>';
    foreach( $this->field_type as $k => $v ) {
      if( (int)( substr_count($v, "enum") ) > 0 ) {
        $v = "enum";
      } elseif (  (int)( substr_count($v, "varchar") ) > 0 ) {
        $v = 'varchar';
      } elseif (  (int)( substr_count($this->table_fields_type[$v], "int") ) > 0 ) {
        $v = 'int';
      }
      if($this->field_align[$k]) $align = ' align="'.$this->field_align[$k].'"'; else $align=''; # wyśrodkowacnie CD (w następnej lini $align i wsyo!)
      $this->xml .= '<' . $k . $align . '>' . $v . '</' . $k . '>';
    }
    $this->xml .= '</type>';
    
	$this->from = $this->rows_per_view * $this->current;
	
    $stmt = $this->DB->query( $this->getSql() . $this->sql_order . ' LIMIT ' . $this->from . ',' . $this->rows_per_view );
    if((int)$stmt){
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
      
      foreach ( $rows as $k) {
	  
	  //$zamien = array("&" => "&amp;", ">" => "&gt;", "<" => "&lt;");
	  //$zamien2 = array('&amp;lt;' => '&lt;', '&amp;gt;' => '&gt;', '&amp;amp;' => '&amp;', '&amp;nbsp;' => '&nbsp;', '&amp;ograve;' => '&ograve;', '&amp;euro;' => '&euro;', '&amp;laquo;' => '&laquo;', '&amp;raquo;' => '&raquo;' );
	   switch($k['active']) {
      		case 1:
       			$k['active'] = '<img src="./css/img/mark-red.gif" alt="" />';
        		break;
			case 2:
       			$k['active'] = '<img src="./css/img/mark-orange.gif" alt="" />';
        		break;
			case 3:
       			$k['active'] = '<img src="./css/img/mark-green.gif" alt="" />';
        		break;
			default:
        		$k['active'] = '<img src="./css/img/mark-red.gif" alt="" />';;
        		break;
	   }
	  
        $this->xml .= '<record>';
        foreach ( $k as $Index=>$Value ) {
          //list($Index,$Value)=each($k);
		  if(!$Value) $Value='<span style="color:#CCCCCC;">[ brak ]</span>';
		  //$Value = strtr($Value, $zamien);
		  //$Value = strtr($Value, $zamien2);
          $this->xml .= '<'.$Index.'><![CDATA['.$Value.']]></'.$Index.'>';
        }
        $this->xml .= '</record>';
      }
      
    }
    $this->xml .= '</records>';
    
    
    
  }
  
  public function getXML() {
    return $this->xml;
  }

}
?>