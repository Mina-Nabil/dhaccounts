<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Workshops extends Model
{
    //
    public static function getAll(){
      return DB::table('workshops')->get();
    }

    public static function getTotals(){

      $totals['gold18'] = DB::table('workshops')->sum('WKSP_GD18');
      $totals['gold21'] = DB::table('workshops')->sum('WKSP_GD21');
      $totals['money'] = DB::table('workshops')->sum('WKSP_MONY');

      return $totals;
    }

    public static function get($id){
      return DB::table('workshops')->find($id);
    }

    public static function insert($name, $gold18, $gold21, $money, $comment=null, $mobNumber=null, $address=null){
      $insertArr = [
        'WKSP_NAME' => $name,
        'WKSP_GD18' => $gold18,
        'WKSP_GD21' => $gold21,
        'WKSP_MONY' => $money,
        'WKSP_CMNT' => $comment,
        'WKSP_MOBN' => $mobNumber,
        'WKSP_ADRS' => $address
        ];

      return DB::table('workshops')->insertGetId($insertArr);
    }

    public static function updateWorkshopBalance($id, $gold18, $gold21, $money){
      DB::table('workshops')->where('id', $id)->update([
        "WKSP_GD18" => DB::raw('WKSP_GD18 + ' . $gold18),
        "WKSP_GD21" => DB::raw('WKSP_GD21 + ' . $gold21),
        "WKSP_MONY" => DB::raw('WKSP_MONY + ' . $money)
      ]);
    }

    public static function updateWorkshop($id, $name, $gold18, $gold21, $money, $comment=null, $mobNumber=null, $address=null){
      $updateArr = [
        'WKSP_NAME' => $name,
        'WKSP_GD18' => $gold18,
        'WKSP_GD21' => $gold21,
        'WKSP_MONY' => $money,
        'WKSP_CMNT' => $comment,
        'WKSP_MOBN' => $mobNumber,
        'WKSP_ADRS' => $address
        ];
      return DB::table('workshops')->where('id', $id)->update($updateArr);
    }
}
