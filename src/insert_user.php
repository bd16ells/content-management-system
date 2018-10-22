<?
session_start();
if (!$_SESSION['authenticated']) die ('Access Denied');

require_once('site_core.php');
require_once('site_db.php');
require_once('site_forms.php');

echo_head('Insert User');

echo '
	<div class="container">
		<h2>Insert User</h2>';
if ($_POST && $_GET['action']=="insert") {
	
	insert_user($_POST);
	
	echo '
		<div class="alert alert-success" role="alert">
			The following values were submitted. 
			Enter new values and submit again, 
			or press clear to reset the form.
		</div>';
	
	echo_user_form($_POST);
}	
else {
	// If there is no posted data or no URL insert action
	echo_user_form();
}






echo '</div>';
echo_foot();