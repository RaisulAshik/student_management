<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
     //
     protected $fillable = ['name','admin_id'];

     public function expenses()
     {
         return $this->hasMany('App\Expense','expense_category_id');
     }

     public function admin(){
        return $this->belongsTo('App\Admin','admin_id');
    }
}