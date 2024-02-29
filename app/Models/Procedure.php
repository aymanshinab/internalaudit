<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'transaction_id',

    ];


    public function transaction(){

        return $this->belongsTo(Transaction::class);

            }

            public function employee(){

                return $this->belongsTo(Employee::class);

                    }

                    public function user(){

                        return $this->belongsTo(Employee::class);

                            }

                    public function notices(){

                        return $this->hasMany(Notice::class);

                            }
}
