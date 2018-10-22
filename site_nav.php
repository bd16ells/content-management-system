<?
function echo_nav_start($short_title) {
	echo '
		<nav class="navbar navbar-expand-md navbar-light">
	    <a class="navbar-brand" href="?">'.$short_title.'</a>
	    <button class="navbar-toggler" type="button" 
	    	data-toggle="collapse" data-target="#topnavbar" 
	    	aria-controls="topnavbar" aria-expanded="false" 
	    	aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="topnavbar">
	      <ul class="navbar-nav mr-auto">';
}

function echo_nav_end() {
	echo '
	      </ul>
			</div>
    </nav>';
}

function echo_nav_item($pageid, $title, $current_page) {
	if ($current_page == $pageid) $active = 'active';
	else $active = '';
	echo '
 		<li class="nav-item '.$active.'">
    	<a class="nav-link" href="?pageid='.$pageid.'">'.$title.'</a>
		</li>';	
}

function echo_nav_subitem($pages_level2) {
		while ($page_lv2 = $pages_level2->fetch_assoc()) {
			$pageid = $page_lv2['pageid'];
			$title = $page_lv2['title'];
			echo  '<a class="dropdown-item" href="?pageid='.$pageid.'">'.$title.'</a>';
		}	
}

function echo_nav_submenu($pageid, $title, $pages_level2, $current_page) {
	if ($current_page == $pageid) $active = 'active';
	else $active = '';
	echo  '
			<li class="nav-item dropdown '.$active.'">
      	<a class="nav-link dropdown-toggle" href="#" id="'.$pageid.'" 
      		data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$title.'</a>
				<div class="dropdown-menu" aria-labelledby="'.$pageid.'">
       	 	<a class="dropdown-item" href="?pageid='.$pageid.'">'.$title.'</a>';
       	 	
  echo_nav_subitem($pages_level2);

	echo  '
				</div>
      </li>';	
}

function echo_side_nav($current_page, $title){
	

	$result = run_query("SELECT pageid, title FROM bd16ells_pages WHERE parent = '$current_page'");

	$output = '<aside style="border-style: solid""><h3>'.$title.'</h3> <ul>';
	$temp = '';
	if($result){

		while($row = $result->fetch_assoc()){
			$temp .= '<li><a href="?pageid='.$row['pageid'].'">'.$row['title'].'</a></li>';
		}
	}
	if($temp != ''){
		return $output.$temp.'</ul></aside>';
	}

}

function echo_nav($short_title, $current_page) {
	
	echo_nav_start($short_title);

	$pages_level1 = run_query("SELECT pageid, title FROM bd16ells_pages WHERE parent = 'home'");
		
	while ($page_lv1 = $pages_level1->fetch_assoc()) {
		
		$pageid = $page_lv1['pageid'];
		$title = $page_lv1['title'];
		
		$pages_level2 = run_query("SELECT pageid, title FROM bd16ells_pages WHERE parent = '".$pageid."'");
		
		if ($pages_level2->num_rows === 0) {
		 	echo_nav_item($pageid, $title, $current_page);
		}
		else {
			echo_nav_submenu($pageid, $title, $pages_level2, $current_page);
		}	
	}
	echo_nav_end();
}	

?>