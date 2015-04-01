<?php
class Payment extends DBObject {

	protected $id_payment = 0;
	protected $id_order = 0;
	protected $txn_id = 0;
	protected $payer_email = 0;
	protected $mc_gross_1 = 0;
	protected $added = 0;
	protected $modified = 0;
	protected $deleted = 0;
	protected $active = 0;
	protected $DB = null;

	public function __construct($id=0) {
		$this->id = $id;
		$this->id_payment = $id;
		$this->DB = DB::getInstance();
		$this->load();
	}

	private function load() {
		if($this->id > 0) {
			$sql = 'SELECT * FROM `payment` WHERE deleted=\'N\' AND id_payment='.$this->id;
			$stmt = $this->DB->query($sql);
			if($stmt && $rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$this->id = $rs['id_payment'];
				$this->id_payment = $rs['id_payment'];
				$this->id_order = $rs['id_order'];
				$this->txn_id = $rs['txn_id'];
				$this->payer_email = $rs['payer_email'];
				$this->mc_gross_1 = $rs['mc_gross_1'];
				$this->added = $rs['added'];
				$this->modified = $rs['modified'];
				$this->deleted = $rs['deleted'];
				$this->active = $rs['active'];
			}
		}
	}

	public function add() {
		$sql = 'INSERT INTO `payment` SET
				`id_order`=\''.$this->id_order.'\',
				`txn_id`=\''.$this->txn_id.'\',
				`payer_email`=\''.$this->payer_email.'\',
				`mc_gross_1`=\''.$this->mc_gross_1.'\',
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
		$sql = 'UPDATE `payment` SET
				`id_order`=\''.$this->id_order.'\',
				`txn_id`=\''.$this->txn_id.'\',
				`payer_email`=\''.$this->payer_email.'\',
				`mc_gross_1`=\''.$this->mc_gross_1.'\',
				`active`=\''.$this->active.'\'
			WHERE id_payment=\'' . $this->id . '\'';
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
		$sql = 'UPDATE `payment` SET
				deleted=\'Y\'
			WHERE id_payment=\'' . $this->id . '\'';
		$result = $this->DB->exec($sql);
		if($result) {
			$_SESSION['message'] = 'Dane zostały zaktualizowane';
		}
		return $result;
	}

}
?>