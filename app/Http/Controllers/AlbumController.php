<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');
        $albumCount = Album::all()->count();
        $albums =  Album::where('name', 'like', '%'.$search.'%')
        ->orderBy('created_at', 'asc')
        ->paginate(10);

        return view('album.index',[
            'search' => $search,
            'albumCount' => $albumCount,
            'albums' => $albums,
        ]);
    }

    public function create(Request $request){
        return view('album.create');
    }

    public function store(Request $request){
        $request->validate([
            'code' => 'required|max:60|unique:artist,code',
            'name' => 'required|max:255|unique:artist,code',
        ]);

        $album = Artist::create([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
        ]);

        alert()->success('Success', 'Artist Added Successfully.')->showConfirmButton('Okay', '#f55247');
        return redirect()->route('artist.show', $artist->id);
    }

    public function show($id, Request $request){
        $artist = Album::where('id', $id)->first();
        if(!$artist){
            abort(404);
        }
        $search = $request->input('search');
        $albumCount = Album::where('artist_id', $artist->id)->count();
        $albums =  Album::where('name', 'like', '%'.$search.'%')
        ->where('artist_id', $artist->id)
        ->orderBy('created_at', 'asc')
        ->paginate(10);


        return view('artist.show', [
            'artist' => $artist,
            'search' => $search,
            'albumCount' => $albumCount,
            'albums' => $albums,
        ]);
    }

    public function edit($id){
        $artist = Artist::where('id', $id)->first();
        if(!$artist){
            abort(404);
        }

        return view('artist.edit',[
            'artist' => $artist
        ]);
    }

    public function update($id, Request $request){
        $artist = Artist::where('id', $id)->first();
        if(!$artist){
            abort(404);
        }
        $request->validate([
            'code' => 'required|max:60|unique:artist,code,'.$artist->id,
            'name' => 'required|max:255|unique:artist,code,'.$artist->id,
        ]);

        // Artist::where('id', $artist->id)
        // ->update([
        //     'code' => $request->input('code'),
        //     'name' => $request->input('name'),
        // ]);

        alert()->success('Success', 'Artist Updated Successfully.')->showConfirmButton('Okay', '#f55247');
        return redirect()->route('artist.show', $artist->id);
    }

    public function destroy(Request $request){
        $artist = Artist::where('id', $request->input('id'))->first();
        if(!$artist){
            abort(404);
        }
        Artist::where('id', $artist->id)->delete();

        alert()->success('Success', 'Artist Deleted Successfully.')->showConfirmButton('Okay', '#f55247');
        return redirect()->back();
    }
}