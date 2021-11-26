<?= $this->extend('templates/template'); ?>

<?= $this->section('content'); ?>

<h2 class="mb-3">Tambah Provinsi</h2>

<form action="/provinsi/updateprovinsi" method="POST">
    <input type="hidden" value="<?= (isset($provinsi['id_provinsi'])) ? $provinsi['id_provinsi'] : old('idProvinsi'); ?>" name="idProvinsi">
    <div class="mb-3">
        <input type="text" class="form-control <?= ($validation->hasError('namaProvinsi')) ? 'is-invalid' : ''; ?>" name="namaProvinsi" placeholder="Nama Provinsi" value="<?= (isset($provinsi['nama_provinsi'])) ? $provinsi['nama_provinsi'] : old('namaProvinsi'); ?>">
        <div class="invalid-feedback">
            <?= $validation->getError('namaProvinsi'); ?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary" name="editProvinsi">Update</button>
</form>

<?= $this->endsection(); ?>