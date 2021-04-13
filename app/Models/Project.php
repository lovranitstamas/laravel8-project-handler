<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends SearchModel
{

    public function setAttributes($data)
    {
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->status_id = $data['status_id'];

    }

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
            'user_id')
            ->withTimestamps();
    }

    public function hasUser($userId)
    {
        return in_array($userId, $this->users()->pluck('id')->toArray());
    }
}
