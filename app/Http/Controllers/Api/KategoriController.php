<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Validator;
use App\Kategori;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori= Kategori::all();
        if (count($kategori) <= 0) {
            $response = [
                'success' => false,
                'data' => 'Empty',
                'message' => 'kategori tidak ditemukan.'
            ];
            return response()->json($response, 404);
        }
        $response = [
            'success' => true,
            'data' => $kategori,
            'message' => 'kategori berhasil di ambil'
        ];
        return response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // 1. Tampung semua inputan ke $input;
       $input = $request->all();

       // 2. Buat validasi ditampung ke $validator
       $validator = Validator::make($input, [
           'nama' => 'required|min:5'
       ]);

       // 3. Chek validasi
       if ($validator->fails()) {
           $response = [
           'success' => false,
           'data' => 'Validation Error.',
           'message' => $validator->errors()
       ];
       return response()->json($response, 500);
       }

       $kategori = new Kategori;
         $kategori->nama_kategori = $request->nama_kategori;
         $kategori->slug = str_slug($request->nama_kategori, '-');
         $kategori->save();

       // 5. Menampilkan response
       $response = [
           'success' => true,
           'data' => $kategori,
           'message' => 'Kategori berhasil ditambahkan.'
       ];

       //6. Tampilkan hasil
       return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kategori = kategori::Find($id);
        if (!$kategori) {
            $respons = [
                'success' => false,
                'data' => 'Empety',
                'message' => 'Kategori tidak ditemukan'
            ];
            return response()->json($respons, 404);
        }

        $respons = [
            'success' => true,
            'data' => "$kategori",
            'message' => 'Berhasil'
        ];
        return response()->json($respons, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kategori = kategori::Find($id);
        $input = $request->all();

        if (!$kategori) {
            $response = [
                'success' => false,
                'data' => 'Empety',
                'message' => 'Kategori tidak ditemukan'
            ];
            return response()->json($respons, 404);
        }

    $validator = Validator::make($input, [
        'nama' => 'required|min:5'
    ]);

    if ($validator->fails()) {
        $response = [
            'success' => false,
            'data' => 'Validation Error.',
            'message' => $validator->errors()
        ];
        return response()->json($response, 500);
    }

    $kategori->nama = $input['nama'];
    $kategori->save();

    $response = [
        'success' => true,
        'data' => $kategori,
        'message' => 'Kategori berhasil di update.'
    ];

    return response()->json($response, 200);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = kategori::Find($id);

        if (!$kategori) {
            $response = [
                'success' => false,
                'data' => 'Empty',
                'message' => 'Kategori tidak ditemukan'
            ];
            return response()->json($respons, 404);
        }

        $kategori->delete();

        $response = [
            'success' => true,
            'data' => $kategori,
            'message' => 'Kategori berhasil di hapus.'
        ];
    
        return response()->json($response, 200);
    
    }
    
}
