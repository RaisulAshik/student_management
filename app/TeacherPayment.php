<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherPayment extends Model
{
    protected $table = 'teacher_payment'; // optional if following Laravel convention

    protected $fillable = [
        'admin_id',      // teacher
        'amount',        // amount paid
        'payment_date',  // date of payment
        'note',          // optional note
    ];

    /**
     * The teacher/admin associated with this payment
     */
    public function teacher()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
