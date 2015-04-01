<?php
class Smtp_accountCollection extends DBObjectsCollection {

  protected $sql = '';
  protected $sql_conditions = '';
  protected $sql_order = '';
  protected $s = null;
  protected $xml = '';
  protected $total = 0;
  protected $field_type = array (
			"mail"=>"varchar(255)",
			"host"=>"varchar(255)",
			"user"=>"varchar(255)",
			"default"=>"enum('Y','N')"
	);
  private $field_align = array ( # wyśrodkowanie wybanych pól jeśli automatyczne komuś nie pasi [ left | right | center ] CDN...
			"mail"=>"left",
			"host"=>"left",
			"user"=>"left",
			"default"=>"center"
	);
  
  public function __construct( $page, $sort ) {
    $this->sql_order = $sort;    
    parent::__construct( $page );
  }
  
  protected function setSql( $_sql_conditions = '') {
    $this->sql = 'SELECT `mail`,`host`,`user`, `default`, `id_smtp_account` FROM `smtp_account`
  	        WHERE `deleted`=\'N\' ' . $_sql_conditions . '';
  }
  
  protected function getSql() {
    return $this->sql;
  }

  protected function setSqlConditions( $s_arr ) {

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
    if( $s->is_set( 's_smtp_account' ) ) {
      $this->setSqlConditions( $s->getAttribute( 's_smtp_account' ) );
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

        $this->xml .= '<record>';		
		
        foreach ( $k as $Index=>$Value ) {
		  if($Index == 'default'){			  
			    if($Value == 'Y') $checked='checked="checked"'; else $checked='';
			    $Value='<input type="radio" id="check_'.$k['id_smtp_account'].'" class="default_smtp_check" value="'.$k['id_smtp_account'].'" onfocus="keep_checked_smtp();" onclick="this.blur();return setDefaultSMTP(this.value)" name="default" '.$checked.' />';
		  }else{
			  if(!$Value) $Value='<span style="color:#CCCCCC;">[ brak ]</span>';			  
		  }

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