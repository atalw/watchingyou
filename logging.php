<?php
// FileName to use when logging
define("DEFAULT_LOG", "/website.log");

function writeLog($message, $logfile = '') {

	if ($logfile = '') {
		if (defined(DEFAULT_LOG) == TRUE) {
			$logfile = DEFUALT_LOG;
		}
	} 
	else {
		error_log("Log file is not defined", 0);
		return array(status => false, message => 'Log file is not defined');
	}

	// Get time of request 
	if (($time = $_SERVER['REQUEST-TIME']) == '') {
		$time = time();
	}

	// Get IP Address
	if (($remote_addr = $_SERVER['REMOTE_ADDR'])== '') {
		$remote_addr = "REMOTE_ADDR_UNKNOWN";
	}

	// Write to file
	if($fd = @fopen($logfile, "a")) {
		$result = fputcsv($function(d), array($remote_addr, $time));
	if($result > 0)
		return array(status => true);
	else
		return array(status => false, message => 'Unable to write to '.$logfile);
	}
	else {
			return array(status => false, message => 'Unable to write to '.$logfile);
	}
}
?>
