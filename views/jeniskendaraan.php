<?php
require_once 'Controllers/JenisKendaraan.php';
require_once 'Helpers/helper.php';

// Inisialisasi objek JenisKendaraan
$jeniskendaraan = new JenisKendaraan($pdo);

// Ambil semua data jenis kendaraan
$list_jenis_kendaraan = $jeniskendaraan->index();

// Proses penghapusan data
if (isset($_POST['type'])) {
  if ($_POST['type'] == 'delete') {
    $row = $jeniskendaraan->delete($_POST['id']);
    echo "<script>alert('Data jenis kendaraan {$row['nama']} berhasil dihapus')</script>";
    echo "<script>window.location='?url=jeniskendaraan'</script>";
  }
}
?>

<div class="container">
  <div class="card">
    <div class="card-body">
      <div class="mb-2">
        <a class="btn btn-success btn-sm" href="?url=jeniskendaraan-input">
          Tambah Jenis Kendaraan
        </a>
      </div>

      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Jenis Kendaraan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($list_jenis_kendaraan as $row): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($row['nama']) ?></td>
              <td>
                <div class="d-flex">
                  <a href="?url=jeniskendaraan-input&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning mr-2">Edit</a>
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
            <th>Nama Jenis Kendaraan</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>