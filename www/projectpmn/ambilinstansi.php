<?php
header('Access-Control-Allow-Origin: *');
$conn = mysqli_connect("localhost","root","","matawarga");
$sqlinstansi = "SELECT instansi_tujuan FROM kejadian";
$result = $conn->query($sqlinstansi);

if($result->num_rows >0){
	$instansi = array();
	$i = 0;
	while($obj = $result->fetch_assoc()){
		$instansi['instansion'][$i]['instansi_tujuan'] = addslashes(htmlentities($obj['instansi_tujuan']));
		$i++;
	}
	echo json_encode($instansi);
}else{
	echo "unable to process your request!";
	die();
}
$conn->close();
?>