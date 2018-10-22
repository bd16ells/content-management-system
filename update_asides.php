<?

require_once('site_core.php');
require_once('site_forms.php');
require_once('site_db.php');

// Set the title of the page
$title = "Update Asides";

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
    $result = run_query("SELECT asideid, title FROM bd16ells_aside");
    
    // Transform it into an associative array
    $asides = array();
    while ($row = $result->fetch_assoc()) {
        $asides[ $row['asideid'] ] = $row['asideid'];
    }
    
    // Generate a dropdown menu of all the pages
    echo '
        <form method="get" action="update_asides.php">'.
            return_option_select('id',$asides,'Select an aside').'
            <input type="submit">
        </form>';
}
// If action is update
else if ($action=='update') {

    // Get the posted form data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $color = $_POST['color'];
    
    // Form the query
    $sql = "UPDATE bd16ells_aside SET title = '$title', content = '$content', color = '$color' WHERE asideid='$id'";

    // Run the query
    run_query($sql);
    
    // Echo feedback
    echo '
        <p><a href="index.php?asideid='.$id.'">'.$id.'</a> was updated from asides</p>';
}

// If the id is given but action is not update
else {
    
    // Get all the pages to generate the parent drop down
    $result = run_query("SELECT asideid, title FROM bd16ells_aside");
    $pages = array();
    while ($row = $result->fetch_assoc()) {
        $pages[ $row['asideid'] ] = $row['title'];
    }   
    
    // Get the data for the selected page
    $result = run_query("SELECT * FROM bd16ells_aside WHERE asideid='$id'");
    $values = $result->fetch_assoc();
    
    
    $colors['rgba(255, 0, 0, 0.3)'] = 'red';
    $colors['rgba(0,128,0, 0.3)'] = 'green';
    $colors['rgba(0,191,255, 0.3)'] = 'blue';
    $colors['rgba(255,255,0, 0.3)'] = 'yellow';
    $colors['rgba(148,0,211, 0.3)'] = 'purple';
    // Ouput the edit form
    echo '
        <form action="update_asides.php?action=update&id='.$id.'" method="post">
            <label>Aside ID: </label> <b>'.$id.'</b><br>'.
            return_input_text('asideid','Aside ID',$values['asideid'],true).
            return_input_text('title','Page Title',$values['title'],true).
            return_textarea('content','Page Content',$values['content']).   
            return_option_select('color', $colors, "Color", $v='green').'
            <input type="submit" class="btn btn-primary" value="Update">
        </form>';   
}

echo '</div>';

echo_foot();

?>