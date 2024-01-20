<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Guidelines;

class GuidelinesDuring extends Model
{
    protected $table = 'guidelines_during';
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
