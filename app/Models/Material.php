<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('nama','like','%'.$search.'%')
                        ->orWhere('no_material','like','%'.$search.'%')
                        ->orWhere('alat_ukur','like','%'.$search.'%')
                        ->orWhere('tempat_penyimpanan','like','%'.$search.'%');
        }); 

    }

    use HasFactory;


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
