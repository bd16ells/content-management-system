<?
session_start();
require_once('site_db.php');
require_once('site_core.php');
require_once('site_nav.php');
	
/* -----------------------------------------------------------------------------
Get the pageid from the URL and generate a page
----------------------------------------------------------------------------- */
function footer_auth($pageid){
    $sql = "SELECT title, content, parent FROM bd16ells_pages WHERE pageid = '".$pageid."'";
    $content = run_query($sql)->fetch_assoc();
echo '
	<footer>
				<a class="btn btn-primary float-left" href="?pageid='.$content['parent'].'">Back to parent</a>';
    
        if($_SESSION['authenticated']){
    echo '<a class="btn btn-secondary float-left" href="control_panel.php">Control Panel</a>
        <a class="btn btn-danger float-left" href="logout.php">Logout</a>
				<p class="float-right copy-right">&copy; '.date("Y").'</p>
			</footer>		  
	  </div>';
    }
    else{
          echo '<a class="btn btn-secondary float-left" href="control_panel.php">Control Panel</a>
          <a class="btn btn-primary float-left" href="login.php">Login</a>
				<p class="float-right copy-right">&copy; '.date("Y").'</p>
			</footer>		  
	  </div>'; 
    }   
    
}

// If the page is null, use the default pageid
if ($_GET['pageid'] == null) 
	$idpage = 'home';
else 
	$idpage = $_GET['pageid'];	 

// Echo the major parts of the page from head to foot
echo_head('Computer Programming');
echo_nav('Programming', $idpage);
echo_content($idpage);
echo_side_content($idpage);

footer_auth($idpage);
echo_foot();
?>