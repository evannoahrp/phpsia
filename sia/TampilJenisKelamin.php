<?php
require_once 'DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['kode_pegawai'])) {
 
    // menerima parameter kode pegawai
    $kode_pegawai = $_POST['kode_pegawai'];
 
    // get mahasiswa
    $sex = $db->getJenisKelamin($kode_pegawai);
 
    if ($sex != false) {
        // user ditemukan
        $response["error"] = FALSE;
        $response["jenis_kelamin"] = $sex["nama_sex"];
        echo json_encode($response);
    } else {
        // user tidak ditemukan password/email salah
        $response["error"] = TRUE;
        $response["error_msg"] = "Gagal mengambil data";
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Gagal mengambil data";
    echo json_encode($response);
}
?>