<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'pid';
    protected $fillable = [
        'pid',
        'subcategoryid',
        'puid',
        'pname',
        'pdesc',
        'pimg',
        'pqty',
        'pprice',
    ];
    public function setFilenamesAttribute($value)
    {
        $this->attributes['pimg'] = json_encode($value);
    }
    public function getFeaturedImageAttribute()
{
    return explode(',', $this->pimg)[0];
}
}
