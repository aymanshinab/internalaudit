<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactpoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'management_id',

    ];

    public function management(){

        return $this->belongsTo(Management::class);

            }

}
