<?php

class udv_db {
	var $cnn = 0;
	var $rs = 0;

	var $rec = array();
	var $row = 0;

	var $halt_on_error = 2;//1: halt w message, 2: not halt w message, 3: not halt no message
	var $auto_free = 0;//1: free query automatically, 0: must call free method to free query
	
	var $db_host = "";
	var $db_user = "";
	var $db_pwd = "";
	var $db_name = "";
	
	var $err_num = 0;
	var $err_msg = '';
	var $debug_msg = 1;
	
	function udv_db($db_name = "",$db_host = "",$db_user = "",$db_pwd = "") {
		$this->db_name = $db_name;
		$this->db_host = $db_host;
		$this->db_user = $db_user;
		$this->db_pwd = $db_pwd;
	}
	
	function connect() {
		if ($this->cnn == 0) {
			$this->cnn = @mysql_connect($this->db_host,$this->db_user,$this->db_pwd);
			if (!$this->cnn) {
				$this->err_handler("Connection failed!");
				return 0;
			}
			
			if (!@mysql_select_db($this->db_name)) {
				$this->err_handler("Cannot select database!");
				return 0;
			}
		}
		
		return $this->cnn;
	}
	
  function cnn() {
    return $this->cnn;
  }

  function rs() {
    return $this->rs;
  }
	
  function free() {
      @mysql_free_result($this->rs);
      $this->rs = 0;
			$this->row = 0;
      $this->rec = array();
			$this->err_num = 0;
			$this->err_msg = '';
  }
	
	function safeSQL($str) {
		return mysql_escape_string($str);
	}

	function query($stQry = "") {
		if ($stQry == "") return 0;
		if (!$this->connect()) return 0;
		if ($this->rs) $this->free();
		
		$this->rs = @mysql_query($stQry,$this->cnn);
    $this->row   = 0;
    $this->err_num = @mysql_errno();
    $this->err_msg = @mysql_error();

    if (!$this->rs) $this->err_handler("Invalid SQL!: ".$stQry);

    return $this->rs;
	}
	
	function next() {
    if (!$this->rs) {
      $this->err_handler("Cannot move cursor to next record!");
      return 0;
    }

    $this->rec = @mysql_fetch_array($this->rs);
    $this->row += 1;
    $this->err_num  = @mysql_errno();
    $this->err_msg  = @mysql_error();

    $result = is_array($this->rec);
    if (!$result && $this->auto_free) {
      $this->free();
    }
    return $result;
	}
	
	function reset() {
		@mysql_data_seek($this->rs, 0);
	}
	
	function row($name="") {
    if(isset($this->rec[$name]))
      return $this->rec[$name];
    else 
      return "";
	}

	function valueArray($colname="") {
		$currrow = $this->row;
		@mysql_data_seek($this->rs, 0);
		$result = array();
		while ($__row = mysql_fetch_array($this->rs))
			if (isset($__row[$colname]))
				array_push($result,$__row[$colname]);
		@mysql_data_seek($this->rs, $currrow);
		return $result;
	}

	function valueList($colname="",$delim=",") {
		$result = @$this->valuearray($colname);
		return @implode($delim,$result);
	}

	function currentRow() {
		return $this->row;
	}
	
	function col($pos=0) {
		if (!$this->rs) {
      $this->err_handler("Cannot find specified field!");
			return "";
		}
		return @mysql_field_name($rs,$i);
	}

  function affectedRows() {
    return @mysql_affected_rows($this->cnn);
  }

  function recordCount() {
    return @mysql_num_rows($this->rs);
  }

  function numFields() {
    return @mysql_num_fields($this->rs);
  }
	
   function lastInsertID() {
		return @mysql_insert_id($this->cnn);
	}
	
	function err_handler($err_msg = "") {
    $this->err_num = @mysql_errno();
    $this->err_msg = @mysql_error();
		if ($this->halt_on_error == 3) return;
		if ($err_msg == "") $err_msg = "Undefined error!";
    printf("<font face=\"arial,helvetica\" size=\"2\"><b>Database error :</b> %s<br></font>\n", $err_msg);
    if ($this->debug_msg) printf("<font face=\"arial,helvetica\" size=\"2\"><b>MySQL Error :</b> %s (%s)</font><br>\n",$this->err_num,$this->err_msg);
		if ($this->halt_on_error == 1) die("");
	}

}

?>
