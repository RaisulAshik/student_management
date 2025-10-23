<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
     protected $fillable=[
       
       'class_id',
       'branch_id',
       'name',
       'amount',
       'student_type',
       'status'


    ];

    public function classname(){
    	return $this->belongsTo('App\ClassName','class_id');
    }

    public function branch(){
    	return $this->belongsTo('App\Branch','branch_id');
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_subjects', 'subject_id', 'admin_id');
    }



    
}
