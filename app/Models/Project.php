<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'user_project',
            'project_id',
            'user_id');
    }
}
