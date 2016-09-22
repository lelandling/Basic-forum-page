<?php
$username = $_POST['username'];
$password = $_POST['password'];
$usernamematch = 0;
$admin = "leland";
$adminpass = "ling";

$dbhandle = mysql_connect($hostname, $admin, $adminpass)
or die("Unable to connect to MySQL");

$selected = mysql_select_db("forum")
or die("Could not select examples");

#check users
$result = mysql_query("select * from useraccount where user = '$_POST[username]'");
if(! $result){
	die("could not get data: ". mysql_error());
}
else if ($row = mysql_fetch_assoc($result)){
	$usernamematch = 1;
}
else{
	#fail case
}

#create else case for only user, pass, etc
if($password == $_POST['passwordretype'] && (strlen($_POST['username'])) != 0 && (strlen($_POST['password'])) != 0 && $usernamematch ==0){
	$sql = "insert into useraccount ".
	"(user, password)".
	"values".
	"('$username','$password')";
	$result = mysql_query($sql);
	if(! $result){
		die("could not get data: ". mysql_error());
	}
	header('Location: mysql.php');
}
else if ($usernamematch == 1){
	echo "this username has been taken<br>";
}
else {
	echo "passwords do not match";
}
?>
<?php
print_r($_POST);

echo "<form action=createaccount.php method=post>";
echo "username :<input type=text name = username><br>";
echo "password :<input type= text name = password><br>";
echo "retype password :<input type= text name = passwordretype><br>";
echo "<input type=submit submit = create><br>";

echo "<a href = 'login.php'>Already have an account?</a>";

/*print_r($_POST);
$usernamematch = 0;
$admin = "leland";
$adminpass = "ling";
$dbhandle = mysql_connect($hostname, $admin, $adminpass)
or die("Unable to connect to MySQL");
echo "connected to MySQL<br>";

$selected = mysql_select_db("forum")
or die("Could not select examples");

echo "<form action=createaccount.php method=post>";
echo "username :<input type=text name = username><br>";
echo "password :<input type= text name = password><br>";
echo "retype password :<input type= text name = passwordretype><br>";
echo "<input type=submit submit = create><br>";
$username = $_POST['username'];
$password = $_POST['password'];
$result = mysql_query("select * from useraccount where user = '$_POST[username]'");
if(! $result){
	die("could not get data: ". mysql_error());
}
else if ($row = mysql_fetch_assoc($result)){
	$usernamematch = 1;
}
else{
	#fail case
}
#create else case for only user
if($password == $_POST['passwordretype'] && (strlen($_POST['username'])) != 0 && (strlen($_POST['password'])) != 0 && $usernamematch ==0){
	$sql = "insert into useraccount ".
	"(user, password)".
	"values".
	"('$username','$password')";
	$result = mysql_query($sql);
	if(! $result){
		die("could not get data: ". mysql_error());
	}
}
else if ($usernamematch == 1){
	echo "this username has been taken<br>";
}
else {
	echo "passwords do not match";
}
echo "<a href = 'mysql.php'>Already have an account?</a>";
*/
?>
