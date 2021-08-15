<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Input;

class InputDetail extends Model
{
    use HasFactory;
    protected $table = 'input_details';
    public function input()
    {
        return $this->belongsTo(Input::class, 'input_id');
    }
}
