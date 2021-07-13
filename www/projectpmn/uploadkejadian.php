<?php
header('Access-Control-Allow-Origin: *');
$conn = mysqli_connect("localhost","root","","matawarga");

$username = $_GET['username'];
$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];
$instansi = $_POST['instansi'];
$tanggal = $_POST['tanggal'];

$sql = "INSERT INTO kejadian(username,judul,deskripsi,instansi_tujuan,tanggal) VALUES ('$username','$judul','$deskripsi','$instansi','$tanggal')";
if($conn->query($sql) === TRUE){
	$slct = "SELECT MAX(idkejadian) AS idkejadian FROM kejadian";
	$ambil = $conn->query($slct);
	$obj = $ambil->fetch_assoc();
	echo $obj['idkejadian'];
}
else{
	echo "Error: ".$conn->error;
}
$conn->close();
?>