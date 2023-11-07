<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    public function create()
    {
        return view ('create_picture');
    }

    public function store(Request $request)
    {
        $file = $request->file('file');
        $name = $request->name;

        // untuk menghindari data yang duplikat
        // satuan time nya milisecond atau disebut unix time
        $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();

        // class storage ke disk('local') akan put file ke direktori public, nama filenya path
        // parameter kedua dari file yang diinput
        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        Picture::create([
            'name' => $name,
            'path' => $path
        ]);

        return Redirect::route('picture.create');
    }

    // untuk melihat foto setelah di upload
    public function show(Picture $picture)
    {
        $url = Storage::url($picture->path);
        return view('show_picture', compact('url', 'picture'));
    }

    // delete file
    public function delete(Picture $picture)
    {
        Storage::delete('public/' . $picture->path);
        $picture->delete();
        return Redirect::route('picture.create');
    }

    //copy
    public function copy(Picture $picture)
    {
        Storage::copy('public/' . $picture->path, 'copy/' . $picture->path);
        return Redirect::route('picture.create');
    }

    //copy
    public function move(Picture $picture)
    {
        Storage::move('public/' . $picture->path, 'move/' . $picture->path);
        return Redirect::route('picture.create');
    }
}
