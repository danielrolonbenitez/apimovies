<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
  use HasFactory;

  protected $hidden = ['pivot'];
  protected $guarded = [];

  public function staffs()
  {
    return $this->belongsToMany(Staff::class);
  }

  public function actors()
  {
    return $this->belongsToMany(Staff::class)->where('type', '=', 'actor');
  }

  public function director()
  {
    return $this->belongsToMany(Staff::class)->where('type', '=', 'director');
  }

  public function hasDirector()
  {
    $director = count($this->director);
    if ($director > 0) {
      return true;
    } else {
      return false;
    }
  }
}
