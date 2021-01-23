<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Todo extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $guarded = ['id'];

    static $rules = [
        'name' => 'required',
        'title'   => 'required',
    ];
}
