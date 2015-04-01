<?php
class MyPDO extends PDO
    {
    	public static $log = array();
		public static $debuged_file_name = 'index.php';
    	
    	private static $Instance;	
    	
    	public function __construct($dsn, $username = NULL, $password = NULL, $atrr = NULL) {
    		parent::__construct($dsn, $username, $password, $atrr);
    		$this->setAttribute(PDO::ATTR_STATEMENT_CLASS, array('MyPDOStatement', array($this)));
    	}
    	/**
    	 * Query method. Takes the query and ads it to the log and executes it.
    	 * @return mixed
    	 */
    	public function query($query,$permit = NULL,$delete = NULL,$line = NULL,$file = NULL) {
			$type = 'query';
			if(is_int(stripos($query, 'SELECT ')) && stripos($query, 'SELECT ') < 5 && !$delete) $type = 'query';
			elseif(is_int(stripos($query, 'UPDATE ')) && stripos($query, 'UPDATE ') < 5 && !$delete) $type = 'modify';
			elseif(is_int(stripos($query, 'INSERT ')) && stripos($query, 'INSERT ') < 5 && !$delete) $type = 'add';
			elseif((is_int(stripos($query, 'DELETE ')) && stripos($query, 'DELETE ') < 5) || $delete) $type = 'delete';

			if(!$permit && $_SESSION['user']['permit']['modules'][$_GET['mod']]) {
				if($type=='query' && !$_SESSION['user']['permit']['modules'][$_GET['mod']]['view']){
					$_SESSION['message'] = 'Nie posiadasz uprawnień do wykonania tej operacji!';
					return FALSE;
				}elseif(($type=='modify' || $type=='add') && !$_SESSION['user']['permit']['modules'][$_GET['mod']]['edit']){
					$_SESSION['message'] = 'Nie posiadasz uprawnień do wykonania tej operacji!';
					return FALSE;
				}elseif($type=='delete' && !$_SESSION['user']['permit']['modules'][$_GET['mod']]['del']){
					$_SESSION['message'] = 'Nie posiadasz uprawnień do wykonania tej operacji!';
					return FALSE;
				}
			}
			
    		if(DEBUG || SQL_SAVE_LOG){
				$start = microtime(true);
    			$check_result = ($result = parent::query($query)) ? TRUE : FALSE;
    			$time = microtime(true) - $start;
    			$error = parent::errorInfo();
    			self::$log[] = array('query' => $query,
    				 				 'time' => round($time * 1000, 3),
    								 'type' => $type,
    								 'line' => $line,
    								 'file' => basename($file),
									 'result' => $$check_result,
    								 'error' => $error);
			}else{
				$result = parent::query($query);
			}
    		return $result;
    	}
		
		public function exec($query,$permit = NULL,$delete = NULL) {
			$type = 'modify';
			if(is_int(stripos($query, 'SELECT ')) && stripos($query, 'SELECT ') < 5 && !$delete) $type = 'query';
			elseif(is_int(stripos($query, 'UPDATE ')) && stripos($query, 'UPDATE ') < 5 && !$delete) $type = 'modify';
			elseif(is_int(stripos($query, 'INSERT ')) && stripos($query, 'INSERT ') < 5 && !$delete) $type = 'add';
			elseif((is_int(stripos($query, 'DELETE ')) && stripos($query, 'DELETE ') < 5) || $delete) $type = 'delete';

			if(!$permit && $_SESSION['user']['permit']['modules'][$_GET['mod']]) {
				if($type=='query' && !$_SESSION['user']['permit']['modules'][$_GET['mod']]['view']){
					$_SESSION['message'] = 'Nie posiadasz uprawnień do wykonania tej operacji!';
					return FALSE;
				}elseif(($type=='modify' || $type=='add') && !$_SESSION['user']['permit']['modules'][$_GET['mod']]['edit']){
					$_SESSION['message'] = 'Nie posiadasz uprawnień do wykonania tej operacji!';
					return FALSE;
				}elseif($type=='delete' && !$_SESSION['user']['permit']['modules'][$_GET['mod']]['del']){
					$_SESSION['message'] = 'Nie posiadasz uprawnień do wykonania tej operacji!';
					return FALSE;
				}
			}	
			
    		if(DEBUG || SQL_SAVE_LOG){
				$start = microtime(true);
				$check_result = ($result = parent::exec($query)) ? TRUE : FALSE;
    			$time = microtime(true) - $start;
    			$error = parent::errorInfo();
    			self::$log[] = array('query' => $query,
    				 				 'time' => round($time * 1000, 3),
    								 'type' => $type,
    								 'line' => $line,
    								 'file' => basename($file),
									 'result' => $check_result,
    								 'error' => $error);
			}else{
				$result = parent::query($query);
			}
    		return $result;
    	}
		
		
		public function real_exec($query) {    		
			$result = parent::exec($query);
    		return $result;
    	}		
		
		public function real_query($query) {
			$result = parent::query($query);
    		return $result;
    	}
		
		
    	/**
    	 * Returns the log in a nice html table
    	 * @return string
    	 */
    	public static function getLog() {
    		$totalTime = 0;
			$totalErrors = 0;
			foreach(self::$log as $entry) {
    			$totalTime += $entry['time'];
				if($entry['error'][1]) $totalErrors++;
			}
			$log_array['totalTime'] = $totalTime;
			$log_array['totalErrors'] = $totalErrors;
			$log_array['totalQueries'] = self::$log;
			$log_array['Time'] = date('H:i:s');
			
			/*if(SQL_SAVE_LOG){
				$logi = DB::getInstance();
				foreach(self::$log as $entry) {
					if(!$entry['error'][1] && $entry['type']!='query') {
						//echo 'INSERT INTO `_log` SET `id_operator`=\''.$_SESSION['user']['id'].'\', `query`=\''.addslashes($entry['query']).'\'';
						$logi->real_exec('INSERT INTO `_log` SET `id_operator`=\''.$_SESSION['user']['id'].'\', `query`=\''.addslashes($entry['query']).'\'');
					}
				}
			}*/		
			
    		/*$html = '<table border=0>
    				<tr>
    					<th>Operator ID</th>
						<th>Operation Type</th>
    					<th>Query</th>
    					<th>Time (ms)</th>
    				</tr>';
    		foreach(self::$log as $entry) {
    			$totalTime += $entry['time'];
    			$html .= "
    				<tr>
    					<td>{$_SESSION['user']['id']}</td>
						<td>{$entry['type']}</td>
    					<td>{$entry['query']}{$entry['exec']}</td>
    					<td>{$entry['time']}</td>
    				</tr>";
    			if (!empty($entry['error'][2])){
    				$html .= "
    				<tr>
    					<th colspan='4'>".$entry['error'][2]."</th>
    				</tr>";
    			}
    		}
    		$html .= '<tr><th>' . count(self::$log) . ' queries</th><th>' . $totalTime . '</th></tr>';
    		$html .='</table>';
    		return $html;*/
			//echo self::$debuged_file_name;
			if(DEBUG){
				$debuged_file_arr = explode('/',$_SERVER['SCRIPT_NAME']);
    			self::$debuged_file_name = ($debuged_file_arr[count($debuged_file_arr)-1]);
				if(self::$debuged_file_name != 'index.php' && self::$debuged_file_name != 'ajax_debuger.php' && $log_array['totalQueries'][0]) $_SESSION['ajax_debug_array'][] = $log_array;
			}
			
			
			return $log_array;    		
    	}
    	/**
    	 * Returns the query count 
    	 */
		public function clean($data) {
          //$data = ereg_replace ("(\t)+", "\t", $data);
		  $data = ereg_replace ("\t", " ", $data);
          //$data = ereg_replace ("\r\n", "", $data);
		  $data = ereg_replace ("\r", " ", $data);
		  $data = ereg_replace ("\n", " ", $data);
          return addslashes(ereg_replace (" +", " ", $data));
    }

		 
		public static function SaveLog() {
			$logi = DB::getInstance();
			foreach(self::$log as $entry) {
				if(!$entry['error'][1] && $entry['type']!='query' && $entry['result'] ) {
					$logi->real_exec('INSERT INTO `_log` SET `id_operator`=\''.$_SESSION['user']['id'].'\', `query`=\''.addslashes(self::clean($entry['query'])).'\'');
				}
			}
		}
		 
		
    	public function getQueryCount(){
    		return count(self::$log);
    	}
    	
    	/**
    	 * Singleton method
    	 * @return MyPDO
    	 */
    	 public static function getPdo($Username,$Password,$Host,$Database){
    	 	if (empty(self::$Instance)){
    			$dsn = "mysql:dbname=".$Database.";host=".$Host;
    			self::$Instance = new MyPDO($dsn,$Username,$Password);
    	 	}
    	 	return self::$Instance;
    	 }
		 
    	 
    }
	

	
    /**
    * PDOStatement decorator that logs when a PDOStatement is
    * executed, and the time it took to run
    * @see LoggedPDO
    */
    class MyPDOStatement extends PDOStatement {
    	const NO_MAX_LENGTH = -1;
    	/**
    	 * The PDOStatement we decorate
    	 */
    	private $connection;
    	/**
    	 * Line Number
    	 */
    	private $LineNumber;
    	/**
    	 * File
    	 */
    	private $File;
    	protected $bound_params = array();
    	protected function __construct(PDO $connection) {
    		$this->connection = $connection;
    	}
    	public function setPlace($line,$file){
    		
    		$this->LineNumber = $line;
    		$this->File = $file;
    	}
    	/**
    	* When execute is called record the time it takes and
    	* then log the query
    	* @return PDO result set
    	*/
    	public function execute() {
    		
    		$start = microtime(true);
			$check_result = ($result = parent::execute()) ? TRUE : FALSE;
    		$time = microtime(true) - $start;    		
    		$error = parent::errorInfo();			
			
			if(is_int(stripos($this->getSQL(), 'SELECT ')) && stripos($this->getSQL(), 'SELECT ') < 5) $type = 'query';
			elseif(is_int(stripos($this->getSQL(), 'UPDATE ')) && stripos($this->getSQL(), 'UPDATE ') < 5) $type = 'modify';
			elseif(is_int(stripos($this->getSQL(), 'INSERT ')) && stripos($this->getSQL(), 'INSERT ') < 5) $type = 'add';
			elseif(is_int(stripos($this->getSQL(), 'DELETE ')) && stripos($this->getSQL(), 'DELETE ') < 5) $type = 'delete';
			
    		MyPDO::$log[] = array('query' => $this->getSQL(),
    				 				'time' => round($time * 1000, 3),
    								'line' => $this->LineNumber,
    								'file' => basename($this->File),
									'type' => $type,
    								'file' => basename($file),
									'result' => $check_result,
    								'error' => $error);
    		return $result;
    	}
		
    	public function bindParam($paramno, $param, $type = PDO::PARAM_STR, $maxlen = null, $driverdata = null)
    	{
    		$this->bound_params[$paramno] = array(
    			'value' => &$param,
    			'type' => $type,
    			'maxlen' => (is_null($maxlen)) ? self::NO_MAX_LENGTH : $maxlen,
    			// ignore driver data
    		);
    		$result = parent::bindParam($paramno, $param, $type, $maxlen, $driverdata);
    	}
    	public function bindValue($parameter, $value, $data_type = PDO::PARAM_STR)
    	{
    		$this->bound_params[$parameter] = array(
    			'value' => $value,
    			'type' => $data_type,
    			'maxlen' => self::NO_MAX_LENGTH
    		);
    		parent::bindValue($parameter, $value, $data_type);
    	}
    	public function getSQL($values = array())
    	{
    		$sql = $this->queryString;
    		if (sizeof($values) > 0) {
    			foreach ($values as $key => $value) {
    				$sql = str_replace($key, $this->connection->quote($value), $sql);
    			}
    		}
    		if (sizeof($this->bound_params)) {
    			foreach ($this->bound_params as $key => $param) {
    				$value = $param['value'];
    				if (!is_null($param['type'])) {
    					$value = self::cast($value, $param['type']);
    				}
    				if ($param['maxlen'] && $param['maxlen'] != self::NO_MAX_LENGTH) {
    					$value = self::truncate($value, $param['maxlen']);
    				}
    				if (!is_null($value)) {
    					$sql = str_replace($key, $this->connection->quote($value), $sql);
    				} else {
    					$sql = str_replace($key, 'NULL', $sql);
    				}
    			}
    		}
    		return $sql;
    	}
    	static protected function cast($value, $type)
    	{
    		switch ($type) {
    			case PDO::PARAM_BOOL:
    				return (bool) $value;
    				break;
    			case PDO::PARAM_NULL:
    				return null;
    				break;
    			case PDO::PARAM_INT:
    				return (int) $value;
    			default:
    				return $value;
    		}
    	}
    	static protected function truncate($value, $length)
    	{
    		return substr($value, 0, $length);
    	}
		
		
    	
    }
?>