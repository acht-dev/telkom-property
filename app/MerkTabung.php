<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class MerkTabung extends Model
{
    use UsesUuid, SoftDeletes;
    protected $table = "merk_tabung";
    protected $guarded = ['id', 'uuid'];
}
