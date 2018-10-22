<?
	
require_once('site_db.php');

$sql = "CREATE TABLE IF NOT EXISTS `bd16ells_pages` (
  `pageid` varchar(32) NOT NULL,
  `title` varchar(64) NOT NULL,
  `parent` varchar(32) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`pageid`)
)";

run_query($sql);

echo 'SUCCESS: The following query executed: <pre>'.$sql.'</pre>';



$aside = "CREATE TABLE IF NOT EXISTS `bd16ells_aside` (
  `asideid` varchar(32) NOT NULL,
  `title` varchar(64) NOT NULL,
  `color` varchar(32) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`asideid`)
)";

run_query($aside);

echo 'SUCCESS: The following query executed: <pre>'.$aside.'</pre>';


$has_aside = "CREATE TABLE IF NOT EXISTS `bd16ells_has_aside` (
  `pageid` varchar(32) NOT NULL,
  `asideid` varchar(32) NOT NULL,
  `ord` int(11) DEFAULT NULL,
  PRIMARY KEY (`pageid`,`asideid`)
)";

echo 'SUCCESS: The following query executed: <pre>'.$has_aside.'</pre>';
	

run_query($has_aside);
?>