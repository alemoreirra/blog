<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MartialStatus extends Model {
    protected $table = 'martial_status';

    public function costumer() {
        return $this->hasOne('App\Costumer');
    }

}
