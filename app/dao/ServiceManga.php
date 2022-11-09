<?php

namespace App\dao;

use Illuminate\Support\Facades\DB;
use App\Exceptions\MonException;
use Illuminate\Database\QueryException;

class ServiceManga
{
    public function getlisteManga()
    {
        try {
            $mesMangas = \Illuminate\Support\Facades\DB::table('manga')
                ->Select()
                ->join('genre', 'manga.id_genre', '=', 'genre.id_genre')
                ->join('dessinateur', 'manga.id_dessinateur', '=', 'dessinateur.id_dessinateur')
                ->join('scenariste', 'manga.id_scenariste', '=', 'scenariste.id_scenariste')
                ->orderBy('id_manga')
                ->get();
            return $mesMangas;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }

    }

    public function ajoutManga($code_d, $prix, $titre, $couverture, $code_ge, $id_scenariste)
    {
        try {
            DB::table('manga')->insert(
                ['id_dessinateur' => $code_d, 'prix' => $prix, 'titre' => $titre,
                    'couverture' => $couverture, 'id_genre' => $code_ge,
                    'id_scenariste' => $id_scenariste]
            );
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getManga($idManga)
    {
        try {
            $query = DB::table('manga')
                ->select()
                ->where('id_manga', '=', $idManga)
                ->first();
            return $query;
        } catch (MonException $e) {
            throw new monException($e->getMessage(), 5);
        }
    }

    public function modificationManga($code, $code_d, $prix, $titre, $couverture, $code_ge, $scenariste)
    {
        try {
            DB::table('manga')
                ->where ('id_manga', $code)
                ->update([
                    'id_dessinateur'=> $code_d,
                    'prix'=> $prix,
                    'titre'=>$titre,
                    'couverture'=> $couverture,
                    'id_genre'=>$code_ge,
                    'id_scenariste'=> $scenariste,
                ]);
        } catch (MonException $e) {
            throw new monException($e->getMessage(), 5);
        }
    }

    public function getListeMangasGenre($id_genre)
    {
        try {
            $mesMangas = DB::table('manga')
                ->Select()
                ->join('genre', 'manga.id_genre', '=', 'genre.id_genre')
                ->join('dessinateur', 'manga.id_dessinateur', '=', 'dessinateur.id_dessinateur')
                ->join('scenariste', 'manga.id_scenariste', '=', 'scenariste.id_scenariste')
                ->where('genre.id_genre', '=', $id_genre)
                ->orderBy('id_manga')
                ->get();
            return $mesMangas;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getListeMangasGenreAjax($id_genre)
    {
        try {
            $mesMangas= $this->getListeMangasGenre($id_genre);
            $rep='<h1>Liste de mes Mangas par genre</h1>';
            $rep=$rep.'<table class="table table-bordered table-striped">';
            $rep=$rep.'<tr><th>Id</th><th>Titre</th><th>Genre</th><th>Dessinateur</th>
<th>Scenariste</th><th>Prix</th><th>Couverture</th></tr>';
            foreach ($mesMangas as $unManga)
            {
                $rep= $rep.'<tr><td>'.$unManga->id_manga.'</td> <td>'.$unManga->titre.'</td>
<td>'.$unManga->lib_genre.'</td><td>'.$unManga->nom_dessinateur.'</td> <td>'.$unManga->nom_scenariste.'</td><td>'.$unManga->prix.'</td>
<td>'.$chemin= 'assets\\images\\'.$unManga->couverture;
                if (!file_exists($chemin)){
                    $unManga->couverture=$chemin.'</td></table>';
                }else
                    $unManga->couverture= 'erreur.png';
            }
            return $rep;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }
}
