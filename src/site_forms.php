<?
	
/* -----------------------------------------------------------------------------
Returns the HTML of a labeled input text element with Bootstrap class names

Input: 
  Name of element (string)
  Text label of element (string)
  Value of element (string)
  Is the element required (boolean)
  

Output: HTML text (string)	
----------------------------------------------------------------------------- */
	
function return_input_text($name, $label, $value='', $required=false, $password=false) {
	if ($required) $req = 'required';
	else $req = '';
    
    if ($password) $intype = 'password';
    else $intype = 'text';
    
	return '
		<div class="form-group">
			<label for="'.$name.'">'.$label.'</label>
			<input type="'.$intype.'" class="form-control" name="'.$name.'" id="'.$name.'" value="'.$value.'" '.$req.'>
            
		</div>';
}
/* -----------------------------------------------------------------------------
Echos return_input_text
----------------------------------------------------------------------------- */
function echo_input_text($name, $label, $value) {
	echo return_input_text($name, $label, $value);
}



/* -----------------------------------------------------------------------------
Returns the HTML of a labeled input text element with Bootstrap class names
TEXT AREA
Input: 
  Name of element (string)
  Text label of element (string)
  Value of element (string)
  Is the element required (boolean)
  

Output: HTML text (string)	
----------------------------------------------------------------------------- */
	
function return_textarea($name, $label, $value='', $required=false) {
	if ($required) $req = 'required';
	else $req = '';
	return '
		<div class="form-group">
            <label for="'.$name.'">'.$label.'</label>
    <textarea class="form-control" id="'.$name.'" name="'.$name.'" rows="3"'.$req.'>'.$value.'</textarea>
            
		</div>';
}
/* -----------------------------------------------------------------------------
Echos return_input_text
----------------------------------------------------------------------------- */
function echo_textarea($name, $label, $value) {
	echo return_textarea($name, $label, $value);
}


/* -----------------------------------------------------------------------------
Returns the HTML of a form for inserting rows into the pages table

Input:  Previously submitted values (associative array)
Output: HTML text (string)	
----------------------------------------------------------------------------- */
function return_page_form($values) {
    $sql = "SELECT pageid, title FROM bd16ells_pages";
    $result = run_query($sql);
    $ids = array();
    $ids[''] = "";
    while($row = $result->fetch_assoc()){
        $ids[ $row['pageid'] ] = $row['title'];
    }
    
    
	return '
		<form action="?action=insert" method="post">'.
			return_input_text('pageid','Page ID',$values['pageid'],true).
			return_input_text('title','Page Title',$values['title'],true).
			return_textarea('content','Page Content',$values['content']). 	
			return_option_select('parent', $ids, "Parent Page").'
			<input type="submit" class="btn btn-primary" value="Submit">
			<a href="?" class="btn btn-warning">Clear</a>
		</form>';
}
/* -----------------------------------------------------------------------------
Echos return_page_form
----------------------------------------------------------------------------- */
function echo_page_form($values) {
	echo return_page_form($values);
}

/* -----------------------------------------------------------------------------
Inserts a new row into the pages table.

Input:  Posted values (associative array)
Output: None	
----------------------------------------------------------------------------- */
function insert_page($values) {
	$pageid = $values['pageid'];
	$title = $values['title'];
	$content = addslashes($values['content']);
	$parent = $values['parent'];
	$sql = "INSERT INTO bd16ells_pages (pageid, title, content, parent) VALUES ('$pageid','$title','$content','$parent')";
	run_query($sql);
}
		



