<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artikel;
use Session;
use Auth;
use App\Kategori;
use App\Tag;
use File;
use Illuminate\Queue\Jobs\SyncJob;

class Artikel_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artikel = Artikel::orderBy('created_at', 'desc')->get();
        return view('backend.artikel.index', compact('artikel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        $tag = Tag::all();
        return view('backend.artikel.create', compact('kategori', 'tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $input = $request->all();
        $request->validate([
            'judul' => 'required|unique:artikels',
            'konten' => 'required',
            'foto' => 'required',
            'id_kategori' => 'required',
            'tag' => 'required'
        ]);

        $artikel = new Artikel;
        $artikel->judul = $request->judul;
        $artikel->slug = str_slug($request->judul);
        $artikel->konten = $request->konten;
        $artikel->id_user = Auth::user()->id;
        $artikel->id_kategori = $request->id_kategori;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $destinationPath = public_path() . '/assets/img/artikel/';
            $filename = str_random(6) . '_' . $file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPath, $filename);
            $artikel->foto = $filename;
        }

        $artikel->save();
        $artikel->tag()->attach($request->tag);
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menyimpan data artikel berjudul <b>$artikel->judul</b>!"
        ]);
        return redirect()->route('artikel.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artikel = Artikel::findOrFail($id);
        $tag = Tag::all();
        $kategori = Kategori::all();
        return view('backend.artikel.show', compact('artikel', 'selected', 'tag', 'kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        $kategori = Kategori::all();
        $tag = tag::all();
        $selected = $artikel->tag->pluck('id')->toArray();
        return view('backend.artikel.edit', compact('artikel', 'selected', 'kategori', 'tag'));
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
        // $input = $request->all();
        $request->validate([
            'judul' => 'required|unique:artikels',
            'konten' => 'required',
            'foto' => 'required',
            'id_kategori' => 'required',
            'tag' => 'required'
        ]);

        $artikel = Artikel::findOrFail($id);
        $artikel->judul = $request->judul;
        $artikel->slug = str_slug($request->judul);
        $artikel->konten = $request->konten;
        $artikel->id_user = Auth::user()->id;
        $artikel->id_kategori = $request->id_kategori;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $destinationPath = public_path() . '/assets/img/artikel/';
            $filename = str_random(6) . '_' . $file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPath, $filename);
            $artikel->foto = $filename;
        }

        // if ($artikel->foto) {
        //     $old_foto = $artikel->foto;
        //     $filepath = public_path() . '/assets/img/' . $artikel->foto;
        //     try {
        //         File::delete($filepath);
        //     } catch (FileNotFoundException $e) { }

            $artikel->save();
            $artikel->tag()->sync($request->tag);
            $response = [
                'success' => true,
                'data' => $artikel,
                'message' => "data kategori berhasil dihapus" 
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
        $artikel = Artikel::findOrFail($id);
        if ($artikel->foto) {
            $old_foto = $artikel->foto;
            $filepath = public_path() . '/assets/img/artikel/' . $artikel->foto;
            try {
                File::delete($filepath);
            } catch (FileNotFoundException $e) { }
        }

        $artikel->tag()->detach($artikel->id);
        $artikel->delete();
        Session::flash("flash_notification", [
            "level" => "danger",
            "message" => "Berhasil menghapus data artikel berjudul <b>$artikel->judul</b>!"
        ]);
        return redirect()->route('artikel.index');
    }
}
