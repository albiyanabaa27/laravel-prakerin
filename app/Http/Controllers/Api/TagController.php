<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Validator;
use App\Tag;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag= Tag::all();
        if (count($tag) <= 0) {
            $response = [
                'success' => false,
                'data' => 'Empty',
                'message' => 'tag tidak ditemukan.'
            ];
            return response()->json($response, 404);
        }
        $response = [
            'success' => true,
            'data' => $tag,
            'message' => 'tag berhasil di ambil'
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
             'nama' => 'required|min:15'
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
 
         $tag = new Tag;
         $tag->nama_tag = $request->nama_tag;
         $tag->slug = str_slug($request->nama_tag, '-');
         $tag->save();

         // 5. Menampilkan response
         $response = [
             'success' => true,
             'data' => $tag,
             'message' => 'tag berhasil ditambahkan.'
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
        $tag = Tag::Find($id);
        if (!$tag) {
            $respons = [
                'success' => false,
                'data' => 'Empety',
                'message' => 'tag tidak ditemukan'
            ];
            return response()->json($respons, 404);
        }

        $respons = [
            'success' => true,
            'data' => "$tag",
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
        $tag = Tag::Find($id);
        $input = $request->all();

        if (!$tag) {
            $response = [
                'success' => false,
                'data' => 'Empety',
                'message' => 'tag tidak ditemukan'
            ];
            return response()->json($respons, 404);
        }

    $validator = Validator::make($input, [
        'nama' => 'required|min:15'
    ]);

    if ($validator->fails()) {
        $response = [
            'success' => false,
            'data' => 'Validation Error.',
            'message' => $validator->errors()
        ];
        return response()->json($response, 500);
    }

    $tag->nama = $input['nama'];
    $tag->save();

    $response = [
        'success' => true,
        'data' => $tag,
        'message' => 'tag berhasil di update.'
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
        $tag = Tag::Find($id);

        if (!$tag) {
            $response = [
                'success' => false,
                'data' => 'Empty',
                'message' => 'tag tidak ditemukan'
            ];
            return response()->json($respons, 404);
        }

        $tag->delete();

        $response = [
            'success' => true,
            'data' => $tag,
            'message' => 'tag berhasil di hapus.'
        ];
    
        return response()->json($response, 200);
    }
}
