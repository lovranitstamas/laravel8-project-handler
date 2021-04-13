<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function setAttributes($data)
    {
        $this->name = $data['name'];
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
