<?php namespace App\Controllers;

use App\Models\TransaksiModel;

class Home extends BaseController
{
	public function index()
	{
		echo view('templates/header');
		echo view('home');
		echo view('templates/footer');
	}

	public function cekorder(){
		$model = new TransaksiModel();

		$data = [
			'transaksi' => $model->where('kode_transaksi', $this->request->getVar('kode_transaksi'))
								 ->first()
		];

		$session = session();
		$status = $data['transaksi']['status'];
		$tanggal_selesai = $data['transaksi']['tanggal_selesai'];
		$biaya = number_format($data['transaksi']['biaya'], 0, ',', '.');
		$biaya_antar = number_format($data['transaksi']['biaya_antar'], 0, ',', '.');
		$total_biaya = number_format($data['transaksi']['total_biaya'], 0, ',', '.');

		if ($biaya == 0){
			$biaya = "Harga akan diupdate!";
		}


		$session_string = "Cucian kamu saat ini statusnya [" . $status . "] dengan perkiraan tanggal selesainya [" . $tanggal_selesai . "]. Biaya cucian kamu yaitu [" . $biaya . "] dengan biaya delivery [" . $biaya_antar . "] jadi total biayanya yaitu [" . $total_biaya . "]";
 		$session->setFlashdata('success', $session_string);
		return redirect()->to(base_url());
	}
}
