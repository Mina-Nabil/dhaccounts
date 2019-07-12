<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Inventory extends Model
{
    //
    static function getAll(){
      return DB::table('inventory')->join('models', 'INVT_MODL_ID', '=', 'models.id')
      ->select('models.MODL_NAME',  'inventory.*')
      ->get();
    }

    static function getItems(){
      return DB::table('inventory')->select('id', 'INVT_NAME', 'INVT_CONT')
      ->get();
    }

    static function getInventoryByID($id){
      return DB::table('inventory')->join('models', 'INVT_MODL_ID', '=', 'models.id')
      ->select('models.MODL_NAME',  'inventory.*', 'models.id as MODL_ID')
      ->where('inventory.id', $id)->get()[0];
    }

    static function incrementInventory($inventoryID, $count){
      return DB::table('inventory')->where('id', $inventoryID)
                  ->update([
                    'INVT_CONT' => DB::raw("INVT_CONT + " . $count)
                  ]);
    }

    static function incrementInventorybyName($inventoryName, $count){
      return DB::table('inventory')->where('INVT_NAME', 'LIKE', $inventoryName)
                  ->update([
                    'INVT_CONT' => DB::raw("INVT_CONT + " . $count)
                  ]);
    }

    static function insertInventory($Name, $modelID, $count){
      return DB::table('inventory')->insert([
        'INVT_MODL_ID'  => $modelID,
        'INVT_CONT'  => $count,
        'INVT_NAME'     => $Name
      ]);
    }

    static function updateInventory($id, $Name, $modelID, $count){
      return DB::table('inventory')->where('id', $id)->update([
        'INVT_MODL_ID'  =>  $modelID,
        'INVT_CONT'  =>  $count,
        'INVT_NAME'     =>  $Name
      ]);
    }
}
