<?php

namespace App\Models;

use App\Mail\Confirmation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Project extends SearchModel
{

    private static $oldValues;
    private static $newValues;

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            self::$newValues = [
                "name" => $model->getOriginal('name'),
                "description" => $model->getOriginal('description'),
                "status" => $model->getOriginal('status')
            ];
        });

        static::updated(function ($model) {


            self::$oldValues = [
                "name" => $model->name,
                "description" => $model->description,
                "status" => $model->status->name
            ];

            if (array_diff(self::$newValues, self::$oldValues)) {
                $diffProject = array_diff(self::$oldValues, self::$newValues);

                $users = $model->users()->get()->pluck('email', 'name');
                foreach ($users as $email => $name) {
                    $toEmail = $name;
                    Mail::to($toEmail)
                        ->send(
                            new Confirmation($email, $diffProject)
                        );
                }
            }
        });

    }

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
