<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'file_name', 'original_name', 'mime_type', 
    ];

    public function attachable()
    {
        return $this->morphTo();
    }

    public function isAnImage()
    {
        if (strpos($this->mime_type, 'image') === 0) {
            return true;
        }

        return false;
    }
}
