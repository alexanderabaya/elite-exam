<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');
        $artistCount = Artist::all()->count();
        $artists =  Artist::where('name', 'like', '%'.$search.'%')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        //Select Top 1 Artist
        $topArtist = Artist::withSum('album', 'sales')
        ->orderBy('album_sum_sales', 'desc')
        ->first();

        return view('artist.index',[
            'search' => $search,
            'artistCount' => $artistCount,
            'artists' => $artists,
            'topArtist' => $topArtist

        ]);
    }

    public function create(Request $request){
        return view('artist.create');
    }

    public function store(Request $request){
        $request->validate([
            'code' => 'required|max:60|unique:artist,code',
            'name' => 'required|max:255|unique:artist,code',
        ]);

        $artist = Artist::create([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
        ]);

        alert()->success('Success', 'Artist Added Successfully.')->showConfirmButton('Okay', '#f55247');
        return redirect()->route('artist.show', $artist->id);
    }

    public function show($id, Request $request){
        $artist = Artist::where('id', $id)->first();
        if(!$artist){
            abort(404);
        }
        $search = $request->input('search');
        $albumCount = Album::where('artist_id', $artist->id)->count();
        $albums =  Album::where('name', 'like', '%'.$search.'%')
        ->where('artist_id', $artist->id)
        ->orderBy('created_at', 'desc')
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

        Artist::where('id', $artist->id)
        ->update([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
        ]);

        alert()->success('Success', 'Artist Updated Successfully.')->showConfirmButton('Okay', '#f55247');
        return redirect()->route('artist.show', $artist->id);
    }

    public function delete(Request $request){
        $artist = Artist::where('id', $request->input('id'))->first();
        if(!$artist){
            abort(404);
        }

        $albums = Album::where('artist_id', $artist->id)->get();
        foreach($albums as $album){
            if($album->image){
                if (file_exists(public_path('database-image/album-image/'.$album->image))) {
                    unlink('database-image/album-image/'.$album->image);
                }
            }
            Album::where('id', $album->id)->delete();
        }

        Artist::where('id', $artist->id)->delete();

        alert()->success('Success', 'Artist Deleted Successfully.')->showConfirmButton('Okay', '#f55247');
        return redirect()->back();
    }
}
