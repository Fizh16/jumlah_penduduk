<?= $this->extend('templates/template'); ?>

<?= $this->section('content'); ?>

<h2 class="mb-3">Tambah Kabupaten</h2>

<form action="/Kabupaten/saveKabupaten" method="POST">
    <div class="mb-3">
        <select class="form-select <?= ($validation->hasError('idProvinsi')) ? 'is-invalid' : ''; ?>" name="idProvinsi">
            <option value="0" selected>Pilih Provinsi</option>
            <?php foreach ($provinsi as $p) : ?>
                <option value="<?= $p['id_provinsi']; ?>"><?= $p['nama_provinsi']; ?></option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">
            <?= $validation->getError('idProvinsi'); ?>
        </div>
    </div>
    <div class="mb-3">
        <input type="text" class="form-control <?= ($validation->hasError('namaKabupaten')) ? 'is-invalid' : ''; ?>" name="namaKabupaten" placeholder="Nama Kabupaten" value="<?= old('namaKabupaten'); ?>">
        <div class="invalid-feedback">
            <?= $validation->getError('namaKabupaten'); ?>
        </div>
    </div>
    <div class="mb-3">
        <input type="number" class="form-control <?= ($validation->hasError('jumlahPenduduk')) ? 'is-invalid' : ''; ?>" name="jumlahPenduduk" placeholder="Jumlah Penduduk" value="<?= old('jumlahPenduduk'); ?>">
        <div class="invalid-feedback">
            <?= $validation->getError('jumlahPenduduk'); ?>
        </div>
    </div>
    </div>
    <button type="submit" class="btn btn-primary" name="tambahKabupaten">Tambah</button>
</form>

<?= $this->endsection(); ?>