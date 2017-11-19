<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catalogue;
use Auth;
use DB;
use Mail;
use App\Http\Controllers\ShortUrlGoogleController;

class CatalogueController extends Controller
{
    public function ajoutFavori(Request $request){

    	$result 	= $request->get('result');
		$catalogue 	= Catalogue::firstOrNew(
    				['lien' => $result['html_url']], ['typeRecherche_id' => $result['typeRechercheId']]
					);
					$catalogue->save();
        $user  		= Auth::user();
        $favorite 	= DB::table('favorites')->where('user_id', $user->id)
   					->where('favoriteable_id', $catalogue->id)
    				->exists();

    	if(!$favorite){

    		$user->addFavorite($catalogue);

    	}

    return $data = ['catalogueId' => $catalogue->id];

    }

    public function retraitFavori(Request $request){

    	$result 	= $request->get('result');
		$catalogue 	= Catalogue::firstOrNew(
    				['lien' => $result['html_url']], ['typeRecherche_id' => $result['typeRechercheId']]
					);
		$catalogue->save();
        $user   	= Auth::user();
		$user->removeFavorite($catalogue);
        return $data = ['catalogueId' => $catalogue->id];

    }

    public function retraitFavoriFromProfil(Request $request){

        $favorite  = $request->get('favorite');
        $user       = Auth::user();
        $catalogue = Catalogue::find($favorite['id']);
        $user->removeFavorite($catalogue);
        return $data = ['catalogueId' => $catalogue->id];

    }

    public function sendEmailFavori(Request $request){

    	$result 	= $request->get('result');
    	$catalogue 	= Catalogue::find($request->get('catalogueId'));
        $user   	= Auth::user();
        $urlshort 	= new ShortUrlGoogleController();
        $key      	= 'AIzaSyBHxOoC-ICQGKDUAHfzOqAZLeGF-HVyUWU';
        $shortUrl  	= $urlshort->shorten($result['html_url'], $key, "https://www.googleapis.com/urlshortener/v1/url");
        Mail::send('emails.addFavorite', [ 
                                            'user'       => $user, 
                                            'catalogue'  => $catalogue,
                                            'shortUrl'   => $shortUrl,
                                         ], function ($m) use ($user){
                                                        
            $m->from('github@nextmedia.ma', 'Next Media');
            $m->to($user->email, $user->nom)->subject('Add favorite');

        });

		return 1;

    }

    public function sendEmailRetraitFavori(Request $request){

        $user   	= Auth::user();
		$catalogues = 		$user->favorite(Catalogue::class);
        if($catalogues->count() != 0){
        Mail::send('emails.allFavorite', [ 
                                                'user'          => $user, 
                                                'catalogues'  => $catalogues,
                                             ], function ($m) use ($user)  {
                                                        
            $m->from('github@nextmedia.ma', 'Next Media');
            $m->to($user->email, $user->nom)->subject('All favorite');

        });

        }

		return 1;

    }
}
