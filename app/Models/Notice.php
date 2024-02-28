<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [

        'content',
        'transaction_id',
    ];

    public function managements(){

        return $this->hasMany(Management::class);

            }

            public function transaction(){

                return $this->belongsTo(Transaction::class);

                    }

                    public function procedure(){

                        return $this->belongsTo(Procedure::class);

                            }
                            public function management()
{
    return $this->belongsToMany(Management::class, 'management__notices', 'notice_id', 'management_id');
}

}
