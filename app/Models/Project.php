<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TenagaKerja;

class Project extends Model
{
    use HasFactory;

    protected $table = "project";
    protected $fillable = ["name_project", "location"];

    public function headProject()
    {
        return $this->hasOne(TenagaKerja::class, 'id', 'head_project')->select('id', 'name');
    }
}
