<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Mahasiwa as Authenticatable;  
use Illuminate\Notifications\Notifiable; 
use App\Models\Kelas;
use App\Models\Matakuliah;
use Illuminate\Database\Eloquent\Model; //Model Eloquent 

class Mahasiwa extends Model //Definisi Model

{
    protected $table='mahasiswa'; // Eloquent akan membuat model mahasiswa menyimpan record di tabel mahasiswa
    protected $primaryKey = 'id_mahasiswa'; // Memanggil isi DB Dengan primarykey
    // protected $keyType='string';
    
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     

    protected $fillable = [
    'nim',
    'nama',
    'foto',
    'kelas_id',
    'jurusan',
    'email',
    'alamat',
    'tanggal_lahir'
    ];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
    public function matakuliah()
    {
        return $this->belongsToMany(MataKuliah::class, 'mahasiswa_matakuliah', 'mahasiswa_id', 'matakuliah_id')->withPivot('nilai');
    }

};
