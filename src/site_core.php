<?
session_start();
require_once("site_nav.php");
/* -----------------------------------------------------------------------------
Returns start of HTML document from <!doctype> to <body> with Bootstrap 4.0 link
and custom style.css link. Slices title into head	

Input: Webpage title (string)
Output: HTML text (string)	
----------------------------------------------------------------------------- */
function return_head($title) {
	return '
		<!doctype html>
		<html lang="en">
		  <head>
		    <meta charset="utf-8">
		    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		    <link rel="stylesheet" href="style.css">
		    <title>'.$title.'</title>
		  </head>
		  <body>';
}
/* -----------------------------------------------------------------------------
Echo return_head
----------------------------------------------------------------------------- */
function echo_head($title) {
	echo return_head($title);
}


/* -----------------------------------------------------------------------------
Returns end of HTML document from </body> to </html> with Bootstrap 4.0 scripts
jquery 3.2, popper 1.12 and boostrap 4.0

Input: None
Output: HTML text (string)	
----------------------------------------------------------------------------- */
function return_foot() {
	return '
		    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
		    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		  </body>
		</html>';
}
/* -----------------------------------------------------------------------------
Echo  return_foot
----------------------------------------------------------------------------- */
function echo_foot() {
	echo return_foot();
}	


function return_footer($pageid){

	$sql = "SELECT title, content, parent FROM bd16ells_pages WHERE pageid = '".$pageid."'";
	$content = run_query($sql)->fetch_assoc();

	return '
	<footer>
				<a class="btn btn-primary float-left" href="?pageid='.$content['parent'].'">Back to parent</a>
        <a class="btn btn-secondary float-left" href="control_panel.php">Control Panel</a>
				<p class="float-right copy-right">&copy; '.date("Y").'</p>
			</footer>		  
	  </div>';
    

    
}

function echo_footer($pageid){
	echo return_footer($pageid);
}

/* -----------------------------------------------------------------------------
Returns HTML document content from content database

Input: The current page id (string)
Output: HTML text (string)	
----------------------------------------------------------------------------- */
function return_content($pageid) {   	
	$sql = "SELECT title, content, parent FROM bd16ells_pages WHERE pageid = '".$pageid."'";
	$content = run_query($sql)->fetch_assoc();
	  	//////////////////////////
	return '
		<div class="container">
		  <h1>'.$content['title'].'</h1>
			<div class="row">
				<div class="col-md">
					<main>'.$content['content'].'</main>
				</div>';	
}
/* -----------------------------------------------------------------------------
Echo  return_content
----------------------------------------------------------------------------- */
function echo_content($pageid) {
	echo return_content($pageid);
}
function return_side_content($pageid){
	$side_content ='';

		$sql = run_query("SELECT title FROM bd16ells_pages WHERE 
			pageid = '$pageid'");
		$res = $sql->fetch_assoc();
		$output.= echo_side_nav($pageid, $res['title']);


	$side_content .= return_asides($pageid);

	if($side_content != ''){
		$side_content = '
		<div class="col-sm-4">'.$output.
		$side_content.'</div>
		</div>';
	}
	else{
		$side_content .= '</div>';
	}
	return $side_content;
}
function return_asides($pageid){
	$retval = '';

	$sql = "SELECT asideid FROM bd16ells_has_aside WHERE pageid = '".$pageid."' ORDER by ord ASC";
	$asides = run_query($sql);

	if($asides->num_rows > 0){
		while($aside = $asides->fetch_assoc()){
			$id = $aside['asideid'];
			
			$sql = "SELECT title, content, color FROM bd16ells_aside WHERE asideid = '".$id."'";
			$content = run_query($sql)->fetch_assoc();

			$retval .='
			<aside style="border-style: solid 1px black; box-shadow: 5px 10px '.$content['color'].'"> <h3>'.$content['title'].'</h3>'.$content['content'].'</aside>';
		}


	}
	return $retval;
}
function echo_side_content($pageid){
	echo return_side_content($pageid);
}
	


?>