<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POB extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "position",
        "phone_number",
        "user_id",
        "dam_id"
    ];

    public function dam()
    {
        return $this->belongsTo(Dam::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($pob) {
            // Check if the POB has an associated user
            if ($pob->user) {
                $pob->user->delete();
            }
        });
    }

    // public function debit_reports(){
    //     return $this->belongsTo(DebitReport::class);
    // }
}
