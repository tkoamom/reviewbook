<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewAnswer extends Model
{
    use HasFactory;

    public function review(){
        return $this->hasOne('App\Models\Review', 'id', 'review_id');
    }
}
