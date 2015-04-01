<?php

class Modules extends DBObject {

  protected $name      = '';
  protected $dane      = '';
  protected $id_module = 0;

  public function __construct($id = 0, $m = 0) {
		$this->id      = $id;
		$this->m		   = $m;
  	$this->id_operator = $id;
    $this->load();
  }

  private function load() {
    $DB = DB::getInstance();
  	if($this->id > 0) {
    	$sql = 'SELECT *, `module`.`id_module` AS `id_module`
    	  FROM `module`
				LEFT JOIN `operator_module`
					ON `module`.`id_module` = `operator_module`.`id_module` AND `operator_module`.`id_operator`=\'' . $this->id . '\'
				WHERE `module`.`protected` =\'Y\'
    		ORDER BY `order` ASC';
      
		$stmt = $DB->query($sql);
	  
		if($stmt) {
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			foreach($result as $k => $row) {        
				$this->dane[$k]   = $row;
			}		
		
			if($this->m !=0){
				foreach($this->m as $linia => $wartosc) {
					if (!$wartosc[view]) $wartosc[view]=0;
					if (!$wartosc[edit]) $wartosc[edit]=0;
					if (!$wartosc[del]) $wartosc[del]=0;
					$sql = 'INSERT INTO `operator_module` SET 
								`id_operator`=\'' . $this->id . '\',
								`id_module`=\'' . $linia . '\',
								`view`=\'' . $wartosc[view] . '\',
								`edit`=\'' . $wartosc[edit] . '\',
								`del`=\'' . $wartosc[del] . '\'
							ON DUPLICATE KEY UPDATE 
								`view`=\'' . $wartosc[view] . '\',
								`edit`=\'' . $wartosc[edit] . '\',
								`del`=\'' . $wartosc[del] . '\'
					;';

					$result = $DB->exec($sql);
					if($result) {
      					$_SESSION['message'] = 'Dane zostaly zaktualizowane';
    				}				
				}	
			} #if($this->m !=0)
			return $this->dane;
      } #if($stmt)
  	} #	if($this->id > 0)
  }


	public function modify() {
    $DB = DB::getInstance();
    $result = 0;
	 foreach($this->m[1] as $linia)
        {
                echo $linia ;
        }
    $sql = 'UPDATE  `operator_module` SET
										`id_module`=\'' . $this->name . '\',
										`id_operator`=\'' . $this->surname . '\',
										`view`=\'' . $this->email . '\',
										`edit`=\'' . $this->password . '\',
										`save`=\'' . $this->active . '\'
           		WHERE `id_operator`=\'' . $this->id . '\'';
    $result = $DB->exec($sql);
    if($result) {
      $_SESSION['message'] = 'Dane zostaly zaktualizowane';
    }
    return $result;
  }


  public function fromArray($array) {
  	parent::fromArray($array);
  	$this->id = $this->id_operator;
  }

 
  public function validate() {

  }

  public function delete() {
   
  }
  
  public function save() {
   
  }

}

?>