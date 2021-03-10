<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\getUserModel;

class getUserController extends Controller
{
    public function index() {
        $data = getUserModel::all();
        // dd($data); 
        return view('backend.page.ipaddress.index',compact('data'));   
        // return response()->json([$data]);

        // $data['getUser'] = DB::table('getUser_uke')->get();
        // // dd($data['kategori']);
        // // return view('backend.page.kategori.index', $data);
        // return response()->json([$data]);
    }
}
