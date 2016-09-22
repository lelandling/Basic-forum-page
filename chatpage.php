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
	$parentid = 0;
	if(isset($_POST['title'])){
		$title = $_POST['title'];
	}
	else{
		$title = 'null';
	}
	$body = $_POST['body'];
	$querycommand = "insert into forumchatpage (userid, timestamp, text, parentid, title) values ('$userid', '$timestamp', '$body', '$parentid', '$title')";
	echo "<br>";
	echo $querycommand;
	echo "<br>";
	$mysqlcommand = mysql_query($querycommand);
	if(! $mysqlcommand){
		die("could not get data: ". mysql_error());
	}
}


?>
<?php
print_r($_POST);

echo "<form action=redir.php method=post>";
echo "title: <br><input type=text name = title><br>";
echo "body: <br><textarea rows = '5' cols = '50' name = body></textarea><br>";
echo "<input type=hidden name = parentid value = 0>";
echo "<input type=submit name = create value = 'create'><br>";

if(isset($userid)){
	echo "<input type = hidden name = id value = ".$userid.">";
}
echo "</form>";

$result = mysql_query("select userid, msgid, parentid, text, title from forumchatpage");
if(! $result){
	die("could not get data: ". mysql_error());
}

$array = array();
$intermediatearray = array();
while ($row = mysql_fetch_array($result)) {
    $userpriority=new stdClass();
    $userpriority->userid=$row['userid'];
    $userpriority->msgid=$row['msgid'];
    $userpriority->parentid=$row['parentid'];
    $userpriority->text=$row['text'];
    $userpriority->title=$row['title'];
    $username = mysql_query("select user from useraccount where id = ".$row['userid']."");
    if($usernames = mysql_fetch_array($username)){
    	$userpriority->username=$usernames['user'];	
    }
    
    $array[] = $userpriority;
    $intermediatearray[$row['msgid']] = $row['parentid'];
}

$minid =999999999999;
$maxid =0;
$x = 0;
foreach($array as $value){
	$value->parentid=array();
	$priority = $value->msgid;
	while($priority != 0){
		array_unshift($value->parentid, $priority);
		$priority = $intermediatearray[$priority];
	}
	if($minid>$value->msgid){
		$minid=$value->msgid;
	}
	if($maxid<$value->msgid){
		$maxid=$value->msgid;
    }
    if($x<count($value->parentid)){
    	$x = count($value->parentid);	
    }


}
usort($array, 'cmp');
	echo "<table border = 1 width='600'><tr>";

foreach($array as $value){
	for($i = 1; $i < count($value->parentid); $i++){
		echo "&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;";
	}
	$padding = 16*(count($value->parentid) +1);
	echo "_";
	echo $value->username.": ";
	echo $value->title;
	echo "<br>";
	echo "<form action=reply.php method=post>";
	
	
	$collumnspan = 2;
	$output1 = $value->username;
	$output2 = $value->title;
	$output3 = "<input type=submit name = reply".$value->msgid." value=reply><br>";
	$output4 = $value->text;
	for($y = 0; $y < $x+1; $y++){
		if(count($value->parentid)+2 == $y){
			echo "<td width = '0' valign='top' colspan = '".$collumnspan."'>";
		}
		else{
			echo "<td width = '0' valign='top'>";
		}
		if(count($value->parentid) == $y){
				echo $output1;
		}
		if(count($value->parentid)+1 == $y){
				echo $output2;
		}
		if(count($value->parentid)+2 == $y){
				echo $output3;
			
		}
		if(count($value->parentid)+3 == $y){
				echo $output4;
			break;
		}
		
		echo "</td>";
}
echo "<br>";
	echo "</td coll><td style = 'padding-left:10' width = '1000'>".$value->text;
	echo "</td></tr>";
		echo "0".count($value->parentid);

	if(count($value->parentid) == 0){
		echo "<br>";
	}
	
	#for($i = 1; $i < (count($value->parentid) +1); $i++){
	#	echo "&nbsp;&nbsp;&nbsp;&nbsp";
	#}
	echo "<input type= hidden name = userid".$value->msgid." value = ".$userid." >";
	echo "<input type= hidden name = msgid".$value->msgid." value = ".$value->msgid." >";
	echo "<input type=hidden name = minid value = ".$minid.">";
	echo "<input type hidden name = maxid value = ".$maxid.">";
	
}
echo "</table>";


?>
<?php
// Comparison function
function cmp($a, $b) {
	$a1 = count($a->parentid);
	$b1 = count($b->parentid);
	if ($a1<$b1){
		$c = $a1;
	}
	if ($a1>=$b1){
		$c = $b1;
	}
	
	$returnvalue = 0;
	for($i = 0; $i<$c;$i++){
		if($a->parentid[$i]> $b->parentid[$i]){
			$returnvalue = 1;
			break;
		}
		if($a->parentid[$i] < $b->parentid[$i]){
			$returnvalue = -1;	
			break;
		}
	}
	if($a1 > $b1 && $returnvalue == 0){
		$returnvalue = 1;
	}
	if($a1 < $b1 && $returnvalue == 0){
		$returnvalue = -1;	
	}
	return $returnvalue;	
    
}


?>