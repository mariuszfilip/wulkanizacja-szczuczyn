<?php
class Meta {
  
  protected $meta_title         					= '';
	protected $meta_title_overwrite  				= 0;
  protected $meta_description   					= '';
	protected $meta_description_overwrite		= 0;
  protected $meta_keywords      					= '';
	protected $meta_keywords_overwrite			= 0;
  protected $meta_robots        					= '';
	protected $meta_robots_overwrite				= 0;
  protected $meta_last_modified 					= '';

  public function __construct( $request = Request, $response = Response ) {
		$this->request = $request;
		$this->response = $response;
		$this->session = Session::getInstance();
		$this->DB = DB::getInstance();
		$modName =  String::toLower($this->request->getParameter('mod'));
		$this->loadDefault();
		if($modName == 'page' || $modName == 'event') { // meta strony
      $this->getMetaPage();
    }
  }

  private function loadDefault() {
  	$sql = 'SELECT * FROM `meta_tag` WHERE `language` = \''.$this->session->getAttribute('lang').'\' LIMIT 1';
    $stmt = $this->DB->query($sql);
    if($stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$stmt->closeCursor();
      $this->meta_title         						= $rs['meta_title'];
			$this->meta_title_overwrite   				= $rs['meta_title_overwrite'];
      $this->meta_description   						= $rs['meta_description'];
			$this->meta_description_overwrite			= $rs['meta_description_overwrite'];
      $this->meta_last_modified 						= $rs['meta_last_modified'];
      $this->meta_robots        						= $rs['meta_robots'];
			$this->meta_robots_overwrite					= $rs['meta_robots_overwrite'];
      $this->meta_keywords      						= $rs['meta_keywords'];
			$this->meta_keywords_overwrite				= $rs['meta_keywords_overwrite'];
    }
  }

  private function getMetaPage() {
		if($this->response->getParameter('page'))
			$page_array = ( $this->response->getParameter('page')->toArray() );
			if( !$this->meta_title_overwrite ) {
				if(!empty($page_array['meta_title']))
        	$this->meta_title         = $page_array['meta_title'];
				else
					$this->meta_title         = SITE_NAME.SEPARATOR.$page_array['name'];
      }
      if( !empty($page_array['meta_description']) && !$this->meta_description_overwrite ) {
        $this->meta_description   = $page_array['meta_description'];
      }
      if( !empty($page_array['meta_last_modified']) && !$this->meta_last_modified_overwrite ) {
        $this->meta_last_modified = $page_array['meta_last_modified'];
      }
      if( !empty($page_array['meta_robots']) && !$this->meta_robots_overwrite ) {
        $this->meta_robots        = $page_array['meta_robots'];
      }
      if( !empty($page_array['meta_keywords']) && !$this->meta_keywords_overwrite ) {
        $this->meta_keywords      = $page_array['meta_keywords'];
      }
  }

  public function getMeta() {
    return array( 
      'meta_title'         => $this->meta_title,
      'meta_description'   => $this->meta_description,
      'meta_last_modified' => $this->meta_last_modified,
      'meta_robots'        => $this->meta_robots,
      'meta_keywords'      => $this->meta_keywords
    );
  }

}
?>