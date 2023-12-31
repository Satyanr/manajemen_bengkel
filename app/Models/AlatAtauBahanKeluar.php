<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatAtauBahanKeluar extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function alat()
    {
        return $this->belongsTo(AlatAtauBahan::class, 'alat_atau_bahan_id');
    }

}
