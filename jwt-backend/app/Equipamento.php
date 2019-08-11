<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    use SoftDeletes;
    protected $table="equipamento";
    protected $guarded = [];
}
