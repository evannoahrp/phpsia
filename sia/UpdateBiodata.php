<?php
require_once 'DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);

if (isset($_POST['kode_pegawai'])&&isset($_POST['glr_dpn'])&&isset($_POST['glr_blk'])) {
	
	$kode_pegawai = $_POST['kode_pegawai'];
	$glr_dpn = $_POST['glr_dpn'];
	$glr_blk = $_POST['glr_blk'];

	$dosen = $db->getDosen($kode_pegawai);

	if ($dosen != false) {
		
	}
}

?>