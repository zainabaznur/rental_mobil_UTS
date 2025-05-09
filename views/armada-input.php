<?php
require_once 'Controllers/Armada.php';
require_once 'Controllers/JenisKendaraan.php';
require_once 'Helpers/helper.php';

// Inisialisasi objek Armada dan JenisKendaraan
$armada = new Armada($pdo);
$jeniskendaraan = new JenisKendaraan($pdo);

// Ambil ID armada jika ada (untuk edit)
$armada_id = isset($_GET['id']) ? $_GET['id'] : null;
$show_armada = $armada_id ? $armada->show($armada_id) : [];

// Ambil daftar jenis kendaraan
$list_jenis_kendaraan = $jeniskendaraan->index();

// Proses input data
if (isset($_POST['type'])) {
  if ($_POST['type'] == 'create') {
    $id = $armada->create($_POST);
    echo "<script>alert('Data armada berhasil ditambahkan')</script>";
    echo "<script>window.location='?url=armada'</script>";
  } else if ($_POST['type'] == 'update') {
    $row = $armada->update($armada_id, $_POST);
    echo "<script>alert('Data armada berhasil diperbarui')</script>";
    echo "<script>window.location='?url=armada'</script>";
  }
}
?>

<div class="container">
  <form method="post">
    <div class="card">
      <div class="card-header">
        <h4><?= $armada_id ? 'Edit Armada' : 'Tambah Armada' ?></h4>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label for="merk">Merk</label>
          <input type="text" class="form-control" id="merk" name="merk" value="<?= getSafeFormValue($show_armada, 'merk') ?>" required>
        </div>
        <div class="form-group">
          <label for="nopol">Nomor Polisi</label>
          <input type="text" class="form-control" id="nopol" name="nopol" value="<?= getSafeFormValue($show_armada, 'nopol') ?>" required>
        </div>
        <div class="form-group">
          <label for="thn_beli">Tahun Beli</label>
          <input type="number" class="form-control" id="thn_beli" name="thn_beli" value="<?= getSafeFormValue($show_armada, 'thn_beli') ?>" required>
        </div>
        <div class="form-group">
          <label for="deskripsi">Deskripsi</label>
          <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?= getSafeFormValue($show_armada, 'deskripsi') ?></textarea>
        </div>
        <div class="form-group">
          <label for="jenis_kendaraan_id">Jenis Kendaraan</label>
          <select class="form-control" id="jenis_kendaraan_id" name="jenis_kendaraan_id" required>
            <option value="">Pilih Jenis Kendaraan</option>
            <?php foreach ($list_jenis_kendaraan as $jenis): ?>
              <option value="<?= $jenis['id'] ?>" <?= getSafeFormValue($show_armada, 'jenis_kendaraan_id') == $jenis['id'] ? 'selected' : '' ?>>
                <?= $jenis['nama'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="kapasitas_kursi">Kapasitas Kursi</label>
          <input type="number" class="form-control" id="kapasitas_kursi" name="kapasitas_kursi" value="<?= getSafeFormValue($show_armada, 'kapasitas_kursi') ?>" required>
        </div>
        <div class="form-group">
          <label for="rating">Rating</label>
          <input type="number" class="form-control" id="rating" name="rating" value="<?= getSafeFormValue($show_armada, 'rating') ?>" required>
        </div>
      </div>
      <div class="card-footer text-right">
        <input type="hidden" name="type" value="<?= $armada_id ? 'update' : 'create' ?>">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="?url=armada" class="btn btn-secondary">Kembali</a>
      </div>
    </div>
  </form>
</div>