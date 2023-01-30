<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
  use HasFactory;
  protected $table = 'staffs';
  protected $hidden = ['pivot'];
  protected $guarded = [];

  public function movies()
  {
    return $this->belongsToMany(Movie::class);
  }

  public function tvshows()
  {
    return $this->belongsToMany(Tvshow::class);
  }

  public function getAllActors()
  {
    $actors = $this->where('type', 'actor')->get();
    return $actors;
  }

  public function getAllDirectors()
  {
    $directors = $this->where('type', 'director')->get();
    return $directors;
  }
}
