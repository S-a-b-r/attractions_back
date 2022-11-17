<?php

namespace App\Http\Services;

use App\Http\Resources\AttractionResource;
use App\Models\Attraction;
use Illuminate\Support\Facades\Http;

class AttractionService
{
    public function store($data)
    {
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
            $attraction = Attraction::firstOrCreate($data);
            return ['attraction_created' => $status,  'attraction' => new AttractionResource($attraction)];
        } catch (\Illuminate\Database\QueryException $e){
            return ['error' => $e];
        }
    }
}
