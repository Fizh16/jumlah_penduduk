<?= $this->extend('templates/template'); ?>

<?= $this->section('content'); ?>

<h2 class="text-center">Jumlah Penduduk</h2>

<table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Provinsi</th>
            <th scope="col">Jumlah Penduduk</th>
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
                <td><?= ($p['SUM(kabupaten.jumlah_penduduk)'] == null) ? 0 : $p['SUM(kabupaten.jumlah_penduduk)']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    window.print();
</script>

<?= $this->endsection(); ?>