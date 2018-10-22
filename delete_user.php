<?
session_start();
if (!$_SESSION['authenticated']) die ('Access Denied');
	
require_once('site_core.php');
require_once('site_db.php');
require_once('site_forms.php');

// Set the title of the page
$title = "Delete User";

echo_head($title);

echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

$userid = $_GET['userid'];
$action = $_GET['action'];

if ($userid == '') {
    echo '<p>You must enter an id</p>
    ';
   
    echo '<form action="?action=delete" method="get">'.
    return_input_text('userid','User ID',$userid,true).'
    <input type="submit" class="btn btn-primary" value="Submit">
			<a href="?" class="btn btn-warning">Clear</a>
		</form>';
}
else if ($action=='delete') {
	$sql = "DELETE FROM bd16ells_users WHERE userid='$userid'";
	run_query($sql);
    
	// $sql = "DELETE FROM asides WHERE asideid='$id'";
	// $sql = "DELETE FROM has_aside WHERE asideid='$aid' AND pageid='$pid'";
	
	echo '
		<div class="alert alert-secondary" role="alert">
			<b>'.$userid.'</b> was deleted from pages.
		</div>
		<div>
			<a class="btn btn-primary" href="./">Home</a>
		</div>';

}
else {		
	echo '
		<p>Are you sure you want to delete <b>'.$userid.'</b> from <b>users</b>?</p>
		<p>
			<a href="delete_user.php?action=delete&userid='.$userid.'" class="btn btn-danger">Yes</a>
		</p>';
}

echo '</div>';

echo_foot();

?>