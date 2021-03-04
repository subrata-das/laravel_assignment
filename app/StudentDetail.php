<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
// use \DB;

class StudentDetail extends Model
{ 
    protected $fillable =   [
        'first_name',
        'Last_name',
        'Course_id',
        'Date_of_joining'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function Course(){
        return $this->belongsTo('App\Course');
    }

    public static function filfer($request){
        $students = DB::table('student_details')
                    ->join('courses','courses.id','=','student_details.Course_id');
        if(!empty($request['first_name'])){
            $students->where('student_details.first_name','like',$request['first_name'].'%');
        }
        if(!empty($request['Last_name'])){
            $students->where('student_details.Last_name','like',$request['Last_name'].'%');
        }
        if(!empty($request['Date_of_joining'])){
            $students->where('student_details.Date_of_joining',$request['Date_of_joining']);
        }
        if(!empty($request['Course_name'])){
            $students->where('courses.Course_name','like',$request['Course_name'].'%');
        }
        $result = $students ->get();

        return $result;
        // return $request['Course_name'];
    }
    
}
