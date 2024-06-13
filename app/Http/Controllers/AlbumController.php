<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class AlbumController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');
        $albumCount = Album::all()->count();
        $albums =  Album::where(function($query) use($search){
            $query->where('name', 'like', '%'.$search.'%')
            ->orWhereHas('artist', function($query) use($search){
                $query->where('name', 'like', '%'.$search.'%');
            });
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('album.index',[
            'search' => $search,
            'albumCount' => $albumCount,
            'albums' => $albums,
        ]);
    }

    public function create(Request $request){
        $artistId = null;
        $artist = Artist::where('id',  $request->query('artist'))->first();
        if($artist){
            $artistId = $artist->id;
        }

        $artists = Artist::all();
        return view('album.create', [
            'artist' => $artist,
            'artists' => $artists,
            'artistId' => $artistId
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'artist' => 'required|numeric',
            'name' => 'required|max:255',
            'image' => 'nullable',
            'sales' => 'required|numeric',
            'dateReleased' => 'required|date',
            'lastUpdate' => 'required|date',
        ]);

        $image = null;
        if($request->input('image')){
            $image_parts = explode(";base64,", $request->input('image'));
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $folderPath = public_path('database-image/album-image/');
            $image = Str::random(10).time() . '.png';
            $imageFullPath = $folderPath.$image;
            file_put_contents($imageFullPath, $image_base64);
        }

        $album = Album::create([
            'artist_id' => $request->input('artist'),
            'name' => $request->input('name'),
            'sales' => $request->input('sales'),
            'date_released' => $request->input('dateReleased'),
            'last_update' => $request->input('lastUpdate'),
            'image' => $image,
        ]);

        alert()->success('Success', 'Album Added Successfully.')->showConfirmButton('Okay', '#f55247');
        return redirect()->route('album.show', $album->id);
    }

    public function show($id){
        $album = Album::where('id', $id)->first();
        if(!$album){
            abort(404);
        }

        return view('album.show',[
            'album' => $album
        ]);
    }

    public function edit($id){
        $album = Album::where('id', $id)->first();
        if(!$album){
            abort(404);
        }
        $artists = Artist::all();
        return view('album.edit',[
            'album' => $album,
            'artists' => $artists,
        ]);
    }

    public function update($id, Request $request){
        $album = Album::where('id', $id)->first();
        if(!$album){
            abort(404);
        }

        $request->validate([
            'artist' => 'required|numeric',
            'name' => 'required|max:255',
            'image' => 'nullable',
            'sales' => 'required|numeric',
            'dateReleased' => 'required|date',
            'lastUpdate' => 'required|date',
        ]);

        $image = $album->image;
        if($request->input('image')){
            $image_parts = explode(";base64,", $request->input('image'));
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $folderPath = public_path('database-image/album-image/');
            $image = Str::random(10).time() . '.png';
            $imageFullPath = $folderPath.$image;
            file_put_contents($imageFullPath, $image_base64);
            if($album->image){
                if (file_exists(public_path('database-image/album-image/'.$album->image))) {
                    unlink('database-image/album-image/'.$album->image);
                }
            }
        }

        Album::where('id', $album->id)
        ->update([
            'artist_id' => $request->input('artist'),
            'name' => $request->input('name'),
            'sales' => $request->input('sales'),
            'date_released' => $request->input('dateReleased'),
            'last_update' => $request->input('lastUpdate'),
            'image' => $image,
        ]);

        alert()->success('Success', 'Album Updated Successfully.')->showConfirmButton('Okay', '#f55247');
        return redirect()->route('album.show', $album->id);
    }

    public function delete(Request $request){
        $album = Album::where('id', $request->input('id'))->first();
        if(!$album){
            abort(404);
        }

        if($album->image){
            if (file_exists(public_path('database-image/album-image/'.$album->image))) {
                unlink('database-image/album-image/'.$album->image);
            }
        }
        Album::where('id', $album->id)->delete();

        alert()->success('Success', 'Artist Deleted Successfully.')->showConfirmButton('Okay', '#f55247');
        return redirect()->back();
    }
}
