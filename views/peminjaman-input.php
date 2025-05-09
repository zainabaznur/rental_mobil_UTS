<?php
require_once 'Controllers/Peminjaman.php';
require_once 'Controllers/Armada.php';
require_once 'Helpers/helper.php';

$peminjaman_id = isset($_GET['id']) ? $_GET['id'] : null;
$show_peminjaman = $peminjaman_id ? $peminjaman->show($peminjaman_id) : [];

$list_armada = $armada->index();

if (isset($_POST['type'])) {
  if ($_POST['type'] == 'create') {
    $id = $peminjaman->create($_POST);
    echo "<script>alert('Data peminjaman berhasil ditambahkan')</script>";
    echo "<script>window.location='?url=peminjaman'</script>";
  } else if ($_POST['type'] == 'update') {
    $row = $peminjaman->update($peminjaman_id, $_POST);
    echo "<script>alert('Data peminjaman berhasil diperbarui')</script>";
    echo "<script>window.location='?url=peminjaman'</script>";
  }
}
?>

<div class="container">
  <form method="post">

    <div class="card">
      <div class="card-header">
        <div class="card-title">
          <?= $peminjaman_id ? 'Edit Peminjaman' : 'Tambah Peminjaman' ?>
        </div>
      </div>
      <div class="card-body">

        <div class="form-group">
          <label for="nama_peminjam">Nama Peminjam</label>
          <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" value="<?= getSafeFormValue($show_peminjaman, 'nama_peminjam') ?>" required>
        </div>
        <div class="form-group">
          <label for="ktp_peminjam">Nomor KTP</label>
          <input type="text" class="form-control" id="ktp_peminjam" name="ktp_peminjam" value="<?= getSafeFormValue($show_peminjaman, 'ktp_peminjam') ?>" required>
        </div>
        <div class="form-group">
          <label for="keperluan_pinjaman">Keperluan</label>
          <textarea class="form-control" id="keperluan_pinjaman" name="keperluan_pinjaman" rows="3" required><?= getSafeFormValue($show_peminjaman, 'keperluan_pinjaman') ?></textarea>
        </div>
        <div class="form-group">
          <label for="mulai">Tanggal Mulai</label>
          <input type="date" class="form-control" id="mulai" name="mulai" value="<?= getSafeFormValue($show_peminjaman, 'mulai') ?>" required>
        </div>
        <div class="form-group">
          <label for="selesai">Tanggal Selesai</label>
          <input type="date" class="form-control" id="selesai" name="selesai" value="<?= getSafeFormValue($show_peminjaman, 'selesai') ?>" required>
        </div>
        <div class="form-group">
          <label for="biaya">Biaya</label>
          <input type="number" step="0.01" class="form-control" id="biaya" name="biaya" value="<?= getSafeFormValue($show_peminjaman, 'biaya') ?>" required>
        </div>
        <div class="form-group">
          <label for="kontnr_peminjam">Kontak Peminjam</label>
          <input type="text" class="form-control" id="kontnr_peminjam" name="kontnr_peminjam" value="<?= getSafeFormValue($show_peminjaman, 'kontnr_peminjam') ?>" required>
        </div>
        <div class="form-group">
          <label for="status_pinjaman">Status Peminjaman</label>
          <select class="form-control" id="status_pinjaman" name="status_pinjaman" required>
            <option value="Aktif" <?= getSafeFormValue($show_peminjaman, 'status_pinjaman') == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
            <option value="Selesai" <?= getSafeFormValue($show_peminjaman, 'status_pinjaman') == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
          </select>
        </div>
        <div class="form-group">
          <label for="armada_id">Armada</label>
          <select class="form-control" id="armada_id" name="armada_id" required>
            <option value="">Pilih Armada</option>
            <?php foreach ($list_armada as $armada): ?>
              <option value="<?= $armada['id'] ?>" <?= getSafeFormValue($show_peminjaman, 'armada_id') == $armada['id'] ? 'selected' : '' ?>>
                <?= $armada['merk'] ?> - <?= $armada['nopol'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="card-footer text-right">
        <input type="hidden" name="type" value="<?= $peminjaman_id ? 'update' : 'create' ?>">
        <input type="hidden" name="id" value="<?= $peminjaman_id ?>">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>

  </form>
</div>