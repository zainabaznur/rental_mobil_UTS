<?php
require_once 'Config/DB.php';

class JenisKendaraan
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Mengambil semua data jenis kendaraan
    public function index()
    {
        $stmt = $this->pdo->query("SELECT * FROM jenis_kendaraan");
        $data = $stmt->fetchAll();
        return $data;
    }

    // Mengambil data jenis kendaraan berdasarkan ID
    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM jenis_kendaraan WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch();
        return $data;
    }

    // Menambahkan data jenis kendaraan baru
    public function create($data)
    {
        $sql = "INSERT INTO jenis_kendaraan (nama) VALUES (:nama)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    // Memperbarui data jenis kendaraan berdasarkan ID
    public function update($id, $data)
    {
        $sql = "UPDATE jenis_kendaraan SET nama = :nama WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $this->show($id);
    }

    // Menghapus data jenis kendaraan berdasarkan ID
    public function delete($id)
    {
        $row = $this->show($id);
        $sql = "DELETE FROM jenis_kendaraan WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $row;
    }
}

$jeniskendaraan = new JenisKendaraan($pdo);