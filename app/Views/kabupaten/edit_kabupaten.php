<?= $this->extend('templates/template'); ?>

<?= $this->section('content'); ?>

<h2 class="mb-3">Edit Kabupaten</h2>

<form action="/Kabupaten/updateKabupaten" method="POST">
    <input type="text" value="<?= $kabupaten['id_kabupaten']; ?>" name="idKabupaten" hidden>
    <div class="mb-3">
        <select class="form-select" name="idProvinsi">
            <?php foreach ($provinsi as $p) : ?>
                <option value="<?= $p['id_provinsi']; ?>"><?= $p['nama_provinsi']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" name="namaKabupaten" placeholder="Nama Kabupaten" value="<?= $kabupaten['nama_kabupaten']; ?>">
    </div>
    <div class="mb-3">
        <input type="number" class="form-control" name="jumlahPenduduk" placeholder="Jumlah Penduduk" value="<?= $kabupaten['jumlah_penduduk']; ?>">
    </div>
    </div>
    <button type="submit" class="btn btn-primary" name="editKabupaten">Edit</button>
</form>

<?= $this->endsection(); ?>