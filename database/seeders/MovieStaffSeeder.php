<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Staff;

class MovieStaffSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $movies = Movie::all();
    $staff = new Staff();
    $actors = $staff->getAllActors();
    $directors = $staff->getAllDirectors();

    /*insert actor to movies*/
    foreach ($movies as $movie) {
      foreach ($actors as $actor) {
        $movie->actors()->attach($actor);
      }
    }

    /*insert one director to movies*/

    foreach ($movies as  $movie) {
      foreach ($directors as  $director) {
        if (!$movie->hasDirector()) {
          $movie->director()->attach($director);
          break;
        }
      }
    }
  }
}
