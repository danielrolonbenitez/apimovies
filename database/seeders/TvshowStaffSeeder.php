<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tvshow;
use App\Models\Staff;
use App\Models\Season;

class TvshowStaffSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $tvshow = Tvshow::all();
    $staff = new Staff();
    $actors = $staff->getAllActors();
    $directors = $staff->getAllDirectors();
    $seasons = Season::all();
    /*insert actor to tvshow*/
    foreach ($tvshow as $show) {
      foreach ($actors as $actor) {
        $show->actors()->attach($actor);
      }
    }

    /*insert one director to tvshows*/
    foreach ($tvshow as $show) {
      foreach ($directors as  $director) {
        if (!$show->hasDirector()) {
          $show->director()->attach($director);
          break;
        }
      }
    }
  }
}
