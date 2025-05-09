<?php
require_once 'Controllers/Peminjaman.php';
require_once 'Controllers/Armada.php';
require_once 'Helpers/helper.php';

$list_peminjaman = $peminjaman->index();
$peminjaman_id = isset($_GET['id']) ? $_GET['id'] : null;
$show_peminjaman = $peminjaman_id ? $peminjaman->show($peminjaman_id) : [];

$list_armada = $armada->index();

if (isset($_POST['type'])) {
  if ($_POST['type'] == 'delete') {
    $row = $peminjaman->delete($_POST['id']);
    echo "<script>alert('Data peminjaman oleh $row[nama_peminjam] berhasil dihapus')</script>";
    echo "<script>window.location='?url=peminjaman'</script>";
  }
}
?>

<div class="container">
  <div class="card">
    <div class="card-body">
      <div class="mb-2">
        <a class="btn btn-success btn-sm" href="?url=peminjaman-input">
          Tambah Peminjaman
        </a>
      </div>

      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>KTP</th>
            <th>Keperluan</th>
            <th>Mulai</th>
            <th>Selesai</th>
            <th>Biaya</th>
            <th>Armada</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($list_peminjaman as $row): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $row['nama_peminjam'] ?></td>
              <td><?= $row['ktp_peminjam'] ?></td>
              <td><?= $row['keperluan_pinjaman'] ?></td>
              <td><?= $row['mulai'] ?></td>
              <td><?= $row['selesai'] ?></td>
              <td><?= number_format($row['biaya'], 2, ',', '.') ?></td>
              <td><?= $row['nama_armada'] ?></td>
              <td><?= $row['status_pinjaman'] ?></td>
              <td>
                <div class="d-flex">
                  <a href="?url=peminjaman-input&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning mr-2">Edit</a>
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
            <th>Nama Peminjam</th>
            <th>KTP</th>
            <th>Keperluan</th>
            <th>Mulai</th>
            <th>Selesai</th>
            <th>Biaya</th>
            <th>Armada</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>