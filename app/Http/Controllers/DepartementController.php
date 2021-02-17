<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DepartementController extends Controller
{
    public function datatable() 
    {
        $data['departement'] = DB::table('tb_departement')->get();
        return view('backend.page.departement.dataDepartement', $data);
    }

    public function index() 
    {
        $data['departement'] = DB::table('tb_departement')->get();
        return view('backend.page.departement.index', $data);
    }

    public function save(Request $r) 
    {
        $id = $r->departement_id;
        if($id == '') 
        {
            $save = DB::table('tb_departement')->insert(['departement_nama' => $r->departement_nama]); 
            // rekap activity
            DB::table('tb_activity')->insert([
                'id_pegawai' => session('id'),
                'tanggal' => date('Y-m-d H:i:s'),
                'activity' => 'Menambah Data Lokasi'
            ]);
            $message = array('message' => 'Success!', 'title' => 'Lokasi berhasil ditambahkan');
                return response()->json($message);
        } else {
            $update = DB::table('tb_departement')->where('departement_id', $id)->update(['departement_nama' =>$r->departement_nama]);
            // rekap activity
            DB::table('tb_activity')->insert([
                'id_pegawai' => session('id'),
                'tanggal' => date('Y-m-d H:i:s'),
                'activity' => 'Mengubah Data Lokasi'
            ]);
            $message = array('message' => 'Success!', 'title' => 'Lokasi berhasil diubah');
                return response()->json($message);
        }
    }

    public function hapus(Request $r)
    {
        $departement_id = $r->departement_id;

        $hapus = DB::table('tb_departement')->where('departement_id', $departement_id)->delete();

        if($hapus == true) 
        { 
            $message = array('message' => 'Success!', 'title' => 'Data berhasil dihapus');
            // rekap activity
            DB::table('tb_activity')->insert([
                'id_pegawai' => session('id'),
                'tanggal' => date('Y-m-d H:i:s'),
                'activity' => 'Menghapus Data Lokasi'
            ]);
            return response()->json($message);
        }
    }
    
}
