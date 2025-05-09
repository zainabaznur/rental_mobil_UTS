<?php
require_once 'Controllers/Armada.php';
require_once 'Helpers/helper.php';

// Inisialisasi objek Armada
$armada = new Armada($pdo);

// Ambil semua data armada
$list_armada = $armada->index();

// Proses penghapusan data
if (isset($_POST['type'])) {
  if ($_POST['type'] == 'delete') {
    $row = $armada->delete($_POST['id']);
    echo "<script>alert('Data armada dengan merk {$row['merk']} berhasil dihapus')</script>";
    echo "<script>window.location='?url=armada'</script>";
  }
}
?>

<div class="container">
  <div class="card">
    <div class="card-body">
      <div class="mb-2">
        <a class="btn btn-success btn-sm" href="?url=armada-input">
          Tambah Armada
        </a>
      </div>

      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Merk</th>
            <th>Nomor Polisi</th>
            <th>Tahun Beli</th>
            <th>Deskripsi</th>
            <th>Jenis Kendaraan</th>
            <th>Kapasitas Kursi</th>
            <th>Rating</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($list_armada as $row): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($row['merk']) ?></td>
              <td><?= htmlspecialchars($row['nopol']) ?></td>
              <td><?= htmlspecialchars($row['thn_beli']) ?></td>
              <td><?= htmlspecialchars($row['deskripsi']) ?></td>
              <td><?= htmlspecialchars($row['jenis_kendaraan']) ?></td>
              <td><?= htmlspecialchars($row['kapasitas_kursi']) ?></td>
              <td><?= htmlspecialchars($row['rating']) ?></td>
              <td>
                <div class="d-flex">
                  <a href="?url=armada-input&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning mr-2">Edit</a>
                  <form action="" method="post" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="hidden" name="type" value="delete">
                    <button class="btn btn-sm btn-danger">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr>
            <th>No</th>
            <th>Merk</th>
            <th>Nomor Polisi</th>
            <th>Tahun Beli</th>
            <th>Deskripsi</th>
            <th>Jenis Kendaraan</th>
            <th>Kapasitas Kursi</th>
            <th>Rating</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>