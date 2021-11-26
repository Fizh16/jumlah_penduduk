<?php

namespace App\Models;

use CodeIgniter\Model;

class ProvinsiModel extends Model
{
    protected $table = 'provinsi';
    protected $primaryKey = 'id_provinsi';
    protected $allowedFields = ['nama_provinsi'];

    public function getProvinsi($idProvinsi = false)
    {
        if ($idProvinsi == false) {
            return $this->orderBy('id_provinsi', 'desc')->findAll();
        }
        return $this->where(['id_provinsi' => $idProvinsi])->first();
    }

    public function saveProvinsi($namaProvinsi)
    {
        return $this->save([
            'nama_provinsi' => $namaProvinsi
        ]);
    }

    public function updateProvinsi($idProvinsi, $namaProvinsi)
    {
        return $this->save([
            'id_provinsi' => $idProvinsi,
            'nama_provinsi' => $namaProvinsi
        ]);
    }

    public function getJumlahPenduduk()
    {
        $this->select('provinsi.nama_provinsi, SUM(kabupaten.jumlah_penduduk)');
        $this->join('kabupaten', 'provinsi.id_provinsi = kabupaten.id_provinsi', 'left');
        $this->groupBy('provinsi.nama_provinsi');
        return $this->findAll();
    }
}
