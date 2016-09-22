<?php
for($i = $_POST['minid'];$i<$_POST['maxid'];$i++){
	if(isset($_POST['reply'.$i])){
		break;
	}
}

echo "<form action=redir.php method=post>";
echo "reply: <br><textarea rows = '5' cols = '50' name = body></textarea><br>";
echo "<input type= hidden name = id value = ".$_POST['userid'.$i]." >";
echo "<input type=hidden name=parentid value=".$i.">";
echo "<input type=hidden name=title value=".null.">";

echo "<input type=submit name = create value = 'reply'><br>";
?>
