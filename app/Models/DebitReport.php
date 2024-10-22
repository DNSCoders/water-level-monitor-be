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
    protected $appends = ['status'];

    public function dam()
    {
        return $this->belongsTo(Dam::class);
    }

    public function pob()
    {
        return $this->belongsTo(POB::class);
    }

    // Add a custom accessor to calculate the status
    public function getStatusAttribute()
    {
        // Default status
        $status = 'Aman';

        // Check if there's a latest debit report
        
        $limpas = $this->limpas;

            // Apply the logic for the status based on limpas and alert levels
        if ($limpas < $this->dam->siap) {
            $status = 'Aman';
        } elseif ($limpas >= $this->dam->siap && $limpas < $this->dam->siaga) {
            $status = 'Siap';
        } elseif ($limpas >= $this->dam->siaga && $limpas < $this->dam->awas) {
            $status = 'Siaga';
        } elseif ($limpas >= $this->dam->awas) {
            $status = 'Awas';
        }
        

        return $status;
        
    }
}
