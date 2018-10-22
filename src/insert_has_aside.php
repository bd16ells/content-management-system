<?
	
require_once('site_forms.php');
require_once('site_core.php');
require_once('site_db.php');

// Set the title of the page
$title = "Insert Has Aside";

echo_head($title);

// Create page content
echo '
	<div class="container">
		<h2>'.$title.'</h2>';

// If data is posted and URL action is insert
if ($_POST && $_GET['action']=="insert") {
	
	insert_has_aside($_POST);
	
	echo '
		<div class="alert alert-success" role="alert">
			The following values were submitted. 
			Enter new values and submit again, 
			or press clear to reset the form.
		</div>';
	
	echo_has_aside_form($_POST);
}	
else {
	// If there is no posted data or no URL insert action
	echo_has_aside_form();
}

echo '
	</div> <!-- container -->';
	
echo_foot();
	
?>