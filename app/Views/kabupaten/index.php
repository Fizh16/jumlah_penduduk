<?= $this->extend('templates/template'); ?>

<?= $this->section('content'); ?>

<h2 class="text-center">Jumlah Penduduk</h2>

<div class="d-flex mb-3">
    <div class="me-auto p-2 bd-highlight">
        <a href="/provinsi" class="btn btn-primary">Daftar Provinsi</a>
    </div>
    <div class="p-2 bd-highlight">
        <a href="/tambahkabupaten" class="btn btn-primary">Tambah Kabupaten</a>
    </div>
</div>

<form action="/cari/" method="GET">
    <div class="mb-3 input-group">
        <input type="text" class="form-control" name="cari" placeholder="Cari Kabupaten">
        <button type="submit" class="btn btn-primary">Cari</button>
    </div>
</form>

<div class="dropdown">
    <button class="btn btn-sm dropdown-toggle float-end text-primary" type="button" data-bs-toggle="dropdown">
        Filter Berdasarkan Provinsi
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <?php foreach ($provinsi as $p) : ?>
            <li><a class="dropdown-item" href="/filter/?provinsi=<?= str_replace(' ', '_', $p['nama_provinsi']); ?>"><?= $p['nama_provinsi']; ?></a></li>
        <?php endforeach; ?>
    </ul>
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
            <th scope="col">Kabupaten</th>
            <th scope="col">Jumlah Penduduk</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($kabupaten as $k) :
        ?>
            <tr>
                <th><?= $no++; ?></th>
                <td><?= $k['nama_provinsi']; ?></td>
                <td><?= $k['nama_kabupaten']; ?></td>
                <td><?= $k['jumlah_penduduk']; ?></td>
                <td>
                    <form action="kabupaten/editkabupaten" method="POST">
                        <input type="hidden" value="<?= $k['id_kabupaten']; ?>" name="idKabupaten">
                        <button name="submit" class="btn btn-warning">Edit</button>
                    </form>
                </td>
                <td>
                    <form action="kabupaten/hapuskabupaten/<?= $k['id_kabupaten']; ?>" method="POST">
                        <?= csrf_field();; ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="d-flex">
    <a href="/kabupaten/printProvinsi" class="btn btn-secondary btn-sm me-3">Laporan jumlah penduduk/provinsi</a>

    <div class="dropdown">
        <button class="btn btn-sm dropdown-toggle btn-secondary" type="button" data-bs-toggle="dropdown">
            Laporan jumlah penduduk/kabupaten
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="kabupaten/printKabupaten">Semua Kabupaten</a></li>
            <?php foreach ($provinsi as $p) : ?>
                <li><a class="dropdown-item" href="kabupaten/printKabupaten/?provinsi=<?= str_replace(' ', '_', $p['nama_provinsi']); ?>"><?= $p['nama_provinsi']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<?= $this->endsection(); ?>