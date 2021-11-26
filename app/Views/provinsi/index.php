<?= $this->extend('templates/template'); ?>

<?= $this->section('content'); ?>

<h2 class="text-center">Daftar Provinsi</h2>

<div class="d-flex mb-3">
    <div class="me-auto p-2 bd-highlight">
        <a href="/" class="btn btn-primary">Daftar Kabupaten</a>
    </div>
    <div class="p-2 bd-highlight">
        <a href="/provinsi/tambahProvinsi" class="btn btn-primary">Tambah Provinsi</a>
    </div>
</div>
<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
    </div>
<?php endif; ?>
<table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Provinsi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($provinsi as $p) :
        ?>
            <tr>
                <th><?= $no++; ?></th>
                <td><?= $p['nama_provinsi']; ?></td>
                <td>
                    <form action="provinsi/editprovinsi" method="POST">
                        <input type="hidden" value="<?= $p['id_provinsi']; ?>" name="idProvinsi">
                        <button name="submit" class="btn btn-warning">Edit</button>
                    </form>
                </td>
                <td>
                    <form action="provinsi/hapusprovinsi/<?= $p['id_provinsi']; ?>" method="POST">
                        <?= csrf_field();; ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endsection(); ?>