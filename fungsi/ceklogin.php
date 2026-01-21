<?php  

	if (isset($_SESSION['login'])) {
		if ($_SESSION['level'] == "instansi") {
			header("location:instansi/index.php");
		} else if ($_SESSION['level'] == "bendahara"){
			header("location:bendahara/index.php");
		} else if ($_SESSION['level'] == "it"){
			header("location:it/index.php");
		} else {
			header("location:index.php");
		}
	}

?>