<?php
class Smtp_account extends DBObject {

	protected $id_smtp_account 	= 0;
	protected $mail 			= 0;
	protected $host 			= 0;
	protected $user 			= 0;
	protected $pass 			= 0;
	protected $smtpauth 		= 0;
	protected $default	 		= 0;
	protected $added 			= 0;
	protected $modified 		= 0;
	protected $deleted 			= 0;
	protected $DB 				= null;

	public function __construct($id=0) {
		$this->id = $id;
		$this->id_smtp_account = $id;
		$this->DB = DB::getInstance();
		$this->load();
	}

	private function load() {
		if($this->id > 0) {
			$sql = 'SELECT * FROM `smtp_account` WHERE `deleted`=\'N\' AND `id_smtp_account`='.$this->id;
			$stmt = $this->DB->query($sql);
			if($stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$this->id = $rs['id_smtp_account'];
				$this->id_smtp_account = $rs['id_smtp_account'];
				$this->mail = $rs['mail'];
				$this->host = $rs['host'];
				$this->user = $rs['user'];
				$this->pass = $rs['pass'];
				$this->smtpauth = $rs['smtpauth'];
				$this->default = $rs['default'];				
				$this->added = $rs['added'];
				$this->modified = $rs['modified'];
				$this->deleted = $rs['deleted'];
			}
		}
	}

	public function add() {

	}

	public function modify() {
		
	}

	public function validate() {
		$errors = array();
		return $errors;
	}
	
	
	public function getDefault() {
		$sql = 'SELECT * FROM `smtp_account` WHERE `deleted`=\'N\' AND `default`=\'Y\' LIMIT 1;';
		$stmt = $this->DB->query($sql);
		if($stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$this->id = $rs['id_smtp_account'];
			$this->id_smtp_account = $rs['id_smtp_account'];
			$this->mail = $rs['mail'];
			$this->host = $rs['host'];
			$this->user = $rs['user'];
			$this->pass = $rs['pass'];
			$this->smtpauth = $rs['smtpauth'];
			$this->default = $rs['default'];				
			$this->added = $rs['added'];
			$this->modified = $rs['modified'];
			$this->deleted = $rs['deleted'];
		}
	}

	public function save() {
	
	}

	public function delete() {
		
	}

}
?>