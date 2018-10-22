<?

require_once('site_core.php');
require_once('site_forms.php');
require_once('site_db.php');

// Set the title of the page
$title = "Update Has-Asides";

// Echo the HTML head with title
echo_head($title);

// Echo Bootstrap container 
echo '
    <div class="container">
        <h2>'.$title.'</h2>';
        

// Get the page id and action
$id = $_GET['id'];
$action = $_GET['action'];

// If the id is null/blank
if ($id == '') {
    
    // Get the pageid and title of all pages
    $result = run_query("SELECT asideid, pageid FROM bd16ells_has_aside");
    
    // Transform it into an associative array
    $asides = array();
    while ($row = $result->fetch_assoc()) {
        $asides[ $row['asideid'] ] = $row['asideid'];
    }
    
    // Generate a dropdown menu of all the pages
    echo '
        <form method="get" action="update_has_aside.php">'.
            return_option_select('id',$asides,'Select an aside').'
            <input type="submit">
        </form>';
}
// If action is update
else if ($action=='update') {

    // Get the posted form data
    $pageid = $_POST['pageid'];
    $asideid = $_POST['asideid'];
    $ord = $_POST['ord'];
    
    // Form the query
    $sql = "UPDATE bd16ells_has_aside SET pageid = '$pageid', ord = '$ord' WHERE asideid='$id'";

    // Run the query
    run_query($sql);
    
    // Echo feedback
    echo '
        <p><a href="index.php?asideid='.$id.'">'.$id.'</a> was updated from has-asides</p>';
}

// If the id is given but action is not update
else {
    
    // Get all the pages to generate the parent drop down
    $result = run_query("SELECT asideid, pageid FROM bd16ells_has_aside");
    $pages = array();
    $asides = array();
    while ($row = $result->fetch_assoc()) {
        $asides[ $row['asideid'] ] = $row['asideid'];
        $pages[ $row['pageid'] ] = $row['pageid'];

    }   
    
    // Get the data for the selected page
    $result = run_query("SELECT * FROM bd16ells_has_aside WHERE asideid='$id'");
    $values = $result->fetch_assoc();
    
    echo '
        <form action="update_has_aside.php?action=update&id='.$id.'" method="post">
            <label>Aside ID: </label> <b>'.$id.'</b><br>'.
            return_option_select('pageid', $pages, "Select pageid").
            return_input_text('ord','Order').'
            <input type="submit" class="btn btn-primary" value="Update">
        </form>';   
}

echo '</div>';

echo_foot();

?>