<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Artist;
use App\Models\ArtistAlbum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArtistAlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $artistAlbums = ArtistAlbum::all();

        foreach($artistAlbums as $artistAlbum){
            $artist = Artist::where('name', $artistAlbum->artist)->first();
            if(!$artist){
                $artist = Artist::factory()->create([
                    'name' => $artistAlbum->artist,
                ]);
            }
            Album::factory()->create([
                'artist_id' => $artist->id,
                'name' => $artistAlbum->album,
                'sales' => $artistAlbum->sales,
                'date_released' => date_create_from_format('ymd', $artistAlbum->date_released)->format('Y-m-d'),
                'last_update' => date_create_from_format('ymd', $artistAlbum->last_update)->format('Y-m-d'),
            ]);
        }
    }
}
