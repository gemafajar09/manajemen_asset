<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class KategoriController extends Controller
{
    public function datatable() 
    {
        $data['kategori'] = DB::table('tb_kategori')->get();
        return view('backend.page.kategori.datakategori', $data);
    }

    public function index() 
    {
        $data['kategori'] = DB::table('tb_kategori')->get();
        // dd($data['kategori']);
        return view('backend.page.kategori.index', $data);
    }

    public function save(Request $r) 
    {
        $id = $r->kategori_id;
        if($id == '') 
        {
            $simpan = DB::table('tb_kategori')->insert(['kategori_nama' => $r->kategori_nama]);
            // rekap activity
            DB::table('tb_activity')->insert([
                'id_pegawai' => session('id'),
                'tanggal' => date('Y-m-d H:i:s'),
                'activity' => 'Menambah Data Kategori'
            ]);
            if($simpan == true) {
                $message = array('message' => 'Success!', 'title' => 'Data kategori berhasil ditambahkan');
                return response()->json($message);
            } 
            // return back()->with('pesan', 'Data Berhasil Disimpan');
        } else {
            $update = DB::table('tb_kategori')->where('kategori_id', $id)->update(['kategori_nama' =>$r->kategori_nama]);
            // rekap activity
            DB::table('tb_activity')->insert([
                'id_pegawai' => session('id'),
                'tanggal' => date('Y-m-d H:i:s'),
                'activity' => 'Mengubah Data Kategori'
            ]);
            if($update == true) {
                $message = array('message' => 'Success!', 'title' => 'Data kategori berhasil diubah');
                return response()->json($message);
            } 
            // return back()->with('pesan', 'Data Berhasil Diubah');
        }
    } 

    public function hapus($kategori_id)
    {
        $delete = DB::table('tb_kategori')->where('kategori_id', $kategori_id)->delete();
        // rekap activity
        DB::table('tb_activity')->insert([
            'id_pegawai' => session('id'),
            'tanggal' => date('Y-m-d H:i:s'),
            'activity' => 'menghapus Data Kategori'
        ]);
        // check data deleted or not
        if ($delete !== null) {
            $success = true;
            $message = "Data berhasil dihapus";
            
        } else {
            $success = true;
            $message = "Data tidak ditemukan";
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]); 
    }
}
