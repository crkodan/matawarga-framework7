<?php
function connection(){
	$host = "localhost";
	$user = "root";
	$pwd = "";
	$database = "matawarga";

	$connect = mysqli_connect($host,$user,$pwd,$database) or die("Failed!".mysqli_connect_error($errorcon));
	return $connect;
}

function register($uname,$nama,$pwd,$salt){
	$con = connection();
	$sql= "INSERT INTO user VALUES('$uname','$nama','$pwd','$salt')";
	$stmt = mysqli_query($con,$sql) or die("Error!" .mysqli_error($con));
	return $stmt;
	mysqli_close($con);
}
function sameUser($uname){
	$con = connection();
	$sql="SELECT username FROM user WHERE username = '$uname'";
	$stmt = mysqli_query($con,$sql) or die("ERROR".mysqli_error($con));
	if (mysql_num_rows($stmt) > 0){
		return true;
	}
	else{
		return false;
	}
}
function login($uname,$pwd){
	$con = connection();
	$user = "SELECT nama,username,password,salt FROM user WHERE username = '$uname'";
	$stmt = mysqli_query($con,$user) or die ("ERROR".mysqli_error($con));
	$count = mysqli_num_rows($stmt);

	if($count == 1){
		while($row = mysqli_fetch_assoc($stmt)){
			$salt = $row['salt'];

			$com = $pwd.$salt;
			$pwdFinal = md5($com);
			if($pwdFinal == $row['password']){
				return "1";
			}
			return "0";
		}
	}
	else
	{
		echo "<p>Error ".mysqli_error($con)."</p>";
		return "0";
	}
}
// function searchUser($uname){
	// $con = connection();
	// $user = "SELECT username, nama FROM user WHERE usename='$uname'";
	// $stmt = mysqli_query($con,$user) or die ("ERROR".mysqli_error($con));

	// $count = mysqli_num_rows($stmt);
	// if($count > 0){
	// 	$row = mysqli_fetch_assoc($stmt);
	// 	$res['username'] = $row['username'];
	// 	$res['nama'] = $row['nama'];
	// 	// return $res;
	// }
	// else{
	// 	echo "<p> Tidak ada username tersebut! </p>";
	// }

//}

function addPost($username,$caption){
	$con = connection();
	$sqlPost = "INSERT INTO posting VALUES(null,'$username','NOW()','$caption')";
	$stmt = mysqli_query($sqlPost,$con) or die("ERROR!".mysqli_error($con));
	mysqli_close($con);
	$count = mysqli_num_rows($stmt);
	if($count == 0){
		$id = array('idposting' => '0');
	}
	else
	{
		while($row = mysqli_fetch_assoc($stmt)){
			$id = array('idposting' => $row['idposting']);
		}
	}
	return $id;
}
function addGambar($idPost, $ext){
	$con - connection();
	$sqlGambar = "INSERT INTO gambar VALUES(null,'$idPost', $ext)";
	$stmt = mysqli_query($sqlGambar,$con) or die ("ERROR!".mysqli_error($con));
	mysqli_close($con);
	$count = mysqli_num_rows($stmt);
	if($count >0){
		while($row = mysqli_fetch_assoc($stmt)){

		}
	}
}
?>