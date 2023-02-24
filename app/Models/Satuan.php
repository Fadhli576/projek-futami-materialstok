<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function material()
    {
        return $this->hasMany(Material::class);
    }
}
