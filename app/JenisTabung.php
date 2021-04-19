<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisTabung extends Model
{
    use UsesUuid, SoftDeletes;
    protected $table = "jenis_tabung";
    protected $guarded = ['id', 'uuid'];
}
