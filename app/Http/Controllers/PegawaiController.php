<?php

namespace App\Http\Controllers;

use App\Mail\PegawaiMail;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Exception;

class PegawaiController extends Controller
{
    /**
     * index
     * 
     * @return void
     */

    public function index(){
        //get posts
        $pegawai = Pegawai::latest()->paginate(5);

        //render view with posts
        return view('pegawai.index',compact('pegawai'));
     }

    /**
      * create
      *
      *@return void
      */
      public function create(){
        return view('pegawai.create');
     }
     /**
      * store
      * 
      * @param Request $request
      * @return void
      */
     public function store(Request $request){
        $this->validate($request,[
           'nomor_induk_pegawai' => 'required',
           'nama_pegawai' => 'required',
           'id_departemen' => 'required',
           'email' => 'required',
            'telepon' => 'required',
            'gender' => 'required',
            
        ]);

        Pegawai::create([
           'nomor_induk_pegawai' => $request->nomor_induk_pegawai,
           'nama_pegawai' => $request->nama_pegawai,
           'id_departemen' => $request->id_departemen,
           'email' => $request->email,
           'telepon' => $request->telepon,
           'gender' => $request->gender,
           'status' => $request->status
        ]);

        try{
           $content = [
              'body' => $request->id,
           ];

           Mail::to('tulungagung108@gmail.com')->send(new PegawaiMail($content));

           return redirect()->route('pegawai.index')->with(['success' => 'Data berhasil disimpan, email telah dikirim']);

        }catch(Exception $e){
           return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Disimpan, namun gagal mengirim email']);
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
    $pegawai = Pegawai::find($id);

    return view('pegawai.edit',compact('pegawai'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nomor_induk_pegawai' => 'required',
            'nama_pegawai' => 'required',
            'id_departemen' => 'required',
            'email' => 'required',
             'telepon' => 'required',
             'gender' => 'required',
             'status' => 'required'
         ]);

        Pegawai::find($id)->update($request->all());

        return redirect()->route('pegawai.index')->with(['success' => 'Data berhasil di Update']);
    }
    /**
    * Delete
    *
    *@param int $id
    *@return void
    */
    public function destroy($nomor_induk_pegawai){
        Pegawai::find($nomor_induk_pegawai)->delete();
  
        return redirect()->route('pegawai.index')->withSuccess(__('post delete sukses'));
    }
}
