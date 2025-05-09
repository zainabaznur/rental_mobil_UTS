<?php
require_once 'Config/DB.php';

class Peminjaman
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT 
            p.id, p.nama_peminjam, p.ktp_peminjam, p.keperluan_pinjaman, 
            p.mulai, p.selesai, p.biaya, p.kontnr_peminjam, p.status_pinjaman,
            a.merk as nama_armada
            FROM peminjaman p
            LEFT JOIN armada a ON a.id = p.armada_id
        ");
        $data = $stmt->fetchAll();

        return $data;
    }

    public function show($id)
    {
        $stmt = $this->pdo->query("SELECT 
            p.id, p.nama_peminjam, p.ktp_peminjam, p.keperluan_pinjaman, 
            p.mulai, p.selesai, p.biaya, p.kontnr_peminjam, p.status_pinjaman, p.armada_id,
            a.merk as nama_armada
            FROM peminjaman p
            LEFT JOIN armada a ON a.id = p.armada_id
            WHERE p.id = $id
        ");
        $data = $stmt->fetch();
        return $data;
    }

    public function create($data)
    {
        $sql = "INSERT INTO peminjaman (nama_peminjam, ktp_peminjam, keperluan_pinjaman, mulai, selesai, biaya, kontnr_peminjam, status_pinjaman, armada_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['nama_peminjam'],
            $data['ktp_peminjam'],
            $data['keperluan_pinjaman'],
            $data['mulai'],
            $data['selesai'],
            $data['biaya'],
            $data['kontnr_peminjam'],
            $data['status_pinjaman'],
            $data['armada_id']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE peminjaman SET nama_peminjam=:nama_peminjam, ktp_peminjam=:ktp_peminjam, keperluan_pinjaman=:keperluan_pinjaman, mulai=:mulai, selesai=:selesai, biaya=:biaya, kontnr_peminjam=:kontnr_peminjam, status_pinjaman=:status_pinjaman, armada_id=:armada_id WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':nama_peminjam', $data['nama_peminjam']);
        $stmt->bindParam(':ktp_peminjam', $data['ktp_peminjam']);
        $stmt->bindParam(':keperluan_pinjaman', $data['keperluan_pinjaman']);
        $stmt->bindParam(':mulai', $data['mulai']);
        $stmt->bindParam(':selesai', $data['selesai']);
        $stmt->bindParam(':biaya', $data['biaya']);
        $stmt->bindParam(':kontnr_peminjam', $data['kontnr_peminjam']);
        $stmt->bindParam(':status_pinjaman', $data['status_pinjaman']);
        $stmt->bindParam(':armada_id', $data['armada_id']);
        $stmt->bindParam(':id', $id);
        
        $stmt->execute();
        return $this->show($id);
    }

    public function delete($id)
    {
        $row = $this->show($id);
        $sql = "DELETE FROM peminjaman WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $row;
    }
}

$peminjaman = new Peminjaman($pdo);