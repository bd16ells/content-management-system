<?

require_once('site_core.php');
require_once('site_db.php');

// Set the title of the page
$title = "Show Table";

echo_head($title);

echo '
	<div class="container">
		<h2>'.$title.'</h2>';


// Get the column info first
$table = $_GET['table'];
$result = run_query("SHOW COLUMNS FROM $table");

// Output the column titles
echo '<table class="table">';
echo '<tr>';
while ($row = $result->fetch_row()) {
	echo '<th>'.$row[0]."</th>";
}
echo '</tr>';

$result->close();

// Get all the rows of data
$result = run_query("SELECT * FROM $table");

// Fetch each row one at a time
while ($row = $result->fetch_row()) {
	echo '<tr>';
	
	// Loops for each column in a row
	foreach ($row as $value) {
		echo '<td>'.$value.'</td>';
	}
	echo '</tr>';
}
echo '</table>';

$result->close();

echo '</div>';

echo_foot();

?>