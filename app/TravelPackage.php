<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelPackage extends Model
{
    use SoftDeletes;

    protected $table = "travel_packages";

    protected $fillable = [
        'title', 'slug', 'location', 'about', 'cagar_budaya', 'makanan_khas', 'tarian_khas', 'tanggal_keberangkatan', 'durasi_wisata', 'tipe_trip', 'harga' 
    ];

    protected $hidden =[

    ];

    public function galleries(){
        return $this->hasMany(Gallery::class, 'travel_packages_id', 'id');
    }
}
