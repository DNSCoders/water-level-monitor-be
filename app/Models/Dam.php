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

    public function latest_debit_report()
    {
        return $this->hasOne(DebitReport::class)->latestOfMany(); // Get the latest report
    }

    // Add a custom accessor to calculate the status
    public function getStatusAttribute()
    {
        // Default status
        $status = 'Aman';

        // Check if there's a latest debit report
        if ($this->latest_debit_report) {
            $limpas = $this->latest_debit_report->limpas;

            // Apply the logic for the status based on limpas and alert levels
            if ($limpas < $this->siap) {
                $status = 'Aman';
            } elseif ($limpas >= $this->siap && $limpas < $this->siaga) {
                $status = 'Siaga';
            } elseif ($limpas >= $this->siaga && $limpas < $this->awas) {
                $status = 'Waspada';
            } elseif ($limpas >= $this->awas) {
                $status = 'Awas';
            }
        }

        return $status;
    }

}
