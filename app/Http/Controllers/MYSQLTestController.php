<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;

class MYSQLTestController extends Controller
{
    public function albumSoldPerArtist(){
        //MYSQL QUERY
        // SELECT ar.name AS "artist_name",
        // COUNT(al.id) AS "number_of_sold_albums"
        // FROM artist ar
        // LEFT JOIN album al ON ar.id = al.artist_id
        // GROUP BY ar.id;

        //LARAVEL ELOQUENT
        $artistsCollection = Artist::all();

        $artists = $artistsCollection->map(function ($artist) {
            return [
                'artist_name' => $artist->name,
                'number_of_sold_albums' => $artist->album->count(),
            ];
        });

        dd($artists);
    }

    public function combinedAlbumSalesPerArtist(){
        //MYSQL QUERY
        // SELECT ar.name AS "artist_name",
        // SUM(al.sales) AS "total_sales"
        // FROM artist ar
        // LEFT JOIN album al ON ar.id = al.artist_id
        // GROUP BY ar.id;

        //LARAVEL ELOQUENT
        $artistsCollection = Artist::all();

        $artists = $artistsCollection->map(function ($artist) {
            return [
                'artist_name' => $artist->name,
                'total_sales' => $artist->album->sum('sales'),
            ];
        });

        dd($artists);
    }

    public function topOneArtist(){
        //MYSQL QUERY
        // SELECT ar.name AS "artist_name",
        // SUM(al.sales) AS "total_sales"
        // FROM artist ar
        // LEFT JOIN album al ON ar.id = al.artist_id
        // GROUP BY ar.id
        // ORDER BY SUM(al.sales) desc
        // LIMIT 0,1;

        //LARAVEL ELOQUENT
        $topArtist = Artist::withSum('album', 'sales')
        ->orderBy('album_sum_sales', 'desc')
        ->first();

        $artists = [
            'artist_name' => $topArtist->name,
            'total_sales' => $topArtist->album_sum_sales,
        ];

        dd($artists);
    }

    public function topTenAlbumsPerYear(){
        //MYSQL QUERY
        // SELECT album.name as "album_name",
        // YEAR(album.last_update) AS "year_sales"
        // FROM album
        // WHERE  YEAR(album.last_update) = 2022
        // ORDER BY album.sales desc
        // LIMIT 0,10;

        //LARAVEL ELOQUENT
        $year = 2022;
        $albumCollection = Album::whereYear('date_released', $year)
        ->orderBy('sales', 'desc')
        ->take(10)
        ->get();

        $albums = $albumCollection->map(function ($album) {
            return [
                'album_name' => $album->name,
                'year_sales' => $album->sum('sales'),
            ];
        });

        dd($albums);
    }

    public function albumSearchByArtist(){
        //MYSQL QUERY
        // SELECT al.name AS "album_name",
        // ar.name AS "artist_name"
        // FROM album al
        // LEFT JOIN artist ar ON al.artist_id = ar.id
        // WHERE al.name LIKE '%SMTOWN%'
        // ORDER BY al.name ASC;

        //LARAVEL ELOQUENT
        $search = "SMTOWN";
        $albumCollection = Album::whereHas('artist', function($query) use($search){
            $query->where('name', 'like', '%'.$search.'%');
        })
        ->orderBy('name', 'asc')
        ->get();

        $albums = $albumCollection->map(function ($album) {
            return [
                'artist_name' => $album->artist->name,
                'album_name' => $album->name,
            ];
        });

        dd($albums);
    }
}
