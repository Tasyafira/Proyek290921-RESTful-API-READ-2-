<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PetugasController extends Controller
{
    public function show()
    {
        return Petugas::all();
    }

    public function detail($id)
    {
    if(Petugas3::where('id_petugas', $id)->exists()) {
    $data = DB::table('petugas')->where('petugas.id_petugas', '=', $id)->get();
    return Response()->json($data);
   }
    else {
    return Response()->json(['message' => 'Tidak ditemukan' ]);
}
}

    public function store(Request $request)
 {
    $validator=Validator::make($request->all(),
        [
            'nama_petugas' => 'required',
            'username' => 'required',
            'password' => 'required',
            'level' => 'required',
        ]
    );
    if($validator->fails()) {
        return Response()->json($validator->errors());
    }
    $simpan = Petugas::create([
        'nama_petugas' => $request->nama_petugas,
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'level' => $request->level
    ]);
 if($simpan)
 {
 return Response()->json(['status' => 1]);
 }
 else
 {
 return Response()->json(['status' => 0]);
 }
 }
}