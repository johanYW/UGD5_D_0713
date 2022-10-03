<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;
    /**
     * fillable
     * 
     * @var array
     */

     protected $fillable=[
        'nama_proyek',
        'id_departemen',
        'waktu_mulai',
        'waktu_selesai',
        'status',
     ];
}
