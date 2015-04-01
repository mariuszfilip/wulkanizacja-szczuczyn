<?php
class ServiceCollection extends DBObjectsCollection {

  protected $sql = '';
  protected $sql_conditions = '';
  protected $sql_order = '';
  protected $s = null;
  protected $xml = '';
  protected $total = 0;
  protected $field_type = array (
			"catalog_name"=>"varchar(255)",
			"name"=>"varchar(255)",
			"price"=>"float(10,2)",
			"active"=>"enum(\'Y\',\'N\')"
	);
  private $field_align = array ( # wyśrodkowanie wybanych pól jeśli automatyczne komuś nie pasi [ left | right | center ] CDN...
			"catalog_name"=>"",
			"name"=>"",
			"price"=>"right",
			"active"=>""
	);
  
  public function __construct( $page, $sort ) {
    $this->sql_order = $sort;    
    parent::__construct( $page );
  }
  
  protected function setSql( $_sql_conditions = '') {
    $this->sql = 'SELECT `catalog`.`name` AS `catalog_name`, `service`.`name`, CONCAT(`service`.`price`,\' $\') AS `price_value`,`service`.`active`, `service`.`id_service` 
			FROM `service`
			LEFT JOIN `catalog` USING(id_catalog)
  	        WHERE `service`.`deleted`=\'N\' ' . $_sql_conditions . '';
  }
  
  protected function getSql() {
    return $this->sql;
  }

  protected function setSqlConditions( $s_arr ) {
	  if( trim( $s_arr['active'] ) != '' )
		{
			$this->sql_conditions .= 'AND `service`.`active` = \'' . $s_arr['active'] . '\'';
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
					$this->sql_conditions .= ' AND `service`.`name` LIKE \'%'.$m.'%\' ';
				}
			}
		}
		
		if( trim( $s_arr['catalog_name'] ) != '' )
		{
			$m_arr = array();
			$m_arr = explode(" ", trim( $s_arr['catalog_name'] ) );
			for( $i = 0; $i < count( $m_arr ); $i ++ )
			{
				$m = trim( $m_arr[ $i ] );
				if( $m != '' )
				{
					$this->sql_conditions .= ' AND `catalog`.`name` LIKE \'%'.$m.'%\' ';
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
    if( $s->is_set( 's_service' ) ) {
      $this->setSqlConditions( $s->getAttribute( 's_service' ) );
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
	  
	  $zamien = array("&" => "&amp;", ">" => "&gt;", "<" => "&lt;");
	  $zamien2 = array('&amp;lt;' => '&lt;', '&amp;gt;' => '&gt;', '&amp;amp;' => '&amp;', '&amp;nbsp;' => '&nbsp;', '&amp;ograve;' => '&ograve;', '&amp;euro;' => '&euro;', '&amp;laquo;' => '&laquo;', '&amp;raquo;' => '&raquo;' );
	  
	  
        $this->xml .= '<record>';
        foreach ( $k as $v ) {
          list($Index,$Value)=each($k);
		  if(!$Value) $Value='<span style="color:#CCCCCC;">[ brak ]</span>';
		  $Value = strtr($Value, $zamien);
		  $Value = strtr($Value, $zamien2);
          $this->xml .= '<'.$Index.'>'.$Value.'</'.$Index.'>';
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