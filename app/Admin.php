<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles; 
class Admin extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $guard = 'admin';

     protected $guard_name = 'admin';

    protected $fillable = [
             'role_id','name','email', 'password',
    ];

    protected $hidden = [
            'password', 'remember_token',
    ];

     public function role(){
    	return $this->belongsTo('App\Role');
    }
        
    public function classNames()
    {
        return $this->belongsToMany(ClassName::class, 'admin_class_name');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'admin_subjects', 'admin_id', 'subject_id');
    }
 
    public function expenses()
    {
        return $this->hasManyThrough(
        Expense::class,
        ExpenseCategory::class,
        'admin_id',             // Foreign key on expense_categories
        'expense_category_id',  // Foreign key on expenses
        'id',                   // Local key on admins
        'id'                    // Local key on expense_categories
    );
    }


}