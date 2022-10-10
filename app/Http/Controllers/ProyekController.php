<?php

namespace App\Http\Controllers;

use App\Mail\ProyekMail;
use Illuminate\Http\Request;
use App\Models\Proyek;
use DB;
use Exception;
use Illuminate\Support\Facades\Mail;

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
      /**
      * create
      *
      *@return void
      */
      public function create(){
         return view('proyek.create');
      }
     /**
      * store
      * 
      * @param Request $request
      * @return void
      */
      public function store(Request $request){
         $this->validate($request,[
            'nama_proyek' => 'required',
            'id_departemen' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'status' => 'required'
         ]);
 
         Proyek::create([
            'nama_proyek' => $request->nama_proyek,
            'id_departemen' => $request->id_departemen,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'status' => $request->status
         ]);
      try{
            $content = [
               'body' => $request->id,
            ];
 
            Mail::to('tulungagung108@gmail.com')->send(new ProyekMail($content));
 
            return redirect()->route('proyek.index')->with(['success' => 'Data berhasil disimpan, email telah dikirim']);
 
         }catch(Exception $e){
            return redirect()->route('proyek.index')->with(['success' => 'Data Berhasil Disimpan, namun gagal mengirim email']);
         }
      }
      /**
       * 
      *Edit
      *
      *@param int $id
      *@param void
      */
      public function edit($id){
         $proyek = Proyek::find($id);
   
         return view('proyek.edit',compact('proyek'));
         }


      public function update(Request $request, $id)
      {
         $this->validate($request,[
            'nama_proyek' => 'required',
            'id_departemen' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'status' => 'required'
         ]);
   
         Proyek::find($id)->update($request->all());
   
         return redirect()->route('proyek.index')->with(['success' => 'Data berhasil di Update']);
      }

      /**
       * Delete
      *
      *@param int $id
      *@return void
      */
      public function destroy($id){
         Proyek::find($id)->delete();

         return redirect()->route('proyek.index')->withSuccess(__('Data berhasil di Delete'));
   }
}
