<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangInOut extends Model
{
    use HasFactory;

    protected $table = 'logistic';
    protected $fillable = (['date', 'type', 'destination', 'id_destination']);

    public function barang()
    {
        return $this->hasOne(Barang::class, 'id', 'id_barang')->select('id', 'name', 'unit');
    }
    public function barangforPro()
    {
        return $this->hasOne(Barang::class, 'id', 'id_barang')->select('id', 'name');
    }

    public function project()
    {
        return $this->hasOne(Project::class, 'id', 'id_destination')->select('id', 'name_project');
    }
}
