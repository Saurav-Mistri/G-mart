<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class verifyuser extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'token',
        'user_id',
    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
