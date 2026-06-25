<?php

// Menggunakan kata kunci 'abstract' sebagai blueprint utama
abstract class Mahasiswa {
    
    // Properti/Atribut Terenkapsulasi (protected)
    protected $id_mahasiswa;
    protected $nama_mahasiswa;
    protected $nim;
    protected $semester;
    protected $tarifUktNominal; // Menggunakan camelCase sesuai instruksi

    /**
     * Constructor untuk memetakan (mapping) nilai properti secara pas
     * dari kolom tabel database 'tabel_mahasiswa' (Tahap 1)
     * @param array $dataRow - Berisi satu baris data hasil fetch_assoc() dari database
     */
    public function __construct($dataRow) {
        $this->id_mahasiswa    = isset($dataRow['id_mahasiswa']) ? $dataRow['id_mahasiswa'] : null;
        $this->nama_mahasiswa  = isset($dataRow['nama_mahasiswa']) ? $dataRow['nama_mahasiswa'] : '-';
        $this->nim             = isset($dataRow['nim']) ? $dataRow['nim'] : '-';
        $this->semester        = isset($dataRow['semester']) ? $dataRow['semester'] : 0;
        $this->tarifUktNominal = isset($dataRow['tarif_ukt_nominal']) ? $dataRow['tarif_ukt_nominal'] : 0;
    }

    // ====================================================================
    // METODE ABSTRAK (Wajib tanpa isi/body {} dan harus di-override di kelas anak)
    // ====================================================================
    abstract public function hitungTagihanSemester();
    abstract public function tampilkanSpesifikasiAkademik(); 

    /**
     * Metode reguler (konkrit) untuk mencetak informasi data dasar mahasiswa
     */
    public function infoDasarMahasiswa() {
        echo "<strong>NIM:</strong> " . $this->nim . "<br>";
        echo "<strong>Nama Mahasiswa:</strong> " . $this->nama_mahasiswa . "<br>";
        echo "<strong>Semester:</strong> " . $this->semester . "<br>";
        echo "<strong>Tarif UKT Dasar:</strong> Rp " . number_format($this->tarifUktNominal, 0, ',', '.') . "<br>";
    }
}