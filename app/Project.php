<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'description','img_cover'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
