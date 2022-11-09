<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input\Http;
use Request;
use App\metier\mangas;
use App\metier\Genre;
use App\metier\Scenariste;
use App\metier\Dessinateur;
use App\dao\ServiceDessinateur;
use App\dao\ServiceGenre;
use App\dao\ServiceManga;
use App\dao\ServiceScenariste;

class GenreController extends Controller
{
    public function listerMangasGenreAjax($id){
        try {
            $unServiceManga= new ServiceManga();
            $rep= $unServiceManga->getListeMangasGenreAjax($id);
            return rep;


        }catch (MonException $e){
            $monErreur = $e->getMessage();
            return view('vues/pageErreur', compact('monErreur'));
        }catch (\Exception $ex){
            $monErreur = $ex->getMessage();
            return view('vues/pageErreur', compact('monErreur'));
        }
    }
}
