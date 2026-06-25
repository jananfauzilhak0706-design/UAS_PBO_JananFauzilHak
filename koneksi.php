<?php

class Koneksi {
    // Properti konfigurasi database MySQL
    private $host     = "localhost";
    private $username = "root";
    private $password = "";
    // Nama database wajib sesuai instruksi UAS kamu
    private $database = "DB_UAS_PBO_TI1D_JananFauzilHak"; 
    protected $conn;

    /**
     * Constructor otomatis berjalan saat objek dibuat (new Koneksi())
     * Berfungsi untuk membuka gerbang koneksi langsung ke MySQLi
     */
    public function __construct() {
        // Menginisialisasi koneksi dengan mode Object-Oriented
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        // Memeriksa jika koneksi ke MySQL mengalami kegagalan
        if ($this->conn->connect_error) {
            die("<div style='color:red; padding:20px; background:#ffe4e6; font-family:sans-serif;'>
                    <strong>Koneksi Database UAS Gagal:</strong> " . $this->conn->connect_error . "
                 </div>");
        }
    }

    /**
     * Method Getter untuk mengambil objek koneksi internal secara bersih
     * @return mysqli
     */
    public function getConn() {
        return $this->conn;
    }
}