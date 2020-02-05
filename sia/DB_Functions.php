<?php

class DB_Functions {
	private $conn;

	// constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // koneksi ke database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }

    // destructor
    function __destruct() {
         
    }

    public function getDosenByEmailAndPassword($user, $password) {
 
		if ($stmt = $this->conn->prepare("SELECT * FROM passwordpegawai WHERE user = ? AND password = ?")) {
 
			$stmt->bind_param("ss", $user, $password);
 
			if ($stmt->execute()) {
				$dosen = $stmt->get_result()->fetch_assoc();
				$stmt->close();
 
				// verifikasi password user
				/*$salt = $user['salt'];
				$encrypted_password = $user['encrypted_password'];
				$hash = $this->checkhashSSHA($salt, $password);
				// cek password jika sesuai
				if ($encrypted_password == $hash) {
					// autentikasi user berhasil
					return $user;
				}*/
				return $dosen;
			} else {
				return NULL;
			}
		}
    }

	public function ubahPassword($user, $passwordbaru) {
		
		if ($stmt = $this->conn->prepare("UPDATE passwordpegawai SET password = ? WHERE user = ?")) {
			
			$stmt->bind_param("ss", $passwordbaru, $user);
			
			if ($stmt->execute()) {
				$stmt->close();
				
				//echo "Password berhasil diubah";
				return true;
			} else {
				echo "Gagal mengubah password";
				//return false;
			}
		}
		
	}

	public function getDosen($kode_pegawai){

		if ($stmt = $this->conn->prepare("SELECT * FROM pegawai WHERE kode_pegawai = ?")) {
			
			$stmt->bind_param("s", $kode_pegawai);

			if ($stmt->execute()) {
				$dsn = $stmt->get_result()->fetch_assoc();
				$stmt->close();

				return $dsn;
			}else{
				return NULL;
			}
		}
	}

	public function updateBiodata($kode_pegawai){
		
		if ($stmt = $this->conn->prepare("UPDATE pegawai SET glr_dpn = ?, glr_blk = ? WHERE kode_pegawai = ?")) {
			
			$stmt->bind_param("sss", $glr_dpn, $glr_blk, $kode_pegawai);
			
			if ($stmt->execute()) {
				$stmt->close();
				
				//echo "Password berhasil diubah";
				return true;
			} else {
				echo "Gagal update biodata";
				//return false;
			}
		}
	}

	/**
     * Get jenis kelamin berdasarkan kodePegawai
     */
    public function getJenisKelamin($kodePegawai) {
		
		//SELECT concat(status, ' ', nama_kabupaten) as kab FROM `kabupaten` WHERE kode_kabupaten = '1111' 
 
		if ($stmt = $this->conn->prepare("SELECT nama_sex FROM acuan.sex s INNER JOIN sdm.pegawai p ON p.kode_sex = s.kode_sex WHERE p.kode_pegawai = ?")) {
 
			$stmt->bind_param("s", $kodePegawai);
 
			if ($stmt->execute()) {
				$jeniskelamin = $stmt->get_result()->fetch_assoc();
				$stmt->close();
				
				return $jeniskelamin;
			} else {
				return NULL;
			}
		}
    }

    /**
     * Get status keluar berdasarkan kodePegawai
     */
    public function getStatusKeluar($kodePegawai) {
		
		//SELECT concat(status, ' ', nama_kabupaten) as kab FROM `kabupaten` WHERE kode_kabupaten = '1111' 
 
		if ($stmt = $this->conn->prepare("SELECT nama_status_keluar FROM acuan.status_keluar s INNER JOIN sdm.pegawai p ON p.kode_status_keluar = s.kode_status_keluar WHERE p.kode_pegawai = ?")) {
 
			$stmt->bind_param("s", $kodePegawai);
 
			if ($stmt->execute()) {
				$statuskeluar = $stmt->get_result()->fetch_assoc();
				$stmt->close();
				
				return $statuskeluar;
			} else {
				return NULL;
			}
		}
    }

    /**
     * Get status keluar berdasarkan kodePegawai
     */
    public function getStatusPegawai($kodePegawai) {
		
		//SELECT concat(status, ' ', nama_kabupaten) as kab FROM `kabupaten` WHERE kode_kabupaten = '1111' 
 
		if ($stmt = $this->conn->prepare("SELECT nama_stats_pegawai FROM acuan.status_pegawai s INNER JOIN sdm.pegawai p ON p.kode_status_pegawai = s.kode_status_pegawai WHERE p.kode_pegawai = ?")) {
 
			$stmt->bind_param("s", $kodePegawai);
 
			if ($stmt->execute()) {
				$statuspegawai = $stmt->get_result()->fetch_assoc();
				$stmt->close();
				
				return $statuspegawai;
			} else {
				return NULL;
			}
		}
    }
}

?>