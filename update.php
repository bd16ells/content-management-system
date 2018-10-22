<?

require_once('site_core.php');
require_once('site_db.php');
require_once('site_forms.php');

// Set the title of the page
$title = "Update Page";

echo_head($title);

echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

$id = $_GET['id'];
$action = $_GET['action'];

if ($id == '') {
    $result = run_query("SELECT pageid, title FROM bd16ells_pages");
    
    $pages= array();
    while($row = $result->fetch_assoc()){
        $pages[ $row['pageid'] ] = $row['title'];
    }
    echo '
    <form method="get" action="update.php">'.
        return_option_select('id', $pages, 'Select a page').'
        <input type="submit">
        </form>';
}
else if ($action=='update') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $parent = $_POST['parent'];
	$sql = "UPDATE pages SET title='$title', content ='$content', parent='$content' WHERE pageid='$id'";
	run_query($sql);

	// $sql = "DELETE FROM asides WHERE asideid='$id'";
	// $sql = "DELETE FROM has_aside WHERE asideid='$aid' AND pageid='$pid'";
	
	echo '<p><b>'.$id.'</b> was updated from <b>pages</b></p>';
}
else {		
    $result = run_query("SELECT pageid, title FROM bd16ells_pages");
    $pages = array();
    while($row = $result->fetch_assoc()){
        $pages[ $row['pageid'] ] = $row['title'];
    }
    $result = run_query("SELECT * FROM bd16ells_pages WHERE pageid='$id'");
    $values = $result->fetch_assoc();
	echo '
    <form action="update.php?action=update&id='.$id.'" method="post">
        <label>Page ID: </label><b>'.$id.'</b><br>'.
        return_input_text('title','Page Title', $values['title'], true).
        return_textarea('content', 'Page Content', $values['content']).
        return_option_select('parent', $pages, 'Parent Page', $values['parents']).'
        <input type="submit" class="btn btn-primary" value="Update">
        </form>';
		
}

echo '</div>';

echo_foot();

?>