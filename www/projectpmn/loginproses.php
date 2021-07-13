<?php
include("mainclass.php");
header("Access-Control-Allow-Origin:*");
$username = $_POST['username'];
$password = md5($_POST['password']);
$conn = mysqli_connect("localhost","root","","matawarga");

if($conn->connect_error){
	echo "Connection failed : ". $conn->connect_error;
	die();
}

$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
$res = $conn->query($sql);

if($res->num_rows > 0){
	$users = array();
	$i =0;
	while($obj = $res->fetch_assoc()){
		echo "1";
		echo $obj['username'];
		$i++;
		// $users[$i]['username'] = addslashes(htmlentities($obj['username']));
		// $users[$i]['nama'] = addslashes(htmlentities($obj['username']));
		// $i++;
	}
	// echo json_encode($users);
} else{
	echo "ERROR CONNECTION";
	die();
}
$conn->close();
?>