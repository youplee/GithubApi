<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GrahamCampbell\GitHub\Facades\GitHub;
use GrahamCampbell\GitHub\Facades\GitHub\Client;
use Github\ResultPager;
use GrahamCampbell\GitHub\GitHubManager;
use App\Recherche;
use App\Catalogue;
use DB;
use Auth;

class SearchController extends Controller
{
	//fonction qui traite la recherche avec l api github
	public function searchGithub(Request $request){

		$keyword 				= $request->get('keyword');
		$selectedLanguage 		= $request->get('selectedLanguages');
		$selectedTypeRecherche 	= $request->get('selectedTypeRecherche');
		$selectedSort			= $request->get('selectedSort');
		$selectedOrder          = $request->get('selectedOrder');
		$language 				='';

		if($selectedLanguage){

			$language = $selectedLanguage;

		}

		$dataResult   	 = Github::api('search')->{$selectedTypeRecherche}($request->get('keyword').' language:'.$language, $selectedSort, $selectedOrder);
		$items     		 = $dataResult['items'];
		$data 	 	     = [];
   		$typeRechercheId = Recherche::where('libelle', 	$selectedTypeRecherche)->first()->id;

		foreach($items as $item){

// j ai commenter cette partie par ce que nombre requete est petit ce qui bloque l application
			// $languageInfo = $this->getLanguage($item['repository']['languages_url']);
			// $dataLanguages = [];

			// foreach ($languageInfo as $key => $value){

			// 	$dataLanguage = ['nameLanguage' => $key, 'versionLanguage' => $value];
			// 	array_push($dataLanguages, $dataLanguage);

			// }

			$catalogue = Catalogue::where('lien', $item['html_url'])->where('typeRecherche_id', $typeRechercheId)->first();

			if(!$catalogue){

				$result = ['html_url' => $item['html_url'], 'score' => $item['score'], 'languages' => $language, 'typeRechercheId' => $typeRechercheId, 'favorite' => 0];

			}elseif(DB::table('favorites')->where('user_id', Auth::user()->id)->where('favoriteable_id', $catalogue->id)->exists()){

				$result = ['html_url' => $item['html_url'], 'score' => $item['score'], 'languages' => $language, 'typeRechercheId' => $typeRechercheId, 'favorite' => 1];

			}else{
								
				$result = ['html_url' => $item['html_url'], 'score' => $item['score'], 'languages' => $language, 'typeRechercheId' => $typeRechercheId, 'favorite' => 0];
			}

			array_push($data, $result);

		}
		return $data;
	}

//fonction qui recupere les languages 
	public function getLanguage($url){

        $client  		 = new \GuzzleHttp\Client();
		$resultLanguages = $client->request('GET', $url)->getBody();
		$return 		 = json_decode($resultLanguages, true);
		return $return;
	}

}
