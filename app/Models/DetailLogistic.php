<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;

class DetailLogistic extends Model
{
    use HasFactory;

    protected $table = 'detail_request';
    protected $fillable = ['id_logistic', 'id_barang', 'type', 'qty', 'status'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }
}
