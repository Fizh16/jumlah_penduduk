<?php

namespace App\Controllers;

use App\Models\ProvinsiModel;

class Provinsi extends BaseController
{
    public function __construct()
    {
        $this->ProvinsiModel = new ProvinsiModel();
    }

    public function index()
    {
        return view('provinsi/index', $data = [
            'provinsi' => $this->ProvinsiModel->getProvinsi()
        ]);
    }

    public function tambahProvinsi()
    {
        return view('provinsi/tambah_provinsi', $data = [
            'validation' => \Config\Services::validation()
        ]);
    }

    public function saveProvinsi()
    {
        if (!$this->validate([
            'namaProvinsi' => [
                'rules' => 'required|is_unique[provinsi.nama_provinsi]',
                'errors' => [
                    'required' => 'Nama provinsi harus di isi',
                    'is_unique' => 'Provinsi sudah ada'
                ]
            ]
        ])) {

            return redirect()->to('/provinsi/tambahProvinsi')->withInput();
        }

        $this->ProvinsiModel->saveProvinsi($this->request->getVar('namaProvinsi'));

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');

        return redirect()->to('/provinsi');
    }

    public function editProvinsi()
    {
        $idProvinsi = $this->request->getVar('idProvinsi');

        if (isset($idProvinsi)) {
            return view('provinsi/edit_provinsi', $data = [
                'provinsi' => $this->ProvinsiModel->getProvinsi($idProvinsi),
                'validation' => \Config\Services::validation()
            ]);
        } else {
            return redirect()->to('provinsi');
        }
    }

    public function updateProvinsi()
    {
        $idProvinsi = $this->request->getVar('idProvinsi');
        $namaProvinsi = $this->request->getVar('namaProvinsi');

        $provinsilama = $this->ProvinsiModel->getProvinsi($idProvinsi);

        if ($provinsilama['nama_provinsi'] !== $namaProvinsi) {
            if (!$this->validate([
                'namaProvinsi' => [
                    'rules' => 'is_unique[provinsi.nama_provinsi]',
                    'errors' => [
                        'is_unique' => 'Provinsi sudah ada',
                    ]
                ]
            ])) {

                return redirect()->to('/provinsi/editprovinsi')->withInput();
            }
        }

        $this->ProvinsiModel->updateProvinsi($idProvinsi, $namaProvinsi);

        session()->setFlashdata('pesan', 'Data Berhasil Diubah');

        return redirect()->to('/provinsi');
    }

    public function hapusProvinsi($idProvinsi)
    {

        $this->ProvinsiModel->delete($idProvinsi);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/provinsi');
    }
}
