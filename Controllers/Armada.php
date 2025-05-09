<?php
require_once 'Config/DB.php';

class Armada
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Mengambil semua data armada
    public function index()
    {
        $stmt = $this->pdo->query("SELECT 
            a.*, jk.nama as jenis_kendaraan
            FROM armada a
            LEFT JOIN jenis_kendaraan jk ON jk.id = a.jenis_kendaraan_id
        ");
        return $stmt->fetchAll();
    }

    // Mengambil data armada berdasarkan ID
    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT 
            a.*, jk.nama as jenis_kendaraan
            FROM armada a
            LEFT JOIN jenis_kendaraan jk ON jk.id = a.jenis_kendaraan_id
            WHERE a.id = :id
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Menambahkan data armada baru
    public function create($data)
    {
        try {
            $sql = "INSERT INTO armada (merk, nopol, thn_beli, deskripsi, jenis_kendaraan_id, kapasitas_kursi, rating) 
                    VALUES (:merk, :nopol, :thn_beli, :deskripsi, :jenis_kendaraan_id, :kapasitas_kursi, :rating)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':merk', $data['merk']);
            $stmt->bindParam(':nopol', $data['nopol']);
            $stmt->bindParam(':thn_beli', $data['thn_beli'], PDO::PARAM_INT);
            $stmt->bindParam(':deskripsi', $data['deskripsi']);
            $stmt->bindParam(':jenis_kendaraan_id', $data['jenis_kendaraan_id'], PDO::PARAM_INT);
            $stmt->bindParam(':kapasitas_kursi', $data['kapasitas_kursi'], PDO::PARAM_INT);
            $stmt->bindParam(':rating', $data['rating'], PDO::PARAM_INT);
            $stmt->execute();
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    // Memperbarui data armada berdasarkan ID
    public function update($id, $data)
    {
        try {
            $sql = "UPDATE armada 
                    SET merk = :merk, nopol = :nopol, thn_beli = :thn_beli, deskripsi = :deskripsi, 
                        jenis_kendaraan_id = :jenis_kendaraan_id, kapasitas_kursi = :kapasitas_kursi, rating = :rating 
                    WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':merk', $data['merk']);
            $stmt->bindParam(':nopol', $data['nopol']);
            $stmt->bindParam(':thn_beli', $data['thn_beli'], PDO::PARAM_INT);
            $stmt->bindParam(':deskripsi', $data['deskripsi']);
            $stmt->bindParam(':jenis_kendaraan_id', $data['jenis_kendaraan_id'], PDO::PARAM_INT);
            $stmt->bindParam(':kapasitas_kursi', $data['kapasitas_kursi'], PDO::PARAM_INT);
            $stmt->bindParam(':rating', $data['rating'], PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $this->show($id);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    // Menghapus data armada berdasarkan ID
    public function delete($id)
    {
        try {
            $row = $this->show($id);
            $sql = "DELETE FROM armada WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $row;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}

$armada = new Armada($pdo);