<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Enterprise;

class Code extends Model
{
    use HasFactory;
    protected $table = 'codes';
    public function enterprises()
    {
        return $this->belongsTo(Enterprise::class, 'enterprise_id');
    }
}
