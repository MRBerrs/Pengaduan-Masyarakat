<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan'; // Table name in the database

    protected $primaryKey = 'id_pengaduan'; // Pastikan sesuai dengan primary key Anda; jika tidak diatur dengan benar, Eloquent mungkin tidak dapat mengupdate atau menghapus data dengan tepat.

    protected $fillable = [
        'tgl_pengaduan', 
        'nik', 
        'isi_laporan', 
        'foto', 
        'status',
    ];

    protected $casts = ['tgl_pengaduan' => 'datetime']; // Kolom yang di-cast sebagai tanggal

    // Relasi ke model Masyarakat (user)
    public function user()
    {
        return $this->belongsTo(Masyarakat::class, 'nik', 'nik');
    }
}
