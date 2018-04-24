<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'description'];
    public function task(){
        return $this->hasMany('App\Task', 'projects_id');
    }
}
