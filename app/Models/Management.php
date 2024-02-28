<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'management_name',
        'notice_id',
    ];
    public function notice(){

        return $this->belongsTo(Notice::class);

            }

            public function contactpoints(){

                return $this->hasMany(Contactpoint::class);

                    }

                    public function employees(){

                        return $this->hasMany(Employee::class);

                            }

                            public function transactions(){

                                return $this->hasMany(Transaction::class);

                                    }


                            public function notices()
{
    return $this->belongsToMany(Notice::class, 'management__notices', 'management_id', 'notice_id');
}



}
