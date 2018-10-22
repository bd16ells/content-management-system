<?
session_start();

require_once("site_core.php");
require_once("site_db.php");
require_once("site_forms.php");
echo_head("User Login");
echo '<div class="container">
		<h2>User Login</h2>';

if ($_SESSION['authenticated']) {
  // echo '
   //  <div class="alert alert-info">Already logged in</div>';
    header("Location: control_panel.php");
}
else {
    
    $userid = $_POST['userid'];
    $passwd = $_POST['passwd'];

    if(!$userid || !$passwd){
    echo '
		<form action="?" method="post">'.
			return_input_text('userid','User ID',"",true).
			return_input_text('passwd','Password',"",true, true).'
			<input type="submit" class="btn btn-primary" value="Submit">
		</form>';
    }
    else{
        $sql = "SELECT passwd, type FROM bd16ells_users where userid = '$userid'";
        $result = run_query($sql);
        $row = $result->fetch_row();

        if(password_verify($passwd, $row[0])){
            $_SESSION['authenticated'] = true;
            $_SESSION['type'] = $row[1];
    echo '<div class="alert alert-success">'.$userid.' is now logged in.</div>';
            
             header("Location: control_panel.php");
            
        }
        else{
            echo '<p>Invalid username or password.</p>';
            echo '
		<form action="?" method="post">'.
			return_input_text('userid','User ID',"",true).
			return_input_text('passwd','Password',"",true, true).'
			<input type="submit" class="btn btn-primary" value="Submit">
		</form>';
        }
    }

}

echo '</div>';
echo_foot();