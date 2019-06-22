<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Models extends Model
{
    //
    static function getModels(){
      return DB::table('models')->get();
    }

    static function getModelByID($id){
      return DB::table('models')->find($id);
    }

    static function insertModel($Name){
      return DB::table('models')->insertGetId([
        'MODL_NAME'=>$Name
      ]);
    }

    static function updateModel($id, $Name){
      return DB::table('models')->where('id', $id)->update([
        'MODL_NAME'=>$Name
      ]);
    }
}
