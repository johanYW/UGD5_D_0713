<?php

namespace App\Http\Controllers;

use Illuminate\Mail\Mailable;
use App\Mail\DepartemenMail; 
use App\Models\Departemen; 
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Mail;

class DepartemenController extends Controller
{
    /**
     * index
     * 
     * @return void
     */

     public function index(){
        //get posts
        $departemen = Departemen::latest()->paginate(5);

        //render view with posts
        return view('departemen.index',compact('departemen'));
     }
   /**
    * Delete
    *
    *@param int $id
    *@return void
    */
    public function destroy($id){
      Departemen::find($id)->delete();

      return redirect()->route('departemen.index')->withSuccess(__('post delete sukses'));
    }

   /**
    * 
    *Edit
    *
    *@param int $id
    *@param void
    */
   public function edit($id){
      $departemen = Departemen::find($id);

      return view('departemen.edit',compact('departemen'));
   }

   public function update(Request $request, $id)
    {
        $this->validate($request,[
         'nama_departemen' => 'required',
         'nama_manager' => 'required',
         'jumlah_pegawai' => 'required'
      ]);

        Departemen::find($id)->update($request->all());

        return redirect()->route('departemen.index')->with(['success' => 'Data berhasil di Update']);
    }

   


     /**
      * create
      *
      *@return void
      */
      public function create(){
         return view('departemen.create');
      }
      /**
       * store
       * 
       * @param Request $request
       * @return void
       */
      public function store(Request $request){
         $this->validate($request,[
            'nama_departemen' => 'required',
            'nama_manager' => 'required',
            'jumlah_pegawai' => 'required'
         ]);

         Departemen::create([
            'nama_departemen' => $request->nama_departemen,
            'nama_manager' => $request->nama_manager,
            'jumlah_pegawai' => $request->jumlah_pegawai 
         ]);

         try{
            $content = [
               'body' => $request->nama_departemen,
            ];

            Mail::to('tulungagung108@gmail.com')->send(new DepartemenMail($content));

            return redirect()->route('departemen.index')->with(['success' => 'Data berhasil disimpan, email telah dikirim']);

         }catch(Exception $e){
            return redirect()->route('departemen.index')->with(['success' => 'Data Berhasil Disimpan, namun gagal mengirim email']);
         }
      }
}
