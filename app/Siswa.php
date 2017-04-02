<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
	 protected $table = 'siswas';
     public $fillable = ['kelas_id','nama','jk','tempat_lahir','tgl_lahir','alamat'];
}
