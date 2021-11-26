<?php

namespace App\Controllers;

use App\Models\KabupatenModel;
use App\Models\ProvinsiModel;

class Kabupaten extends BaseController
{
    public function __construct()
    {
        $this->KabupatenModel = new KabupatenModel();
        $this->ProvinsiModel = new ProvinsiModel();
    }

    public function index()
    {
        session();

        return view('kabupaten/index', $data = [
            'kabupaten' => $this->KabupatenModel->getKabupaten(),
            'provinsi' => $this->ProvinsiModel->getProvinsi()
        ]);
    }

    public function tambahKabupaten()
    {
        session();
        return view('kabupaten/tambah_kabupaten', $data = [
            'provinsi' => $this->ProvinsiModel->getProvinsi(),
            'validation' => \Config\Services::validation()
        ]);
    }

    public function saveKabupaten()
    {
        if (!$this->validate([
            'idProvinsi' => [
                'rules' => 'greater_than[0]',
                'errors' => [
                    'greater_than' => 'Pilih provinsi terlebih dahulu',
                ]
            ],
            'namaKabupaten' => [
                'rules' => 'required|is_unique[kabupaten.nama_kabupaten]',
                'errors' => [
                    'required' => 'Nama kabupaten harus diisi.',
                    'is_unique' => 'Kabupaten sudah ada'
                ]
            ],
            'jumlahPenduduk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah penduduk harus diisi.'
                ]
            ]
        ])) {

            return redirect()->to('/tambahkabupaten')->withInput();
        }

        $this->KabupatenModel->save([
            'id_provinsi' => $this->request->getVar('idProvinsi'),
            'nama_kabupaten' => $this->request->getVar('namaKabupaten'),
            'jumlah_penduduk' => $this->request->getVar('jumlahPenduduk')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');

        return redirect()->to('/');
    }

    public function editkabupaten()
    {
        session();
        $idKabupaten = $this->request->getVar('idKabupaten');

        return view('kabupaten/edit_kabupaten', $data = [
            'provinsi' => $this->ProvinsiModel->getProvinsi(),
            'kabupaten' => $this->KabupatenModel->getKabupaten($idKabupaten),
            'validation' => \Config\Services::validation()
        ]);
    }

    public function updateKabupaten()
    {
        if (!$this->validate([
            'idProvinsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih provinsi terlebih dahulu',
                ]
            ],
            'namaKabupaten' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama kabupaten harus diisi.'
                ]
            ],
            'jumlahPenduduk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah penduduk harus diisi.'
                ]
            ]
        ])) {

            return redirect()->to('/editkabupaten')->withInput();
        }

        $this->KabupatenModel->save([
            'id_kabupaten' => $this->request->getVar('idKabupaten'),
            'id_provinsi' => $this->request->getVar('idProvinsi'),
            'nama_kabupaten' => $this->request->getVar('namaKabupaten'),
            'jumlah_penduduk' => $this->request->getVar('jumlahPenduduk'),
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Diubah');

        return redirect()->to('/');
    }

    public function hapusKabupaten($id)
    {

        $this->KabupatenModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/');
    }

    public function cari()
    {
        $cari = $this->request->getVar('cari');
        return view('kabupaten/index', $data = [
            'kabupaten' => $this->KabupatenModel->filterDanCari($cari),
            'provinsi' => $this->ProvinsiModel->getProvinsi()
        ]);
    }

    public function filter()
    {
        $filter = $this->request->getVar('provinsi');
        return view('kabupaten/index', $data = [
            'kabupaten' => $this->KabupatenModel->filterDanCari($filter),
            'provinsi' => $this->ProvinsiModel->getProvinsi()
        ]);
    }

    public function printProvinsi()
    {
        return view('kabupaten/print_provinsi', $data = [
            'provinsi' => $this->ProvinsiModel->getJumlahPenduduk(),
        ]);
    }

    public function printKabupaten()
    {
        if ($this->request->getVar('provinsi') !== null) {
            $provinsi = str_replace('_', ' ', $this->request->getVar('provinsi'));
            return view('kabupaten/print_kabupaten', $data = [
                'kabupaten' => $this->KabupatenModel->printKabupaten($provinsi),
            ]);
        }

        return view('kabupaten/print_kabupaten', $data = [
            'kabupaten' => $this->KabupatenModel->printKabupaten(),
        ]);
    }
}
