<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailLogistic;
use App\Models\TenagaKerja;
use App\Models\Project;

class RequestLogistic extends Model
{
    use HasFactory;
    protected $table = 'request_logistic';
    protected $filable = ['no_reference', 'date_procurement', 'id_project', 'id_head_project', 'status'];

    public function detail_logistic()
    {
        return $this->hasMany(DetailLogistic::class, 'id', 'id_logistic');
    }
    
    public function head_project()
    {
        return $this->belongsTo(User::class, 'id_head_project', 'id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'id_project', 'id');
    }
}
