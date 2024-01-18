<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuidelinesDuring extends Model
{
    protected $table = 'guidelines_during';
    protected $primaryKey = 'dg_id'; // You may adjust the primary key based on your actual structure
    public function guideline()
    {
        return $this->belongsTo(Guidelines::class, 'guidelines_id', 'ag_id');
    }
}
