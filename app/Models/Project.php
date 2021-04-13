<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
