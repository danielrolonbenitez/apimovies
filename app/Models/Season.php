<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    public function episode()
    {
        return $this->hasMany(Episode::class);
    }

    public function tvshow()
    {
        return $this->belongsTo(Tvshow::class);
    }
}
