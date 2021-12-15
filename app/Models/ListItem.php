<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListItem extends Model
{
    use HasFactory;

    protected $table = 'detail_logistic';
    protected $fillable = ['id_logistic', 'id_barang', 'type', 'qty', 'status'];
}
