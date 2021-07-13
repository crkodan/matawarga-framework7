<?php
header("Access-Control-Allow-Origin:*");
$uname = $_POST['uname'];
$name = $_POST['nama'];
$pwd = md5($_POST['password']);
$pin = md5($_POST['pin']);
// $username = "kopi";
// $name = "kopi";
// $pwd = md5("luwak");
// $pin = md5("luwak");
$conn = new mysqli("localhost","root","","matawarga");

if($conn->connect_error){
	die("Connection failed : ". $conn->connect_error);
}
$sql= "INSERT INTO user VALUES('$uname','$name','$pwd','$pin')";

if($conn->query($sql) === TRUE){
	echo "success! Welcome ".$name;
}
else{
	echo "Error: ".$conn->error;
}
$conn->close();
?>