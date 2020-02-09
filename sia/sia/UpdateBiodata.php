<?php
require_once 'DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);

if (isset($_POST['kode_pegawai'])&&isset($_POST['glr_dpn'])&&isset($_POST['glr_blk'])&&isset($_POST['nik'])&&isset($_POST['npwp'])&&isset($_POST['alamat_skr'])&&isset($_POST['telp_rumah'])&&isset($_POST['no_hp1'])&&isset($_POST['email1'])&&isset($_POST['tempat_lahir'])&&isset($_POST['tgl_lahir'])&&isset($_POST['kode_status_keluar'])&&isset($_POST['kode_status_pegawai'])&&isset($_POST['nidn'])&&isset($_POST['alamat_ktp'])&&isset($_POST['email2'])&&isset($_POST['no_hp2'])) {
	
	$kode_pegawai = $_POST['kode_pegawai'];
	$glr_dpn = $_POST['glr_dpn'];
	$glr_blk = $_POST['glr_blk'];
	$nik = $_POST['nik'];
	$npwp = $_POST['npwp'];
	$alamat_skr = $_POST['alamat_skr'];
	$telp_rumah = $_POST['telp_rumah'];
	$no_hp1 = $_POST['no_hp1'];
	$email1 = $_POST['email1'];
	$tempat_lahir = $_POST['tempat_lahir'];
	$tgl_lahir = $_POST['tgl_lahir'];
	$kode_status_keluar = $_POST['kode_status_keluar'];
	$kode_status_pegawai = $_POST['kode_status_pegawai'];
	$nidn = $_POST['nidn'];
	$alamat_ktp = $_POST['alamat_ktp'];
	$email2 = $_POST['email2'];
	$no_hp2 = $_POST['no_hp2'];

    $dosen = $db->getDosen($kode_pegawai);
 
    if ($dosen != false) {
        // dosen ditemukan
        $ubah = $db->updateBiodata($kode_pegawai, $glr_dpn, $glr_blk, $nik, $npwp, $alamat_skr, $telp_rumah, $no_hp1, $email1, $tempat_lahir, $tgl_lahir, $kode_status_keluar, $kode_status_pegawai, $nidn, $alamat_ktp, $email2, $no_hp2);
        $response["error"] = FALSE;
        $response["message"] = "Biodata berhasil diubah";
        echo json_encode($response);
    } else {
        $response["error"] = TRUE;
        $response["error_msg"] = "Gagal mengubah biodata. Dosen tidak ada";
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Gagal mengubah biodata.";
    echo json_encode($response);
}
?>