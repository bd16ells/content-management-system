<?
session_start();
if (!$_SESSION['authenticated']) die ('Access Denied');
$admin = $_SESSION['type'];
require_once('site_core.php');
require_once('site_db.php');

// Set the title of the page
$title = "Control Panel";

echo_head($title);

echo '
	<div class="container">
		<h2>'.$title.'</h2>
    <div class="float-right">
			<a href="index.php" class="btn btn-sm btn-info">Home Page</a>
			<a href="logout.php" class="btn btn-sm btn-danger">Logout</a>
		</div>';




// Get the column info first
$table = 'bd16ells_pages';
if($_GET['table']){
	$table = $_GET['table'];
}
$update = '';
$delete = '';
if($table == 'bd16ells_pages'){
	$update = "update_pages.php";
	$delete = "delete_page.php";
    echo 
'<ul class="nav nav-tabs">
	<li class="nav-item"><a class="nav-link active" href="?table=bd16ells_pages">Pages</a></li>
	<li class="nav-item"><a class="nav-link" href="?table=bd16ells_aside">Asides</a></li>
	<li class="nav-item"><a class="nav-link" href="?table=bd16ells_has_aside">Has-Asides</a></li>
	<li class="nav-item"><a class="nav-link" href="?table=bd16ells_users">Users</a></li>	
</ul>';
    if($admin == 1){
    echo '<div><a class="btn btn-success" href="insert_page.php">Create page</a></div>';
    }
}
else if($table == 'bd16ells_aside'){
	$update = "update_asides.php";
	$delete = "delete_aside.php";
    
    echo 
'<ul class="nav nav-tabs">
	<li class="nav-item"><a class="nav-link" href="?table=bd16ells_pages">Pages</a></li>
	<li class="nav-item"><a class="nav-link active" href="?table=bd16ells_aside">Asides</a></li>
	<li class="nav-item"><a class="nav-link" href="?table=bd16ells_has_aside">Has-Asides</a></li>
	<li class="nav-item"><a class="nav-link" href="?table=bd16ells_users">Users</a></li>	
</ul>';
    if($admin == 1){
    echo '<div><a class="btn btn-success" href="insert_aside.php">Create aside</a></div>';
    }
}
else if ($table == 'bd16ells_has_aside'){
	$update = "update_has_aside.php";
	$delete = "delete_has_aside.php";
    
    echo 
'<ul class="nav nav-tabs">
	<li class="nav-item"><a class="nav-link " href="?table=bd16ells_pages">Pages</a></li>
	<li class="nav-item"><a class="nav-link" href="?table=bd16ells_aside">Asides</a></li>
	<li class="nav-item"><a class="nav-link active" href="?table=bd16ells_has_aside">Has-Asides</a></li>
	<li class="nav-item"><a class="nav-link" href="?table=bd16ells_users">Users</a></li>	
</ul>';
    if($admin == 1){
     echo '<div><a class="btn btn-success" href="insert_has_aside.php">Create has-aside</a></div>';
}
}
else{
    
    echo 
'<ul class="nav nav-tabs">
	<li class="nav-item"><a class="nav-link" href="?table=bd16ells_pages">Pages</a></li>
	<li class="nav-item"><a class="nav-link" href="?table=bd16ells_aside">Asides</a></li>
	<li class="nav-item"><a class="nav-link" href="?table=bd16ells_has_aside">Has-Asides</a></li>
	<li class="nav-item"><a class="nav-link active" href="?table=bd16ells_users">Users</a></li>	
</ul>';
    if($admin == 1){
    echo '<div><a class="btn btn-success" href="insert_user.php">Create user</a></div>';
}
}

//else if($table)

