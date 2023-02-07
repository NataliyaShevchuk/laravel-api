<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    // Il nome della funzione dovrebbe essere il nome della tabella a cui 
    // ci colleghiamo, al singolare.
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
