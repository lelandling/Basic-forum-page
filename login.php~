<?php
$admin = "leland";
$adminpass = "ling";
$hostname = "localhost";
$inputtextuser = strlen($_POST['username']);
$inputtextpass = strlen($_POST['password']);
$loginfailed = 0;
$username = $_POST['username'];
$password = $_POST['password'];
$dbhandle = mysql_connect($hostname, $admin, $adminpass)
or die("Unable to connect to MySQL");

$selected = mysql_select_db("forum")
or die("Could not select examples");

if((strlen($_POST['username'])) && (strlen($_POST['password']))){
	$result = mysql_query("select * from useraccount where user = '$username' and password = '$password'");
	if(! $result){
		die("could not get data: ". mysql_error());
	}
	else if ($row = mysql_fetch_assoc($result)){
		$id = $row['id'];
		header( "Location: chatpage.php?id=".$id);
	}
	else{
		$loginfailed = 1;
	}
}

?>
<html>
<?php
print_r($_POST);

echo "<form action=login.php method=post>";
echo "username :<input type=text name = username><br>";
echo "password :<input type= text name = password><br>";
echo "<input type=submit><br>";
if($inputtextuser == 0 || $inputtextpass == 0){
	echo "please fill out the form completely<br>";
}
if($loginfailed == 1){
	echo "login failed<br>";
}
echo "<a href = 'createaccount.php'>Create account</a>";

/*
/*
$username = "leland";
$password = "ling";
$hostname = "localhost";

echo $_POST["username"];
echo "<br>";

$dbhandle = mysql_connect($hostname, $username, $password)
or die("Unable to connect to MySQL");
echo "connected to MySQL<br>";

$selected = mysql_select_db("forum")
or die("Could not select examples");

echo strlen($_POST['username'])."<br>";
echo strlen($_POST['password'])."<br>";
echo (strlen($_POST['username']) == 0)."<br>";
echo (strlen($_POST['password']) == 0)."<br>";

if((strlen($_POST['username'])) && (strlen($_POST['password']))){
$result = mysql_query("select * from useraccount where user = '$_POST[username]' and password = '$_POST[password]'");
if(! $result){
die("could not get data: ". mysql_error());
}
else if ($row = mysql_fetch_assoc($result)){
echo "success";
echo "<meta http-equiv='Location' content='http://localhost/chatwebsite/chatpage.php'>";
}
else{
echo "failed";
}
}
else{
echo "please input something";
}
#	$username = "bob";
#	$password = "222";
#create
/*$sql = "insert into useraccount ".
"(user, password)".
"values".
"('$username','$password')";
$result = mysql_query($sql);
if(! $result){
die("could not get data: ". mysql_error());
}

/*while ($row = mysql_fetch_array($result)) {
echo "ID:".$row['id']."Person:".$row["user"];
}*/
?>
</html>