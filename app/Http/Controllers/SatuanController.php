<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SatuanController extends Controller
{ 
    public function datatable() {
        $data['satuan'] = DB::table('tb_satuan')->get();
        return view('backend.page.satuan.dataSatuan', $data);
    }

    public function index() 
    {
        $data['satuan'] = DB::table('tb_satuan')->get();
        return view('backend.page.satuan.index', $data);
    }

    public function save(Request $r) 
    {
        $id = $r->satuan_id;
        if($id == '')
        {
            $save = DB::table('tb_satuan')->insert(['satuan_nama' => $r->satuan_nama]);
            if($save == true) {
                $message = array('message' => 'Success!', 'title' => 'Data satuan berhasil ditambahkan');
                // rekap activity
                DB::table('tb_activity')->insert([
                    'id_pegawai' => session('id'),
                    'tanggal' => date('Y-m-d H:i:s'),
                    'activity' => 'Menambah Data Satuan'
                ]);
                return response()->json($message);
            } 
            // return back()->with('pesan', 'Data Berhasil Disimpan');
        } else {
            $update = DB::table('tb_satuan')->where('satuan_id', $id)->update(['satuan_nama' => $r->satuan_nama]);
            // rekap activity
            DB::table('tb_activity')->insert([
                'id_pegawai' => session('id'),
                'tanggal' => date('Y-m-d H:i:s'),
                'activity' => 'Mengubah Data Satuan'
            ]);
            if($update == true) {
                $message = array('message' => 'Success!', 'title' => 'Data satuan berhasil diubah');
                return response()->json($message);
            }
        }
    }

    public function hapus(Request $r)
    {
        $satuan_id = $r->satuan_id;

        $hapus = DB::table('tb_satuan')->where('satuan_id', $satuan_id)->delete();
        // rekap activity
        DB::table('tb_activity')->insert([
            'id_pegawai' => session('id'),
            'tanggal' => date('Y-m-d H:i:s'),
            'activity' => 'Menghapus Data Satuan'
        ]);

        if($hapus == true) 
        { 
            $message = array('message' => 'Success!', 'title' => 'Data berhasil dihapus');
            return response()->json($message);
        }
    }
}
