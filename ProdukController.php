<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function show()
    {
        return Produk::all();
    }

    public function detail($id)
    {
    if(Produk3::where('id_produk', $id)->exists()) {
    $data = DB::table('produk')->where('produk.id_produk', '=', $id)->get();
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
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'foto_produk' => 'required',
        ]
    );
    if($validator->fails()) {
        return Response()->json($validator->errors());
    }
    $simpan = Produk::create([
        'nama_produk' => $request->nama_produk,
        'deskripsi' => $request->deskripsi,
        'harga' => $request->harga,
        'foto_produk' => $request->foto_produk,
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