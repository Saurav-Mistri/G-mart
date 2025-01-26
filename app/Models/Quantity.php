<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quantity extends Model
{
    use HasFactory;
    protected $table = 'product_unit';
    protected $primaryKey = 'puid';
    protected $fillable = [
        'puid', 'puname',
    ];
}
