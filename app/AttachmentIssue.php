<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttachmentIssue extends Model
{
    protected $fillable = [
        'file_name', 'issue_id', 'original_name',
    ];

    public function issue()
    {
        return $this->belongsTo('App\Issue');
    }
}
