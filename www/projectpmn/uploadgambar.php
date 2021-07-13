<?php
header('Access-Control-Allow-Origin: *');
$conn = mysqli_connect("localhost","root","","matawarga");

$new_image_name = $_POST['params1'];
$ext = ".jpeg";
move_uploaded_file($_FILES["photo"]["tmp_name"], "images/".$new_image_name.$ext);

// $id = $_POST['idkejadian'];
$sql = "INSERT INTO gambar_kejadian(idkejadian,extension) VALUES('$new_image_name','$ext')";
$res = $conn->query($sql);
// if($res === TRUE){
// 	echo "success! gambar ".$new_image_name." ter upload";
// }
// else{
// 	echo "Error: ".$conn->error;
// }
$conn->close();
?>