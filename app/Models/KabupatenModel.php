<?php

namespace App\Models;

use CodeIgniter\Model;

class KabupatenModel extends Model
{
    protected $table = 'kabupaten';
    protected $primaryKey = 'id_kabupaten';
    protected $allowedFields = ['nama_kabupaten', 'jumlah_penduduk', 'id_provinsi'];

    public function getKabupaten($idKabupaten = false)
    {
        if ($idKabupaten == false) {
            $this->select('*');
            $this->join('provinsi', 'provinsi.id_provinsi = kabupaten.id_provinsi');
            return $this->findAll();
        }

        return $this->where(['id_kabupaten' => $idKabupaten])->first();
    }

    public function filterDanCari($search)
    {
        $this->select('*');
        $this->join('provinsi', 'provinsi.id_provinsi = kabupaten.id_provinsi');
        $this->havingLike('nama_kabupaten', $search);
        $this->orHavingLike('nama_provinsi', $search);
        return $this->findAll();
    }

    public function printKabupaten($provinsi = false)
    {
        if ($provinsi == false) {
            $this->select('*');
            $this->join('provinsi', 'provinsi.id_provinsi = kabupaten.id_provinsi');
            return $this->findAll();
        }

        $this->select('*');
        $this->join('provinsi', 'provinsi.id_provinsi = kabupaten.id_provinsi');
        $this->where(['provinsi.nama_provinsi' => $provinsi]);
        return $this->findAll();
    }
}
