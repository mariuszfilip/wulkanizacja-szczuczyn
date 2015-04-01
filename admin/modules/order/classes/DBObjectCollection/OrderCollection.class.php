<?php
class OrderCollection extends DBObjectsCollection {

  protected $sql = '';
  protected $sql_conditions = '';
  protected $sql_order = '';
  protected $s = null;
  protected $xml = '';
  protected $total = 0;
  protected $field_type = array (
			"service"=>"varchar(255)",
			"name"=>"varchar(255)",
			"email"=>"varchar(255)",
			"phone"=>"varchar(255)",
			"prepayment"=>"float(10,2)",
			"price"=>"float(10,2)",
			"added"=>"timestamp",
			"active"=>"enum('Y','N')",
			"payed"=>"enum('Y','N')"
	);
  private $field_align = array ( # wyśrodkowanie wybanych pól jeśli automatyczne komuś nie pasi [ left | right | center ] CDN...
			"service_name"=>"",
			"name"=>"",
			"email"=>"",
			"phone"=>"",
			"prepayment"=>"right",
			"price"=>"right",
			"added"=>"center",
			"active"=>"",
			"payed"=>""
	);
  
  public function __construct( $page, $sort ) {		
    $this->sql_order = $sort;    
    parent::__construct( $page );
  }
  
  protected function setSql( $_sql_conditions = '') {
    $this->sql = 'SELECT `service`.`name` AS `service`,
						`order`.`name`,
						`order`.`email`,
						`order`.`phone`,
						CONCAT(`order`.`price`,\' $\') AS `prepayment_value`,
						CONCAT(`service`.`price`,\' $\') AS `price_value`,
						SUBSTRING(`order`.`added`,1,16) AS `added`,
						`order`.`active` AS `order_active`,
						`payment`.`active` AS `payed`,
						`order`.`id_order`
					FROM `order`
					LEFT JOIN `service` USING(`id_service`)
					LEFT JOIN `payment` ON(`payment`.`id_order`=`order`.`id_order` AND `payment`.`deleted`<>\'Y\')
  	        WHERE `order`.`deleted`=\'N\'
			
			' . $_sql_conditions . '  GROUP BY `order`.`id_order`';
  }
  
  protected function getSql() {
    return $this->sql;
  }

  protected function setSqlConditions( $s_arr ) {
	if( trim( $s_arr['active'] ) != '' )
	{
		$this->sql_conditions .= 'AND `order`.`active` = \'' . $s_arr['active'] . '\'';
	}
	
	if( trim( $s_arr['payed'] ) != '' )
	{
		$this->sql_conditions .= 'AND `payment`.`active` = \'' . $s_arr['payed'] . '\'';
	}
	
	if( trim( $s_arr['name'] ) != '' )
		{
			$m_arr = array();
			$m_arr = explode(" ", trim( $s_arr['name'] ) );
			for( $i = 0; $i < count( $m_arr ); $i ++ )
			{
				$m = trim( $m_arr[ $i ] );
				if( $m != '' )
				{
					$this->sql_conditions .= ' AND `order`.`name` LIKE \'%'.$m.'%\' ';
				}
			}
		}
		
		if( trim( $s_arr['service'] ) != '' )
		{
			$m_arr = array();
			$m_arr = explode(" ", trim( $s_arr['service'] ) );
			for( $i = 0; $i < count( $m_arr ); $i ++ )
			{
				$m = trim( $m_arr[ $i ] );
				if( $m != '' )
				{
					$this->sql_conditions .= ' AND `service`.`name` LIKE \'%'.$m.'%\' ';
				}
			}
		}
		
		
		if( trim( $s_arr['email'] ) != '' )
		{
			$m_arr = array();
			$m_arr = explode(" ", trim( $s_arr['email'] ) );
			for( $i = 0; $i < count( $m_arr ); $i ++ )
			{
				$m = trim( $m_arr[ $i ] );
				if( $m != '' )
				{
					$this->sql_conditions .= ' AND `order`.`email` LIKE \'%'.$m.'%\' ';
				}
			}
		}
		
		if( trim( $s_arr['phone'] ) != '' )
		{
			$m_arr = array();
			$m_arr = explode(" ", trim( $s_arr['phone'] ) );
			for( $i = 0; $i < count( $m_arr ); $i ++ )
			{
				$m = trim( $m_arr[ $i ] );
				if( $m != '' )
				{
					$this->sql_conditions .= ' AND `order`.`phone` LIKE \'%'.$m.'%\' ';
				}
			}
		}
		
		
		
		if( trim( $s_arr['price_from'] ) != '' )
		{
			$this->sql_conditions .= ' AND `service`.`price` >= \''.$s_arr['price_from'].'\' ';
		}

		if( trim( $s_arr['price_to'] ) != '' )
		{
			$this->sql_conditions .= ' AND `service`.`price` <= \''.$s_arr['price_to'].'\' ';
		}
		
		
		if( trim( $s_arr['order_price_from'] ) != '' )
		{
			$this->sql_conditions .= ' AND `order`.`price` >= \''.$s_arr['order_price_from'].'\' ';
		}

		if( trim( $s_arr['order_price_to'] ) != '' )
		{
			$this->sql_conditions .= ' AND `order`.`price` <= \''.$s_arr['order_price_to'].'\' ';
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
    if( $s->is_set( 's_order' ) ) {
		
      $this->setSqlConditions( $s->getAttribute( 's_order' ) );
    }
    $this->setSql( $this->getSqlConditions() );
    
	//echo $this->getSql(); die;
	
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
		  
		  switch($k['payed']) {
      		case 1:
       			$k['payed'] = '<img src="./css/img/mark-red.gif" alt="" />';
        		break;
			case 2:
       			$k['payed'] = '<img src="./css/img/mark-orange.gif" alt="" />';
        		break;
			case 3:
       			$k['payed'] = '<img src="./css/img/mark-green.gif" alt="" />';
        		break;
			default:
        		$k['payed'] = '<img src="./css/img/mark-red.gif" alt="" />';;
        		break;
	   }
	  
	  //$zamien = array("&" => "&amp;", ">" => "&gt;", "<" => "&lt;");
	  //$zamien2 = array('&amp;lt;' => '&lt;', '&amp;gt;' => '&gt;', '&amp;amp;' => '&amp;', '&amp;nbsp;' => '&nbsp;', '&amp;ograve;' => '&ograve;', '&amp;euro;' => '&euro;', '&amp;laquo;' => '&laquo;', '&amp;raquo;' => '&raquo;' );
	  
	  
        $this->xml .= '<record>';
        foreach ( $k as $Index=>$Value ) {
          //list()=each($k);
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