if($table != ''){
$result = run_query("SHOW COLUMNS FROM $table");

// Output the column titles
echo '<table class="table">';
echo '<tr>';
echo '<th>Action</th>';
while ($row = $result->fetch_row()) {
	echo '<th>'.$row[0]."</th>";
}
echo '</tr>';

$result->close();

// Get all the rows of data
$result = run_query("SELECT * FROM $table");

// Fetch each row one at a time
if($table == 'bd16ells_pages'){
while ($row = $result->fetch_assoc()) {
	echo '<tr>';
    if($admin == 1){
	echo '<td><a class="btn btn-danger" href="'.$delete.'?id='.$row['pageid'].'" >Delete
				</a>';
        echo '<a class="btn btn-primary" href="'.$update.'?id='.$row['pageid'].'" >Update
				</a>
		</td>';
}
    else{
				echo '<td><a class="btn btn-primary" href="'.$update.'?id='.$row['pageid'].'" >Update
				</a>
		</td>';
    }
	// Loops for each column in a row
	
		echo '<td>'.$row['pageid'].'</td>';
		echo '<td>'.$row['title'].'</td>';
		echo '<td>'.$row['parent'].'</td>';
		echo '<td>'.$row['content'].'</td>';
	
	echo '</tr>';
	}
	echo '</table>';
}
else if($table == 'bd16ells_aside'){
while ($row = $result->fetch_assoc()) {

	echo '<tr>';
    if($admin == 1){
	echo '<td><a class="btn btn-danger" href="'.$delete.'?id='.$row['asideid'].'" >Delete
				</a>';
        echo '<a class="btn btn-primary" href="'.$update.'?id='.$row['asideid'].'" >Update
				</a>
		</td>';

    }
    else{
				echo '<td><a class="btn btn-primary" href="'.$update.'?id='.$row['asideid'].'" >Update
				</a>
		</td>';
    }
		echo '<td>'.$row['asideid'].'</td>';
		echo '<td>'.$row['title'].'</td>';
		echo '<td>'.$row['color'].'</td>';
		echo '<td>'.$row['content'].'</td>';

		echo '</tr>';
}
echo '</table>';
}
else if($table == 'bd16ells_has_aside'){

while ($row = $result->fetch_assoc()) {

	echo '<tr>';
    if($admin == 1){
	echo '<td><a class="btn btn-danger" href="'.$delete.'?asideid='.$row['asideid'].'&pageid='.$row['pageid'].'" >Delete
				</a>';
        echo '<a class="btn btn-primary" href="'.$update.'?id='.$row['asideid'].'&pageid='.$row['pageid'].'" >Update
				</a>
		</td>';
    }
    else{
				echo '<td><a class="btn btn-primary" href="'.$update.'?id='.$row['asideid'].'&pageid='.$row['pageid'].'" >Update
				</a>
		</td>';
    }
		echo '<td>'.$row['pageid'].'</td>';
		echo '<td>'.$row['asideid'].'</td>';
		echo '<td>'.$row['ord'].'</td>';

		echo '</tr>';

}
echo '</table>';
}
    
else if($table == 'bd16ells_users' && $admin==1){

while ($row = $result->fetch_assoc()) {

	echo '<tr>';
	echo '<td><a class="btn btn-danger" href="'.$delete.'delete_user.php?userid='.$row['userid'].'" >Delete
				</a>
				<a class="btn btn-primary" href="'.$update.'?id='.$row['userid'].'" >Update
				</a>
		</td>';

		echo '<td>'.$row['userid'].'</td>';
		echo '<td>'.$row['passwd'].'</td>';
		echo '<td>'.$row['type'].'</td>';

		echo '</tr>';

}
echo '</table>';
}
    

$result->close();

}
// else{
// 	echo '<h3>Pick a panel to view</h3>
// 	<ul>
// 		<li><a href="control_panel.php?table=bd16ells_pages">Pages</a>
// 		</li>
// 		<li><a href="control_panel.php?table=bd16ells_aside">Asides</a>
// 		</li>
// 		<li><a href="control_panel.php?table=bd16ells_has_aside">Has-Asides</a>
// 		</li>
// 	</ul>';
// }



echo '</div>';

echo_foot();

?>