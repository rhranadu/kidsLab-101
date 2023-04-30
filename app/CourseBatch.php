<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseBatch extends Model
{
    use HasFactory;
    public function courses()
    {
        return $this->belongsTo('App\Course','course_id','id');
    }
    public function courseClasses ()
    {
        return $this->hasMany('App\CourseClass','course_id','course_id');
    }
}
