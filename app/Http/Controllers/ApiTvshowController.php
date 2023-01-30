<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Tvshow;

class ApiTvshowController extends ApiController
{

  public function index()
  {
    return $this->formatDate(Tvshow::all());
  }


  public function show($id)
  {
    $film = Tvshow::find($id);
    $show = $film;
    $show["director"] = $film->director;
    $show["actors"] = $film->actors;
    $show["season"] = $film->season;
    if (count($show["season"]) > 0) {
      foreach ($show["season"] as $season) {
        $show["season"]["episode"] = $season->episode;
      }
    }
    $show = (object)$show;
    return $this->formatDate($show);
  }
}
