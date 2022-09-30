<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * index
     * 
     * @return void
     */

    public function index(){
        //get posts
        $pegawai = Pegawai::get();

        //render view with posts
        return view('pegawai.index',compact('pegawai'));
     }
}
