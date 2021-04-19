<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataApar extends Model
{
    use UsesUuid, SoftDeletes;

    protected $table = "data_apar";
    protected $guarded = ['id', 'uuid'];

    public function getData()
    {
        return static::orderBy('created_at','desc')->get();
    }

    public function storeData($input)
    {
    	return static::create($input);
    }

    public function findData($id)
    {
        return static::find($id);
    }

    public function updateData($id, $input)
    {
        return static::find($id)->update($input);
    }

    public function deleteData($id)
    {
        return static::find($id)->delete();
    }
}
