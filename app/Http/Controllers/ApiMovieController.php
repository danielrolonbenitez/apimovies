<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\Staff;

class ApiMovieController extends ApiController
{

   public function index()
   {
      return $this->formatDate(Movie::all());
   }

   public function search($key, $value, $order)
   {
      $movie = Movie::where($key, '=', $value);
      if ($order) {
         $movie->orderBy($order, 'desc');
      }
      return $this->formatDate($movie->get());
   }

   public function  create(Request $request)
   {
      $data = $this->valiData($request->getContent());

      if (is_object($data)) {
         Movie::create([
            'title' => $data->title,
            'genre' => $data->genre,
            'year' =>  $data->year,
            'lang' =>  $data->lang,
            'duration' => $data->duration,
            'description' => $data->description,
            'picture' =>  $data->picture
         ]);
         $movie = Movie::latest()->first();
         if (isset($data->director)) {

            $director = Staff::where([["id", "=", $data->director], ["type", "=", "actor"]])->get()->first();
            if ($director) {
               $director = $director;
            } elseif (is_string($data->director)) {
               Staff::create(['name' => $data->director, 'type' => 'director']);
               $director = Staff::latest()->first();
            }
            $movie->director()->attach($director);
         }

         if (isset($data->actor)) {
            $actor = Staff::where([["id", "=", $data->actor], ["type", "=", "actor"]])->get()->first();
            if ($actor) {
               $actor = $actor;
            } elseif (is_string($data->actor)) {
               Staff::create([
                  'name' => $data->actor,
                  'type' => 'actor'
               ]);
               $actor = Staff::latest()->where('type', 'actor')->first();
            }
            $movie->actors()->attach($actor);
         }
         $data = (object)array("message" => "Success create movie");
      } else {
         $data = (object)array("message" => "Error to create movie verifid json");
      }

      return $this->formatDate($data);
   }

   public function show($id)
   {
      $film = Movie::find($id);
      $movie = $film;
      $movie["director"] = $film->director;
      $movie["actors"] = $film->actors;
      $movie = (object)$movie;
      return $this->formatDate($movie);
   }

   public function showStaff($id, $role = 'staffs')
   {
      $movie = Movie::find($id);
      $staff = $movie->$role;
      return  $this->formatDate($staff);
   }

   public function customError()
   {
      return $this->formatDate('');
   }
}
