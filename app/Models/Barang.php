<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $fillable = ['name', 'unit'];

    public function baranginout()
    {
        return $this->hasMany(BarangInOut::class, 'id_barang', 'id');
    }
}
