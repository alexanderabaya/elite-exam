<?php

namespace App\Livewire;

use App\Models\Album;
use App\Models\Artist;
use App\Models\ArtistAlbum;
use Livewire\Component;
use Illuminate\Support\Str;
class Dashboard extends Component
{
    public function getArtistAlbum(){
        $artistAlbums = ArtistAlbum::all();

        foreach($artistAlbums as $artistAlbum){
            $artist = Artist::where('name', $artistAlbum->artist)->first();
            if(!$artist){
                $artist = Artist::create([
                    'code' => Str::uuid(),
                    'name' => $artistAlbum->artist,
                ]);
            }

            $album = Album::create([
                'artist_id' => $artist->id,
                'name' => $artistAlbum->album,
                'sales' => $artistAlbum->sales,
                'date_released' => date_create_from_format('ymd', $artistAlbum->date_released)->format('Y-m-d'),
                'last_update' => date_create_from_format('ymd', $artistAlbum->last_update)->format('Y-m-d'),
            ]);
        }
    }

    public $shortestWords = [];

    public function shortestWord(){
        $string = "TRUE FRIENDS ARE ME AND YOU IN ME AN";
        $wordArray = explode(' ', $string);
        $currentShortest = null;
        $i = 0;
        foreach($wordArray as $key=>$word){
            if($currentShortest != null){
                if(strlen($word) <= strlen($currentShortest) ){
                    $currentShortest = $word;
                    if(!(in_array($word, $this->shortestWords))){
                        $this->addShortestWord($word);
                    }
                }
            }
            else{
                $currentShortest = $word;
            }
        }
        dd($this->shortestWords);
    }

    public function addShortestWord($word){
        if(count($this->shortestWords) > 0){
            foreach($this->shortestWords as $key=>$shortestWord){
                if(strlen($word) < strlen($shortestWord) ){
                    unset($this->shortestWords[$key]);
                }
            }
            array_push($this->shortestWords, $word);
        }
        else{
            array_push($this->shortestWords, $word);
        }
    }

    public $search;

    public function wordSearch(){
        $this->search = "TWO";
        $wordArray = ["I","TWO","FORTY","THREE","JEN","TWO","tWo","Two"];
        $index = [];
        foreach($wordArray as $key=>$word){
            if($word == $this->search ){
                array_push($index, $key);
            }
        }

        if(count($index)){
            dd($index);
        }
        else{
            dd("No Results");
        }

    }
    public $imageArray = [];
    public $imageOutput = [];
    public function countTheIslands(){
        $height = 10;
        $width = 10;
        for($h = 0; $h <= ($height - 1); $h++){
            for($w = 0; $w <= ($width - 1); $w++){
                $this->imageArray[$h][$w] = rand(0,1);
            }
        }

        foreach($this->imageArray as $pkey=>$pixels){
            $transformed = null;
            foreach($pixels as $pixel){
                 $transformed .= $pixel ? "X" : '~';
            }
            $this->imageOutput[$pkey] = $transformed;
        }
    }


    public function render()
    {
        return view('livewire.dashboard');
    }
}
