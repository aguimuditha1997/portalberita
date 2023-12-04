<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artikel = Artikel::all();
        return view('back.artikel.index' ,
        ['artikel' => $artikel ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('back.artikel.create',compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|min:4',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->body);
        $data['user_id'] = Auth::id();
        $data['views'] = Auth::id();
        $data['gambar_artikel'] = $request->file('gambar_artikel')->store('artikel');

        Artikel::create($data);
        return redirect()->route('artikel.index')->with(['success'=>'Data Berhasil Tersimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $artikel = Artikel::find($id);

        $kategori = Kategori::all();

        return view('back.artikel.edit', compact('artikel','kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $this->validate($request, [
        //     'judul' => 'required|min:4',
        // ]);

        if(empty($request->file('gambar_artikel'))){

        $artikel = Artikel::find($id);
        $artikel->update([
            'judul'=> $request->judul,
            'body'=> $request->body,
            'slug' => Str::slug($request->body),
            'kategori_id'=> $request->kategori_id,
            'is_active'=> $request->is_active,
            'user_id' => Auth::id(),
            'views' => 0,
        ]);
        return redirect()->route('artikel.index')->with(['success'=>'Data Berhasil Terupdate']);

        }else{
            $artikel = Artikel::find($id);
            Storage::delete($artikel->gambar_artikel);
            $artikel->update([
                'judul'=> $request->judul,
                'body'=> $request->body,
                'slug' => Str::slug($request->body),
                'kategori_id'=> $request->kategori_id,
                'is_active'=> $request->is_active,
                'user_id' => Auth::id(),
                'views' => 0,
                'gambar_artikel' => $request->file('gambar_artikel')->store('artikel'),

            ]);
            return redirect()->route('artikel.index')->with(['success'=>'Data Berhasil Terupdate']);
        }



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $artikel = Artikel::find($id);

        Storage::delete($artikel->gambar_artikel);

        $artikel->delete();

        return redirect()->route('artikel.index')->with(['success'=>'data berhasil dihapus']);
    }
}
