<?php
$admin = "leland";
$adminpass = "ling";
$hostname = "localhost";
$dbhandle = mysql_connect($hostname, $admin, $adminpass)
or die("Unable to connect to MySQL");
$selected = mysql_select_db("forum")
or die("Could not select examples");

date_default_timezone_set('America/Los_Angeles');
$timestamp = date("Y-m-d H:i:s");
if(isset($_GET['id'])){
    $userid=$_GET['id'];
}
else if (isset($_POST['id'])){
	$userid=$_POST['id'];
}
else{
	header( "Location: error.php?id=".$username);
}
if(isset($_POST['create'])){
	$parentid = $_POST['parentid'];
	$title = $_POST['title'];
	$body = $_POST['body'];
	$querycommand = "insert into forumchatpage (userid, timestamp, text, parentid, title) values ('$userid', '$timestamp', '$body', '$parentid', '$title')";
	$result = mysql_query($querycommand);
	if(! $result){ 
		die("could not get data: ". mysql_error());
	}
}

	header( "Location: chatpage.php?id=".$_POST['id']." ");

?>
