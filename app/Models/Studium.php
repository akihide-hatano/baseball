<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Studium extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'location',
        'capacity',
        'built_year',
    ];

    public function studium(){
        return $this->belongsTo(Studium::class);
    }
}
