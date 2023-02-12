<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getTableHeaders() {
        return [
            [ 'name' => '#',            'field' => 'id' ],
            [ 'name' => 'First Name',   'field' => 'first_name' ],
            [ 'name' => 'Last Name',    'field' => 'last_name' ],
            [ 'name' => 'Email',        'field' => 'email' ]
        ];
    }
}
