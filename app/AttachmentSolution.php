<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttachmentSolution extends Model
{
    protected $fillable = [
        'file_name', 'solution_id', 'original_name',
    ];

    public function solution()
    {
        return $this->belongsTo('App\Solution');
    }
}
