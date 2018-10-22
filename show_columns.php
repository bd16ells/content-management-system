<?

require_once('site_core.php');
require_once('site_db.php');

// Set the title of the page
$title = "Show Columns";

echo_head($title);

// Build the page content
echo '
	<div class="container">
		<h2>'.$title.'</h2>';


// Get the table name from the URL
$table = $_GET['table'];

// Run the query to get the column info
$sql = "SHOW COLUMNS FROM $table";
$result = run_query($sql);

// Generate a table
echo '<table class="table">';
echo '<tr><th>field name</th><th>data type</th><th>null?</th><th>index</th><th>default value</th></tr>';
while ($row = $result->fetch_row()) {
	echo '<tr>';
	foreach ($row as $value) {
		echo '<td>'.$value.'</td>';
	}
	echo '</tr>';
}
echo '</table>';



// Close the container div
echo '</div>';

echo_foot();

?>