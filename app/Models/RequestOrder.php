<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestOrder extends Model
{
    use HasFactory;
    protected $table = 'request_order';
    protected $filable = ['no_reference', 'date_procurement', 'id_project', 'id_head_project', 'status'];
}
