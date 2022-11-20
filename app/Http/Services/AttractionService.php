<?php

namespace App\Http\Services;

use App\Http\Resources\AttractionResource;
use App\Models\Attraction;
use App\Models\Image;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AttractionService
{
    public function store($data)
    {
        $data['id_creator'] = auth()->user()->id;

        try{
            $wikiUrl = 'https://ru.wikipedia.org/';
            $wikiHttp = Http::get($wikiUrl."w/api.php?format=json&list=search&action=query&srsearch=".$data['title']);
            $wikiInfo = json_decode($wikiHttp->body())->query->search[0]??null;

            if(!is_null($wikiInfo)){
                $link = $wikiUrl.'?curid='.$wikiInfo->pageid;
                $data['wiki_info'] = $wikiInfo->snippet;
                $data['wiki_info_link'] = $link;
                $status = 'success';
            } else {
                $status = 'wiki_not_found';
            }

            $images = $data['images'];
            unset($data['images']);

            $attraction = Attraction::firstOrCreate($data);

            if(isset($images)) {
                foreach ($images as $image) {
                    Image::create(['path'=> Storage::disk('public')->put('/images', $image), 'id_attraction' => $attraction->id]);
                }
            }

            return ['attraction_created' => $status,  'attraction' => new AttractionResource($attraction)];
        } catch (\Illuminate\Database\QueryException $e){
            return ['error' => $e];
        }
    }
}
