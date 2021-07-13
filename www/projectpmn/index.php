<?php
header("Access-Control-Allow-Origin:*");

$c = new mysqli("localhost","root","","matawarga");
if($c->connect_error){
	echo "Unable to connect, please try again";
	die();
}

$sql1 = "SELECT * FROM kejadian ORDER BY tanggal DESC";
$result = $c->query($sql1);

if($result->num_rows >0){
	$kejadian = array();
	$i = 0;
	while($obj = $result->fetch_assoc()){
		$kejadian['kejadians'][$i]['id'] = addslashes(htmlentities($obj['idkejadian']));
		$kejadian['kejadians'][$i]['username']= addslashes(htmlentities($obj['username']));
		$kejadian['kejadians'][$i]['judul'] = addslashes(htmlentities($obj['judul']));
		$kejadian['kejadians'][$i]['deskripsi'] = addslashes(htmlentities($obj['deskripsi']));
		$kejadian['kejadians'][$i]['instansi_tujuan'] = addslashes(htmlentities($obj['instansi_tujuan']));
		$kejadian['kejadians'][$i]['tanggal'] = addslashes(htmlentities($obj['tanggal']));
		$idkej = $kejadian['kejadians'][$i]['id'];
		$sqlCL = 
		"SELECT COUNT(*) AS jumlahlike FROM like_kejadian WHERE idkejadian = '$idkej'";
		$resultLike = $c->query($sqlCL);
		if($objLike = $resultLike->fetch_assoc()){
			$kejadian['kejadians'][$i]['jumlahlike'] = addslashes(htmlentities($objLike['jumlahlike']));
		}
		$sqlCK = 
		"SELECT COUNT(*) AS jumlahkomen FROM komen_kejadian WHERE idkejadian = '$idkej'";
		$resultKomen = $c->query($sqlCK);
		if($objKomen = $resultKomen->fetch_assoc()){
			$kejadian['kejadians'][$i]['jumlahkomen'] = addslashes(htmlentities($objKomen['jumlahkomen']));
		}
		$sqlgambar = "SELECT * FROM gambar_kejadian WHERE idkejadian = '$idkej'";
		$resultGambar = $c->query($sqlgambar);
		if($resultGambar->num_rows >0){
			while($objGambar = $resultGambar->fetch_assoc()){
				// $kejadian['kejadians'][$i]['idgambar'] = addslashes(htmlentities($objGambar['idgambar']));
				// $kejadian['kejadians'][$i]['extension'] = addslashes(htmlentities($objGambar['extension']));
		        $kejadian['kejadians'][$i]['gambar'] = addslashes(htmlentities("http://192.168.1.55/projectpmn/images/".$objGambar['idgambar'].$objGambar['extension']));
			}
		}
		$i++;
	}
	echo json_encode($kejadian);
} else{
	echo "UNABLE TO PROCESS YOUR REQUEST, PLEASE TRY AGAIN";
	die();
}
$c->close();
?>