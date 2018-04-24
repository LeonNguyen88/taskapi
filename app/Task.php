<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'description', 'users_id', 'projects_id', 'start_date', 'end_date', 'due_date'];
    public function user(){
        return $this->belongsTo('App\User', 'users_id');
    }
    public function project(){
        return $this->belongsTo('App\Project', 'projects_id');
    }
}
