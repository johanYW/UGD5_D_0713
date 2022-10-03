<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyek;
use DB;

class ProyekController extends Controller
{
    /**
     * index
     * 
     * @return void
     */

     public function index(){
        //get posts
        $proyek = Proyek::get();
       
        $proyek = Proyek::paginate(5);

        //render view with posts
        return view('proyek.index',compact('proyek'));
     }
}
