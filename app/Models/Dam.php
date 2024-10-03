<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dam extends Model
{
    use HasFactory;

    protected $fillable = [
        "river_name",
        "dam_name",
        "long",
        "lat",
        "siap",
        "siaga",
        "awas"
    ];

    public function pobs()
    {
        return $this->hasMany(POB::class);
    }

    public function debit_reports()
    {
        return $this->hasMany(DebitReport::class);
    }
}