/* -----------------------------------------------------------------------------
Returns the HTML of a form for inserting an aside into the pages table

Input:  Previously submitted values (associative array)
Output: HTML text (string)	
----------------------------------------------------------------------------- */
function return_aside_form($values) {
    $colors['rgba(255, 0, 0, 0.3)'] = 'red';
    $colors['rgba(0,128,0, 0.3)'] = 'green';
    $colors['rgba(0,191,255, 0.3)'] = 'blue';
    $colors['rgba(255,255,0, 0.3)'] = 'yellow';
    $colors['rgba(148,0,211, 0.3)'] = 'purple';
	return '
		<form action="?action=insert" method="post">'.
			return_input_text('asideid','Aside ID',$values['asideid'],true).
			return_input_text('title','Page Title',$values['title'],true).
			return_textarea('content','Page Content',$values['content']). 	
			return_option_select('color', $colors, "Color", $v='green').'
			<input type="submit" class="btn btn-primary" value="Submit">
			<a href="?" class="btn btn-warning">Clear</a>
		</form>';
}
/* -----------------------------------------------------------------------------
Echos return_aside_form
----------------------------------------------------------------------------- */
function echo_aside_form($values) {
	echo return_aside_form($values);
}

/* -----------------------------------------------------------------------------

/* -----------------------------------------------------------------------------
Inserts a new row into the pages table.

Input:  Posted values (associative array)
Output: None	
----------------------------------------------------------------------------- */

function insert_aside($values) {
	$asideid = $values['asideid'];
	$title = $values['title'];
	$content = addslashes($values['content']);
	$color = $values['color'];
	$sql = "INSERT INTO bd16ells_aside (asideid, title, content, color) VALUES ('$asideid','$title','$content','$color')";
	run_query($sql);
}




/* -----------------------------------------------------------------------------
Returns the HTML of a form for inserting an aside into the pages table

Input:  Previously submitted values (associative array)
Output: HTML text (string)	
----------------------------------------------------------------------------- */
function return_has_aside_form($values) {

	$sql = "SELECT pageid, title FROM bd16ells_pages";
    $result = run_query($sql);
    $pageids = array();
    while($row = $result->fetch_assoc()){
        $pageids[ $row['pageid'] ] = $row['title'];
    }

    $sql = "SELECT asideid, title FROM bd16ells_aside";
    $result = run_query($sql);
    $asideids = array();
    while($row = $result->fetch_assoc()){
        $asideids[ $row['asideid'] ] = $row['asideid'];
    }

	return '
		<form action="?action=insert" method="post">'.
        return_option_select('pageid', $pageids, "Page ID").
        return_option_select('asideid', $asideids, "Aside ID").
			return_input_text('ord','Order',$values['ord']).'
			<input type="submit" class="btn btn-primary" value="Submit">
			<a href="?" class="btn btn-warning">Clear</a>
		</form>';
}
/* -----------------------------------------------------------------------------
Echos return_aside_form
----------------------------------------------------------------------------- */
function echo_has_aside_form($values) {
	echo return_has_aside_form($values);
}

/* -----------------------------------------------------------------------------

/* -----------------------------------------------------------------------------
Inserts a new row into the pages table.

Input:  Posted values (associative array)
Output: None	
----------------------------------------------------------------------------- */

function insert_has_aside($values) {
	$asideid = $values['asideid'];
	$pageid = $values['pageid'];
	$ord = $values['ord'];
	$sql = "INSERT INTO bd16ells_has_aside (pageid, asideid, ord) VALUES ('$pageid', '$asideid', '$ord')";
	run_query($sql);
}



//drop down menus

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

function return_user_form(){
    
    
    	return '
		<form action="?action=insert" method="post">'.
			return_input_text('userid','User ID',$values['userid'],true).
			return_input_text('passwd','Password',$values['title'],true, true).
			return_input_text('type', 'Type', $values['type'], true).'
			<input type="submit" class="btn btn-primary" value="Submit">
			<a href="?" class="btn btn-warning">Clear</a>
		</form>';
}

function echo_user_form(){
    echo return_user_form();
}
function insert_user($values){
    $userid = $values['userid'];
	$passwd = $values['passwd'];
    $hashed_pw = password_hash($passwd, PASSWORD_DEFAULT);
	$type = $values['type'];
	$sql = "INSERT INTO bd16ells_users (userid, passwd, type) VALUES ('$userid','$hashed_pw','$type')";
	run_query($sql);
}

?>