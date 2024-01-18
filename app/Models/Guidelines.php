<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guidelines extends Model
{
    protected $table = 'guidelines';
    protected $primaryKey = 'id'; 

    public function before()
    {
        return $this->hasOne(GuidelinesBefore::class, 'guidelines_id', 'ag_id');
    }

    public function during()
    {
        return $this->hasOne(GuidelinesDuring::class, 'guidelines_id', 'ag_id');
    }

    public function after()
    {
        return $this->hasOne(GuidelinesAfter::class, 'guidelines_id', 'ag_id');
    }
}
