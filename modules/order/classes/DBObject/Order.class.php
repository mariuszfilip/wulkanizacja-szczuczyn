<?php
class Order extends DBObject {

	protected $id_order = 0;
	protected $id_service = 0;
	protected $name = '';
	protected $address = '';
	protected $email = '';
	protected $phone = '';
	protected $comment = '';
	protected $price = 0;
	protected $message = '';
	protected $added = 0;
	protected $modified = 0;
	protected $deleted = 'N';
	protected $active = 'N';
	protected $DB = null;

	public function __construct($id=0) {
		$this->id = $id;
		$this->id_order = $id;
		$this->DB = DB::getInstance();
		$this->load();
	}

	private function load() {
		if($this->id > 0) {
			$sql = 'SELECT * FROM `order` WHERE deleted=\'N\' AND id_order='.$this->id;
			$stmt = $this->DB->query($sql);
			if($stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$this->id = $rs['id_order'];
				$this->id_order = $rs['id_order'];
				$this->id_service = $rs['id_service'];
				$this->name = $rs['name'];
				$this->address = $rs['address'];
				$this->email = $rs['email'];
				$this->phone = $rs['phone'];
				$this->comment = $rs['comment'];
				$this->price = $rs['price'];
				$this->message = $rs['message'];
				$this->added = $rs['added'];
				$this->modified = $rs['modified'];
				$this->deleted = $rs['deleted'];
				$this->active = $rs['active'];
			}
		}
	}

	public function add() {
		$sql = 'INSERT INTO `order` SET
				`id_service`=\''.$this->id_service.'\',
				`name`=\''.$this->name.'\',
				`address`=\''.$this->address.'\',
				`email`=\''.$this->email.'\',
				`phone`=\''.$this->phone.'\',
				`comment`=\''.$this->comment.'\',
				`price`=\''.$this->price.'\',
				`message`=\''.$this->message.'\',
				`added`=NOW(),
				`active`=\''.$this->active.'\'';
		$result = $this->DB->exec($sql);
		if($result) {
			$_SESSION['message'] = 'Dane zostały dodane';
		}
		$this->id = $this->DB->lastInsertId();
		return $result;
	}

	public function modify() {
		$sql = 'UPDATE `order` SET
				`id_service`=\''.$this->id_service.'\',
				`name`=\''.$this->name.'\',
				`address`=\''.$this->address.'\',
				`email`=\''.$this->email.'\',
				`phone`=\''.$this->phone.'\',
				`comment`=\''.$this->comment.'\',
				`price`=\''.$this->price.'\',
				`message`=\''.$this->message.'\',
				`active`=\''.$this->active.'\'
			WHERE id_order=\'' . $this->id . '\'';
		$result = $this->DB->exec($sql);
		if($result) {
			$_SESSION['message'] = 'Dane zostały zaktualizowane';
		}
		return $result;
	}

	public function validate() {
		$errors = array();
		return $errors;
	}
	
	public function getIdService() {
		return $this->id_service;
	}
	
	public function setIdService($id_service) {
		$this->id_service = $id_service;
	}
	
	public function getEmail() {
		return $this->email;
	}
	
	public function getId() {
		return $this->id_order;
	}

	public function save() {
		$errors = $this->validate();
		$result = 0;
		if(empty($errors)) {
			if($this->id > 0) {
				$result = $this->modify();
			} else {
				$result = $this->add();
			}
		} else {
			$_SESSION['errors'] = $errors;
		}
		return $result;
	}

	public function delete() {
		
	}

}
?>