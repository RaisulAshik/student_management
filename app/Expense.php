<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
     protected $fillable=[
     
       'expense_head_id',
       'name',
       'date',
       'branch_id',
       'amount',
       'document'
    ];


    public function branch(){
        return $this->belongsTo('App\Branch','branch_id');
    }
    public function expenseCategory(){
        return $this->belongsTo('App\ExpenseCategory','expense_category_id');
    }
}
