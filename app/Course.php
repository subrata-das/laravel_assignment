<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable =   [
        'Course_name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function StudentDetail(){
        return $this->hasMany('App\StudentDetail');
    }
}
