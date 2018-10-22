<?
session_start();
if (!$_SESSION['authenticated']) die ('Access Denied');
require_once('site_db.php');

$sql = "CREATE TABLE IF NOT EXISTS  `bd16ells_users` (
	`userid` varchar(32) NOT NULL,
	`passwd` varchar(128) NOT NULL,
	`type` int(11) DEFAULT 0,
	PRIMARY KEY (`userid`)
)";

run_query($sql);

echo 'SUCCESS: The following query executed: '.$sql;
?>