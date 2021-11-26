<?= $this->extend('templates/template'); ?>

<?= $this->section('content'); ?>

<h2 class="mb-3">Tambah Provinsi</h2>

<form action="/provinsi/saveprovinsi" method="POST">
    <div class="mb-3">
        <input type="text" class="form-control <?= ($validation->hasError('namaProvinsi')) ? 'is-invalid' : ''; ?>" name="namaProvinsi" placeholder="Nama Provinsi" value="<?= old('namaProvinsi'); ?>">
        <div class="invalid-feedback">
            <?= $validation->getError('namaProvinsi'); ?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary" name="tambahProvinsi">Tambah</button>
</form>

<?= $this->endsection(); ?>