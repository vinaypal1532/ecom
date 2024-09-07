<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'month',
        'basic_salary', 
        'allowances', 
        'deductions',
        'net_salary',
        'total_days', 
        'days_worked',
        'advance_salary'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
