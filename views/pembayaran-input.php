<?php
require_once 'Controllers/Pembayaran.php';
require_once 'Controllers/Peminjaman.php';
require_once 'Helpers/helper.php';

$pembayaran_id = isset($_GET['id']) ? $_GET['id'] : null;
$show_pembayaran = $pembayaran_id ? $pembayaran->show($pembayaran_id) : [];

$list_peminjaman = $peminjaman->index();

if (isset($_POST['type'])) {
  if ($_POST['type'] == 'create') {
    $id = $pembayaran->create($_POST);
    echo "<script>alert('Data pembayaran berhasil ditambahkan')</script>";
    echo "<script>window.location='?url=pembayaran'</script>";
  } else if ($_POST['type'] == 'update') {
    $row = $pembayaran->update($pembayaran_id, $_POST);
    echo "<script>alert('Data pembayaran berhasil diperbarui')</script>";
    echo "<script>window.location='?url=pembayaran'</script>";
  }
}
?>

<div class="container">
  <form method="post">

    <div class="card">
      <div class="card-header">
        <div class="card-title">
          <?= $pembayaran_id ? 'Edit Pembayaran' : 'Tambah Pembayaran' ?>
        </div>
      </div>
      <div class="card-body">

        <div class="form-group">
          <label for="tanggal">Tanggal</label>
          <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= getSafeFormValue($show_pembayaran, 'tanggal') ?>" required>
        </div>
        <div class="form-group">
          <label for="jumlah_bayar">Jumlah Bayar</label>
          <input type="number" step="0.01" class="form-control" id="jumlah_bayar" name="jumlah_bayar" value="<?= getSafeFormValue($show_pembayaran, 'jumlah_bayar') ?>" required>
        </div>
        <div class="form-group">
          <label for="peminjaman_id">Nama Peminjam</label>
          <select class="form-control" id="peminjaman_id" name="peminjaman_id" required>
            <option value="">Pilih Peminjam</option>
            <?php foreach ($list_peminjaman as $peminjaman): ?>
              <option value="<?= $peminjaman['id'] ?>" <?= getSafeFormValue($show_pembayaran, 'peminjaman_id') == $peminjaman['id'] ? 'selected' : '' ?>>
                <?= $peminjaman['nama_peminjam'] ?> - <?= $peminjaman['keperluan_pinjaman'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="card-footer text-right">
        <input type="hidden" name="type" value="<?= $pembayaran_id ? 'update' : 'create' ?>">
        <input type="hidden" name="id" value="<?= $pembayaran_id ?>">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>

  </form>
</div>