<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PHPTestController extends Controller
{
    public function shortestWord(){
        $string = "TRUE FRIENDS ARE ME AND YOU";
        //Convert the string to array of string per word
        $wordArray = explode(' ', $string);
        $currentShortest = null;
        $i = 0;
        $shortestWords = [];
        //Compare and assign shortest word of wordArray
        foreach($wordArray as $a=>$word){
            if($currentShortest != null){
                if(strlen($word) <= strlen($currentShortest) ){
                    $currentShortest = $word;
                    //Check if the shortest word exist in the array
                    if(!(in_array($word, $shortestWords))){
                        if(count($shortestWords) > 0){
                            //Check if theres an existing element in $shortestWords array that is longer than selected word ($word)
                            foreach($shortestWords as $b=>$shortestWord){
                                //If $word is less than $shortestWord then remove the existing element
                                if(strlen($word) < strlen($shortestWord) ){
                                    unset($shortestWords[$b]);
                                }
                            }
                            //Add the word;
                            array_push($shortestWords, $word);
                        }
                        else{
                            array_push($shortestWords, $word);
                        }
                    }
                }
            }
            else{
                $currentShortest = $word;
            }
        }
        echo "GIVEN SENTENCE: $string <br> <br>";
        if(count($shortestWords) > 1){
            echo "The shortest words are ".implode(',',$shortestWords);
        }
        else{
            echo "The shortest words is ".implode(',',$shortestWords);
        }

    }

    public function wordSearch(){
        $search = "TWO";
        $wordArray = ["I","TWO","FORTY","THREE","JEN","TWO","tWo","Two"];
        $index = [];

        //Will Search from first to last index
        foreach($wordArray as $key=>$word){
            if($word == $search ){
                array_push($index, $key);
            }
        }
        //Print Results
        echo "GIVEN LIST : [".implode(', ',$wordArray)."]"."<br>";
        echo "SEARCHING FOR : ".$search."<br>";
        if(count($index)){
            echo "FOUNT IN INDEX [".implode(', ',$index)."]"."<br>";
        }
        else{
            echo "No Results" ;
        }
    }

    public function countTheIslands(){
        $imageArray = [];
        $imageOutput = [];
        $height = 10;
        $width = 10;

        //Generate Image Array (Given)
        for($h = 0; $h <= ($height - 1); $h++){
            for($w = 0; $w <= ($width - 1); $w++){
                $imageArray[$h][$w] = rand(0,1);
            }
        }
        //Generate Image Output Array
        foreach($imageArray as $pkey=>$pixels){
            $transformed = null;
            foreach($pixels as $pixel){
                 $transformed .= $pixel ? "X" : '~';
            }
            $imageOutput[$pkey] = $transformed;
        }

        //Print Image Array (Given)
        if(count($imageArray)){
            echo "GIVEN: <br>";
            foreach ($imageArray as $pixel){
                echo "[".implode(',', $pixel)."] <br>";
            }
        }
        echo "<br> <br>";
        //Print Image Output Array
        if(count($imageOutput)){
            echo "OUTPUT: <br>";
            foreach ($imageOutput as $pixel){
                echo $pixel."<br>";
            }
        }
    }

}
