<?php
require_once 'Controllers/JenisKendaraan.php';
require_once 'Helpers/helper.php';

// Inisialisasi objek JenisKendaraan
$jeniskendaraan = new JenisKendaraan($pdo);

// Ambil ID jenis kendaraan jika ada (untuk edit)
$jenis_kendaraan_id = isset($_GET['id']) ? $_GET['id'] : null;
$show_jenis_kendaraan = $jenis_kendaraan_id ? $jeniskendaraan->show($jenis_kendaraan_id) : [];

// Proses input data
if (isset($_POST['type'])) {
  if ($_POST['type'] == 'create') {
    $id = $jeniskendaraan->create($_POST);
    echo "<script>alert('Data jenis kendaraan berhasil ditambahkan')</script>";
    echo "<script>window.location='?url=jeniskendaraan'</script>";
  } else if ($_POST['type'] == 'update') {
    $row = $jeniskendaraan->update($jenis_kendaraan_id, $_POST);
    echo "<script>alert('Data jenis kendaraan berhasil diperbarui')</script>";
    echo "<script>window.location='?url=jeniskendaraan'</script>";
  }
}
?>

<div class="container">
  <form method="post">
    <div class="card">
      <div class="card-header">
        <h4><?= $jenis_kendaraan_id ? 'Edit Jenis Kendaraan' : 'Tambah Jenis Kendaraan' ?></h4>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label for="nama">Nama Jenis Kendaraan</label>
          <input type="text" class="form-control" id="nama" name="nama" value="<?= getSafeFormValue($show_jenis_kendaraan, 'nama') ?>" required>
        </div>
      </div>
      <div class="card-footer text-right">
        <input type="hidden" name="type" value="<?= $jenis_kendaraan_id ? 'update' : 'create' ?>">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="?url=jeniskendaraan" class="btn btn-secondary">Kembali</a>
      </div>
    </div>
  </form>
</div>