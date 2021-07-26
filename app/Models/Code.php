<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Enterprise;

class Code extends Model
{
    use HasFactory;
    protected $table = 'codes';
    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class, 'idEnterprise');
    }
}
