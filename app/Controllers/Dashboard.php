<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\PegawaiModel;
use App\Models\TransaksiModel;
use App\Models\PelangganModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [];

        if (session()->get('isLoggedIn') == false) {
            echo view('errors/html/error_404.php', $data);
        } else if (session()->get('isLoggedIn') == true) {
            $model1 = new PelangganModel();
            $model2 =  new LayananModel();

            $data = [
                'pelanggan' => $model1->findAll(),
                'layanan'   => $model2->findAll(),
            ];

            echo view('templates/header', $data);
            echo view('admindashboard', $data);
            echo view('templates/footer', $data);
        }
    }

    public function registertransaksi()
    {
        $model = new LayananModel();
        $model2 = new TransaksiModel();

        $data = [];

        $pelanggan_id = $this->request->getVar('pelanggan');
        $layanan_id = $this->request->getVar('layanan');
        $berat = $this->request->getVar('berat');

        $data = [
            'layanan' => $model->find($layanan_id),
        ];

        $harga = $data['layanan']['harga'];
        $durasi = $data['layanan']['durasi'];
        $tanggal_masuk = date("Y-m-d");
        $tanggal_selesai = date("Y-m-d", strtotime("+$durasi days"));
        $biaya = $harga * $berat;
        $kode = $pelanggan_id . date("Ymd");

        $data = [
            'kode_transaksi'    => $kode,
            'pelanggan_id'      => $this->request->getVar('pelanggan'),
            'layanan_id'        => $this->request->getVar('layanan'),
            'berat'             => $this->request->getVar('berat'),
            'tanggal_masuk'     => $tanggal_masuk,
            'tanggal_selesai'   => $tanggal_selesai,
            'biaya_antar'       => 0,
            'biaya'             => $biaya,
            'total_biaya'       => $biaya,
            'status'            => 'Diproses',
        ];

        $model2->insert($data);
        $session = session();
        $session->setFlashdata('success', 'Transaksi Baru Berhasil Ditambahkan');
        return redirect()->to(base_url("/dashboard"));
    }

    public function updatetransaksi()
    {
        $model = new LayananModel();
        $model2 = new TransaksiModel();

        $data = [];

        $id = $this->request->getVar("id");
        $pelanggan_id = $this->request->getVar("pelangganUbah");
        $layanan_id = $this->request->getVar("layananUbah");
        $berat = $this->request->getVar("beratUbah");
        
        $status = $this->request->getVar("statusUbah");

        if (empty($pelanggan_id)) {
            $pelanggan_id = $this->request->getVar("idPelangganLama");
        }

        if (empty($layanan_id)) {
            $layanan_id = $this->request->getVar("idLayananLama");
        }

        if (empty($berat)) {
            $berat = $this->request->getVar("beratLama");
        }

        if ($status == "") {
            $status = $this->request->getVar("statusLama");
        }

        $data = [
            'layanan' => $model->find($layanan_id),
        ];

        $harga = $data['layanan']['harga'];
        $durasi = $data['layanan']['durasi'];
        $tanggal_masuk = date("Y-m-d");
        $tanggal_selesai = date("Y-m-d", strtotime("+$durasi days"));
        $biaya = $harga * $berat;
        $biaya_antar = $this->request->getVar("biaya_antar");
        $total_biaya = $biaya + $biaya_antar;

        $data = [
            'pelanggan_id'      => $pelanggan_id,
            'layanan_id'        => $layanan_id,
            'berat'             => $berat,
            'tanggal_masuk'     => $tanggal_masuk,
            'tanggal_selesai'   => $tanggal_selesai,
            'biaya'             => $biaya,
            'total_biaya'       => $total_biaya,
            'status'            => $status,
        ];

        $model2->update($id, $data);
        $session = session();
        $session->setFlashdata('success', 'Transaksi Berhasil Diubah');
        return redirect()->to(base_url("/dashboard"));
    }

    public function pelanggan()
    {

        $data = [];

        if (session()->get('isLoggedIn') == false) {
            echo view('errors/html/error_404.php', $data);
        } else if (session()->get('isLoggedIn') == true) {
            $model =  new PelangganModel();

            $data = [
                'pelanggan' => $model->paginate(10, 'bootstrap'),
                'pager' => $model->pager
            ];

            echo view('templates/header', $data);
            echo view('adminpelanggan', $data);
            echo view('templates/footer', $data);
        }
    }

    public function registerpelanggan()
    {

        $model = new PelangganModel();

        $data = [];

        $data = [
            'uri'               => $this->request->getVar('uri'),
            'nama_pelanggan'    => $this->request->getVar('namaPelangganBaru'),
            'nohp'              => $this->request->getVar('nomorHpPelangganBaru'),
            'alamat'            => $this->request->getVar('alamatPelangganBaru'),
        ];

        if ($data['uri'] == '/laundry-ci/public/dashboard') {
            $model->insert($data);
            $session = session();
            $session->setFlashdata('success', 'Registrasi Pelanggan Berhasil!');
            return redirect()->to(base_url("/dashboard"));
        } else if ($data['uri'] == '/laundry-ci/public/dashboard/pelanggan') {
            $model->insert($data);
            $session = session();
            $session->setFlashdata('success', 'Registrasi Pelanggan Berhasil!');
            return redirect()->to(base_url("/dashboard/pelanggan"));
        }
    }

    public function updatepelanggan()
    {
        $model = new PelangganModel();

        $data = [];

        $id = $this->request->getVar('id');

        $data = [
            'nama_pelanggan'    => $this->request->getVar('nama_pelanggan'),
            'nohp'              => $this->request->getVar('nohp'),
            'alamat'            => $this->request->getVar('alamat'),
        ];

        $model->update($id, $data);
        $session = session();
        $session->setFlashdata('success', 'Perubahan Pelanggan Berhasil!');
        return redirect()->to(base_url("/dashboard/pelanggan"));
    }

    public function deletepelanggan()
    {
        $model = new PelangganModel();

        $id = $this->request->getVar('id');

        $model->delete($id);
        $session = session();
        $session->setFlashdata('success', 'Penghapusan Pelanggan Berhasil!');
        return redirect()->to(base_url("/dashboard/pelanggan"));
    }

    public function layanan()
    {
        $data = [];

        if (session()->get('isLoggedIn') == false) {
            echo view('errors/html/error_404.php', $data);
        } else if (session()->get('isLoggedIn') == true) {
            $model =  new LayananModel();

            $data = [
                'layanan' => $model->paginate(10, 'bootstrap'),
                'pager' => $model->pager
            ];

            echo view('templates/header', $data);
            echo view('adminlayanan', $data);
            echo view('templates/footer', $data);
        }
    }

    public function registerlayanan()
    {
        $model = new LayananModel();

        $data = [];

        $data = [
            'nama_layanan'    => $this->request->getVar('namaLayananBaru'),
            'harga'              => $this->request->getVar('hargaLayananBaru'),
            'durasi'            => $this->request->getVar('durasiLayananBaru'),
        ];

        $model->insert($data);
        $session = session();
        $session->setFlashdata('success', 'Registrasi Layanan Berhasil!');
        return redirect()->to(base_url("/dashboard/layanan"));
    }

    public function updatelayanan()
    {
        $model = new LayananModel();

        $data = [];

        $id = $this->request->getVar('id');

        $data = [
            'nama_layanan'  => $this->request->getVar('nama_layanan'),
            'harga'         => $this->request->getVar('harga'),
            'durasi'        => $this->request->getVar('durasi'),
        ];

        $model->update($id, $data);
        $session = session();
        $session->setFlashdata('success', 'Perubahan Layanan Berhasil!');
        return redirect()->to(base_url("/dashboard/layanan"));
    }

    public function deletelayanan()
    {
        $model = new LayananModel();

        $id = $this->request->getVar('id');

        $model->delete($id);
        $session = session();
        $session->setFlashdata('success', 'Penghapusan Layanan Berhasil!');
        return redirect()->to(base_url("/dashboard/layanan"));
    }

    public function pegawai(){
        $data = [];

        if (session()->get('isLoggedIn') == false) {
            echo view('errors/html/error_404.php', $data);
        } else if (session()->get('isLoggedIn') == true) {
            $model =  new PegawaiModel();

            $data = [
                'pegawai' => $model->findAll()
            ];

            echo view('templates/header', $data);
            echo view('adminpegawai', $data);
            echo view('templates/footer', $data);
        }
    }

    public function registerpegawai(){
        $data = [];

		helper(['form']);

		if ($this->request->getMethod() == 'post') {

			$rules = [
				'nama'		=> 'required',
				'username' 	=> 'required',
				'password' 	=> 'required',
			];

			if (!$this->validate($rules)) {
				$data['validation'] = $this->validator;
			} else {
				$model = new PegawaiModel();

				$newData = [
					'nama'		=> $this->request->getVar('nama'),
					'username' 	=> $this->request->getVar('username'),
					'password' 	=> $this->request->getVar('password'),
				];

				$model->save($newData);
				$session = session();
				$session->setFlashdata('success', 'Registrasi Pegawai Berhasil!');
				return redirect()->to(base_url("/dashboard/pegawai"));
			}
		}
    }

    public function updatepegawai(){
        $data = [];

		helper(['form']);

		if ($this->request->getMethod() == 'post') {

			$rules = [
				'nama'		=> 'required',
				'username' 	=> 'required',
				'password' 	=> 'required',
			];

			if (!$this->validate($rules)) {
				$data['validation'] = $this->validator;
			} else {
				$model = new PegawaiModel();

				$newData = [
                    'id'        => $this->request->getVar('id'),
					'nama'		=> $this->request->getVar('nama'),
					'username' 	=> $this->request->getVar('username'),
					'password' 	=> $this->request->getVar('password'),
				];

				$model->save($newData);
				$session = session();
				$session->setFlashdata('success', 'Perubahan Pegawai Berhasil!');
				return redirect()->to(base_url("/dashboard/pegawai"));
			}
		}
    }

    public function deletepegawai(){
        $model = new PegawaiModel();

        $id = $this->request->getVar('id');

        $model->delete($id);
        $session = session();
        $session->setFlashdata('success', 'Penghapusan Pegawai Berhasil!');
        return redirect()->to(base_url("/dashboard/pegawai"));
    }

    public function logout(){
        $model = new PegawaiModel();

		$user = $model->where('id', $this->request->getVar('id'))
				      ->first();

        $this->setUserSession($user);

        return redirect()->to(base_url("/pegawai"));
    }

    private function setUserSession($user)
	{
		$data = [
			'isLoggedIn'	=> false,
		];

		session()->set($data);
		return true;
	}
}
