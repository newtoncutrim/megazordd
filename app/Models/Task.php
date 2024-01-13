<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function user(){
       return $this->belongsTo(User::class);
    }
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'user_id',
        'finished',
    ];
    use HasFactory;
}
