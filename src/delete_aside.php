<?

require_once('site_core.php');
require_once('site_db.php');
require_once('site_forms.php');

// Set the title of the page
$title = "Delete Aside";

echo_head($title);

echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

$id = $_GET['id'];
$action = $_GET['action'];

if ($id == '') {
    echo '<p>You must enter an id in the URL, i.e., ?id=asideid</p>';
    $result = run_query("SELECT asideid, title FROM bd16ells_aside");
    
    $pages = array();
     while($row = $result->fetch_assoc()){
        $pages[ $row['asideid'] ] = $row['title'];
    }
    
    echo '
    <form method="get" action="delete_aside.php">'.
        return_option_select('id', $pages, 'Select a page').'
        <input class="btn btn-dark" type="submit">
        </form>';
}
else if ($action=='delete') {
	$sql = "DELETE FROM bd16ells_aside WHERE asideid='$id'";
	run_query($sql);
    
	// $sql = "DELETE FROM asides WHERE asideid='$id'";
	// $sql = "DELETE FROM has_aside WHERE asideid='$aid' AND pageid='$pid'";

	echo '
		<div class="alert alert-secondary" role="alert">
			Aside <b>'.$id.'</b> was deleted.
		</div>
		<div>
			<a class="btn btn-primary" href="./">Home</a>
		</div';
	
	//echo '<p><b>'.$id.'</b> was deleted from <b>asides</b></p>';

}
else {		
	echo '
		<p>Are you sure you want to delete <b>'.$id.'</b> from <b>asides</b>?</p>
		<p>
			<a href="delete_aside.php?action=delete&id='.$id.'" class="btn btn-danger">Yes</a>
		</p>';
}

echo '</div>';

echo_foot();

?>