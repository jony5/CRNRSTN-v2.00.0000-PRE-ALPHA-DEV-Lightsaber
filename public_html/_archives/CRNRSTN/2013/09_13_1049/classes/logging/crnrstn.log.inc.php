<?php
#
# [INSERT HEADER FROM MOST RECENT DEVELOPMENT ON MAC BOOK PRO ONCE YOU GET THE DATA FROM THAT HARD DRIVE.]
#


# syslog() Priorities (in descending order)
# Constant		Description
# LOG_EMERG		system is unusable
# LOG_ALERT		action must be taken immediately
# LOG_CRIT		critical conditions
# LOG_ERR		error conditions
# LOG_WARNING	warning conditions
# LOG_NOTICE	normal, but significant, condition
# LOG_INFO		informational message
# LOG_DEBUG		debug-level message

class logging {
	private static $logCaller;
	
	public function __construct($caller) {
		self::$logCaller = $caller;
	}
	
	public static function captureNotice($logPriority, $msg){
 		print $msg;
		print "<br>";
		print self::$logCaller;
		print "<br>";
		print $logPriority;
		print "<br>---<br>";
		
		//
		// OPTIONS FOR NOTIFICATION HANDLING
		# - DISPLAY TO SCREEN				[null]
		# - LOG TO FILE						[path to file]
		# - SEND VIA EMAIL					[email address(es)]
		# - SEND TO 3RD PARTY SERVICE		[...]
		
	}
	
	public function __destruct() {
		
	}
}




?>