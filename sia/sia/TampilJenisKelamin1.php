<?php
require_once 'DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['nama_sex'])) {
 
    // menerima parameter kode pegawai
    $nama_sex = $_POST['nama_sex'];
 
    // get mahasiswa
    $sex = $db->getJenisKelamin1($nama_sex);
 
    if ($sex != false) {
        // user ditemukan
        $response["error"] = FALSE;
        $response["jenis_kelamin"] = $sex["kode_sex"];
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