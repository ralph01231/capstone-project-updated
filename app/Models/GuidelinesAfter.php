<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuidelinesAfter extends Model
{
    protected $table = 'guidelines_after';
    protected $primaryKey = 'ag_id';
    public function guideline()
    {
        return $this->belongsTo(Guidelines::class, 'guidelines_id', 'ag_id');
    }
}
