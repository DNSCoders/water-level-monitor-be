<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebitReport extends Model
{
    use HasFactory;

    public function dam()
    {
        return $this->belongsTo(Dam::class);
    }
}
