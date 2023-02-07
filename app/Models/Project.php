<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ["name", "description", "cover_img", "github_link"];

    // Il nome della funzione dovrebbe essere il nome della tabella a cui 
    // ci colleghiamo, al singolare.
    public function types()
    {
        return $this->hasMany(Type::class);
    } 
}
