<?

require_once('site_core.php');
require_once('site_db.php');
require_once('site_forms.php');

// Set the title of the page
$title = "Delete Has-Aside";

echo_head($title);

echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

$pageid = $_GET['pageid'];
$asideid = $_GET['asideid'];
$action = $_GET['action'];

if ($asideid == '' || $pageid == '') {
    echo '<p>You must enter a pageid and asideid in the URL, i.e., ?asideid=asideid&pageid=pageid</p>';
    $result = run_query("SELECT asideid, pageid FROM bd16ells_has_aside");
    
    $asides = array();
     while($row = $result->fetch_assoc()){
        $asides[ $row['asideid'] ] = $row['asideid'];
    }

    $result = run_query("SELECT asideid, pageid FROM bd16ells_has_aside");
    
    $pages = array();
     while($row = $result->fetch_assoc()){
        $pages[ $row['pageid'] ] = $row['pageid'];
    }
    echo '
    <form method="get" action="delete_has_aside.php">'.
        return_option_select('asideid', $asides, 'Select an aside').
        return_option_select('pageid', $pages, 'Select a page').'
        <input class="btn btn-dark" type="submit">
        </form>';


}
else if ($action=='delete') {
	$sql = "DELETE FROM bd16ells_has_aside WHERE asideid='$asideid'
	AND pageid='$pageid'";
	run_query($sql);
    
	// $sql = "DELETE FROM asides WHERE asideid='$id'";
	// $sql = "DELETE FROM has_aside WHERE asideid='$aid' AND pageid='$pid'";
	
	echo '<p><b>'.$asideid.'</b> was deleted from <b>'.$pageid.'</b></p>';

}
else {		
	echo '
		<p>Are you sure you want to delete <b>'.$asideid.'</b> from <b>'.$pageid.'</b>?</p>
		<p>
			<a href="delete_has_aside.php?action=delete&asideid='.$asideid.'&pageid='.$pageid.'" class="btn btn-danger">Yes</a>
		</p>';
}

echo '</div>';

echo_foot();

?>