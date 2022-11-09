@extends('layouts.master')
@section('content')
    <div>
        <br><br>
        <br><br>
    </div>
    <div class="container">
        <div class="blanc">
            <h1>Liste des mangas d'un genre</h1>
        </div>
        <div class="well">
            <div class="form-group">
                <label class="col-md-3 control-label" >Genre</label>
                <div class="col-md-3">
                    <select class="form-control" name="cbGenres" id="genre"  required>
                        <option value="0">Selectionner un genre</option>
                        @foreach($mesGenre as $unG){
                        <option value="{{$unG->id_genre}}">{{$unG->lib_genre}}</option>
                        }
                        @endforeach
                    </select>
                </div>
            </div>
            <br><br><br>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <input type="button" id="callMangaAjax" value="Affichage Ajax">
                        </div>
                    </div>
                    &nbsp;
                    <button type="button" class="btn btn-default btn-primary" onclick="javascript:if(confirm('vous êtes sûr?'))window.location='{{url('/')}}';">
                        <span class="glyphicon glyphicon-remove"></span> Annuler</button>
                </div>
                <br><br>
            </div>
        </div>
        <div id="resultat">

        </div>
    </div>
@stop
