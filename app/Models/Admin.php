<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shift_id',
    ];


    //Shift relation
    public function shift()
    {
        return $this->belongsTo(Shift::Class);
    }

    //User relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
