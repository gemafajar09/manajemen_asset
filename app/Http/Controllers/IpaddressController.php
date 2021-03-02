<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IpaddressController extends Controller
{
    public function index()
    {
        // aksi ambil semua data
        // eloquent
        // $data = PegawaiModel::all();
        $data = DB::table('tb_pegawai')->get();
        //  dd($data);
        return view('backend.page.pegawai.index',compact('data'));       
    }
}
