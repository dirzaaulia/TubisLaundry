<?php

namespace App\Controllers;

use App\Models\PegawaiModel;

class Pegawai extends BaseController
{
	public function index()
	{
		$data = [];

		helper(['form']);

		if ($this->request->getMethod() == 'post') {

			$rules = [
				'username' => 'required',
				'password' => 'required|validateUser[username,password]',
			];

			$errors = [
				'password' => [
					'validateUser' => 'Username dan Password tidak sesuai. Mohon periksa kembali'
				]
			];

			if (!$this->validate($rules, $errors)) {
				$data['validation'] = $this->validator;
			} else {
				$model = new PegawaiModel();

				$user = $model->where('username', $this->request->getVar('username'))
				              ->first();

				$this->setUserSession($user);

				return redirect()->to(base_url('/dashboard'));
			}
		}

		echo view('templates/header', $data);
		echo view('adminlogin', $data);
		echo view('templates/footer', $data);
	}

	private function setUserSession($user)
	{
		$data = [
			'id'			=> $user['id'],
			'nama'			=> $user['nama'],
			'username'		=> $user['username'],
			'isLoggedIn'	=> true,
		];

		session()->set($data);
		return true;
	}

	public function register()
	{
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
				return redirect()->to(base_url("/pegawai"));
			}
		}

		echo view('templates/header', $data);
		echo view('adminregister', $data);
		echo view('templates/footer', $data);
	}
}
