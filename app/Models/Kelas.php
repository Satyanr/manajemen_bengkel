<?php

namespace App\Models;

use App\Models\Murid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function murid()
    {
        return $this->hasMany(Murid::class);
    }

    public function guru()
    {
        return $this->hasMany(GuruKelas::class);
    }
}
