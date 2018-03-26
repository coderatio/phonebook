<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phonebook extends Model
{
    protected $table = 'phonebooks';

    protected $fillable = [
        'name', 'email', 'phone'
    ];

}
