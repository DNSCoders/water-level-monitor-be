<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebitReport extends Model
{
    use HasFactory;

    protected $fillable =[
        "dam_id",
        "limpas",
        "debit",
        "cuaca",
        "debit_ke_saluran_induk",
        "pob_id"
    ];

    public function dam()
    {
        return $this->belongsTo(Dam::class);
    }

    public function pob()
    {
        return $this->belongsTo(POB::class);
    }
}
