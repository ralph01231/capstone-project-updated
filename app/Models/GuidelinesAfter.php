<?php

namespace App\Models;
use App\Models\Guidelines;

use Illuminate\Database\Eloquent\Model;

class GuidelinesAfter extends Model
{
    protected $table = 'guidelines_after';
    protected $primaryKey = 'id';

    protected $fillable = [
        'guidelines_id',
        'headings',
        'image',
        'description',
    ];

    public function guideline()
    {
        return $this->belongsTo(Guidelines::class, 'guidelines_id', 'guidelines_id');
    }
}
