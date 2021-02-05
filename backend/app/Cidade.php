<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $table = 'cidade';

    public function estado()
    {
        return $this->hasOne('App\Estado', 'estado_id', 'id');
    }
}
