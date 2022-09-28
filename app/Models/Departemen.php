<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;
    /**
     * filelable
     * 
     * @var array
     */

     protected $fillable = [
        'nama_departemen',
        'nama_manager',
        'jumlah_pegawai',
     ];
}
