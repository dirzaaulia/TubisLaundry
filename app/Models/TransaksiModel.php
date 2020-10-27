<?php namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model{
    
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode_transaksi', 'pelanggan_id', 'layanan_id', 'berat', 'tanggal_masuk', 'tanggal_selesai', 'biaya_antar', 'biaya', 'total_biaya', 'status'];
}