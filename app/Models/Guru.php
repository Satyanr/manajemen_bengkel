<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function kelas()
    {
        return $this->hasMany(GuruKelas::class);
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
}
