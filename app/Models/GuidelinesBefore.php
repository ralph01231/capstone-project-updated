<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuidelinesBefore extends Model
{
    protected $table = 'guidelines_before';
    protected $primaryKey = 'bg_id'; 

    public function guideline()
    {
        return $this->belongsTo(Guidelines::class, 'guidelines_id', 'ag_id');
    }
}
