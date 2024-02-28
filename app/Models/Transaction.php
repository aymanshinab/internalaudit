<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [

        'transactions_type',
        'year',
        'management_id',
        'month',
        'data',
        'type',
        'idnum',
        'summary',

    ];



            public function procedures(){

                return $this->hasMany(Procedure::class);

                    }

                    public function notices(){

                        return $this->hasMany(Notice::class);

                            }

                            public function management (){

                                return $this->belongsTo(Management::class);

                                    }








}
