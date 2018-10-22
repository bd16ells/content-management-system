<?

/* -----------------------------------------------------------------------------
Echo an option select menu

Input:
label - The label of the form element (string)
name - Uses as both the name and id of the element (string)
list - An assoicative array of unique ids and display titles

Output:  None, this function will echo HTML but return null	
----------------------------------------------------------------------------- */
		
function return_option_select($name, $list, $label='', $v='') {
	$ouput = '
	<div class="form-group">';
	
	if ($label != '')
	$ouput .= '
		<label for="'.$name.'">'.$label.'</label>';
		
	$ouput .= '		
		<select class="form-control" id="'.$name.'" name="'.$name.'">';

	foreach ($list as $id => $title) {
		$selected = '';
		if ($id == $v) $selected = 'selected';
		$ouput .= '
			<option value="'.$id.'" '.$selected.'>'.$title.'</option>';
	}
	$ouput .=  '
		</select>
	</div>';
	return $ouput;
}
/* -----------------------------------------------------------------------------
Echos eturn_option_select
----------------------------------------------------------------------------- */
function echo_option_select($name, $list, $label, $v) {
	echo return_option_select($name, $list, $label, $v);
}


/* ------------------------------------------------------
	
Create a page and test the echo_option_select functions
	
------------------------------------------------------ */	
	
require_once('site_core.php');
require_once('site_db.php');

// Create the HTML head and container
echo_head('Test 4');
echo '<div class="container">';

// Create an associateve array
$colors['#f00'] = 'red';
$colors['#0f0'] = 'green';
$colors['#00f'] = 'blue';
$colors['#ff0'] = 'yellow';
$colors['#f0f'] = 'purple';

// Dump the array
echo '<pre>';
var_dump($colors);
echo '</pre>';

// Test the function with the array
echo_option_select('color', $colors,'Pick a Color');

echo '<hr>';

// Get the pageid and title of all pages
$result = run_query("SELECT pageid, title FROM bd16ells_pages");

// Transform it into an associative array
$pages = array();
while ($row = $result->fetch_assoc()) {
		$pages[ $row['pageid'] ] = $row['title'];
}

// Dumpt the array
echo '<pre>';
var_dump($pages);
echo '</pre>';

// Test the function with the array
echo_option_select('pageid', $pages,'Pick a Page','usa');

echo '
</div>';
echo_foot();

?>