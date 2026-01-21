<?php
session_start();


include "fungsi/koneksi.php";
include "fungsi/ceklogin.php";


$err="";

if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$level = $_POST['level'];
	$jabatan = $_POST['jabatan'];

	$query = "SELECT * FROM user WHERE username='$username' && password='$password'";
	$hasil = mysqli_query($koneksi, $query);
	
	if (!$hasil) {
		echo "ada error";
	} 

	if (mysqli_num_rows($hasil) == 0) {
		$err="
		<div class='row' style='margin-top: 15px';>
		<div class='col-md-12'>
		<div class='box box-solid bg-red'>
		<div class='box-header'>
		<h3 class='box-title'>Login Gagal!</h3>
		</div>
		<div class='box-body'>
		<p>Username atau password yang anda masukan salah.</p>
		</div>
		</div>
		</div>
		</div>
		</div>";
	} else {
		$row = mysqli_fetch_array($hasil);
		$_SESSION['username'] = $row['username'];
		$_SESSION['jabatan'] = $row['jabatan'];
		$_SESSION['level'] = $row['level'];

		if($row['level'] == "instansi" && $level == "instansi"  ) {
			$_SESSION['login'] = true;
			header("location:instansi/index.php");
		} else if ($row['level'] == "bendahara" && $level == "bendahara" ) {
			$_SESSION['login'] = true;
			header("location:bendahara/index.php");
			
		} else if ($row['level'] == "it" && $level == "it") {
			$_SESSION['login'] = true;
			header("location:it/index.php");

		} else {
			$err="
			<div class='row' style='margin-top: 15px';>
			<div class='col-md-12'>
			<div class='box box-solid bg-red'>
			<div class='box-header'>
			<h3 class='box-title'>Login Gagal!</h3>
			</div>
			<div class='box-body'>
			<p>Anda salah memilih level login.</p>
			</div>
			</div>
			</div>
			</div>
			</div>";
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>BPJSTK Banda Aceh</title>
	<!-- Icon  -->
	<link rel="shortcut icon" href="bpjstk.png">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/bootstrap/css/custom.css" rel="stylesheet">
	<link href="assets/dist/css/AdminLTE.min.css" rel="stylesheet" >
	<link href="assets/plugins/iCheck/square/blue.css" rel="stylesheet">
	<link href="assets/fa/css/font-awesome.min.css" rel="stylesheet">
	 
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">        
		</div><!-- /.login-logo -->

		<div class="login-box-body">
			<h3 class="text-center">BPJS<br>KETENAGAKERJAAN<br>BANDA ACEH</h3>
			<img src="gambar/bpjstk.png" style="width: 100px; height: 100px;">        
			<form method="post">
				<div class="form-group">           	
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input type="text" class="form-control" placeholder="Username" name="username" required  />	            
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-unlock"></i></span>
						<input  type="password" class="form-control" placeholder="Password" name="password"  required>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group col-md-7">          	
						<span class="input-group-addon"><i class="fa fa-shield"></i></span>
						<select class="form-control" name="level" required>            	
							<option value>[Pilih Level]</option>
							<option value="instansi">Pegawai </option>
							<option value="bendahara">Bendahara</option>

						</select>
					</div>            
				</div>
				<div class="row">
					<div class="col-xs-12">
						<input type="submit" class="btn btn-primary btn-block btn-flat pull-right" value="Login" name="login"/>

					</div><!-- /.col -->
				</div>
			</form>


		</div>
		<?= $err; ?>
      <!-- /.login-box-body 
      <div class="row" style="margin-top: 15px;">
	       <div class="col-md-12">
	        	<div class="box box-solid bg-red">
	        		<div class="box-header">
	        			<h3 class="box-title">Gagal Login</h3>
	        		</div>
	        		<div class="box-body">
	        			<p>Username atau password salah</p>
	        		</div>
	        	</div>
	        </div>
        </div>
    </div>
-->     
<!-- /.login-box -->

<script src="assets/plugins/jQuery/jquery.min.js" type="text/javascript"></script>
<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<body class="hold-transition login-page" style="background:url(gambar/bpjs.png)
no-repeat center center fixed; background-size: cover;
 -webkit-background-size: cover; 
 -moz-background-size: cover; -o-background-size: cover;">
 <style>
.floatwa {

bottom:0px;
right: 0px;
background-color:#ffffff;
width:100%;
z-index:1000;
padding:2px;
margin:auto;
text-align:center;
float:none;
box-shadow: 0px -2px 10px #c0c0c0;
}
.tombolwa {
border: 1px #56aa71 solid;
background-color:#2f7e49;
width:90%;
padding:4px;
text-align:center;
margin:0;
border-radius: 5px;
margin:auto;
text-align:center;
float:none;
}
.floatwa a{
color:white;
}
</style>
<div class="floatwa">
<a href="https://api.whatsapp.com/send?phone=6282261930252&amp;text=Halo%20,%20Saya%20butuh%20bantuan nih" target="_blank"><div class="tombolwa">BUTUH BANTUAN ?</div></a></div>
</body>
</html>
