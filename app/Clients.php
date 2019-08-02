<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Clients extends Model
{
    //
    public static function getClients(){
      return DB::table('clients')->get();
    }

    public static function getClientsByType($Type){
      return DB::table('clients')->where('CLNT_ACTP', $Type)->get();
    }

    public static function getClient($id){
      return DB::table('clients')->find($id);
    }

    public static function getTotals(){

      $totals['gold18'] = DB::table('clients')->where('CLNT_ACTP', 18)->sum('CLNT_CRGD');
      $totals['gold21'] = DB::table('clients')->where('CLNT_ACTP', 21)->sum('CLNT_CRGD');
      $totals['money'] = DB::table('clients')->sum('CLNT_CRMN');

      return $totals;
    }

    public static function insertClient($Name, $Type, $Gold, $Money, $Address=null, $Mob=null, $Scid=null, $Comment=null){
      return DB::table('clients')->insertGetId([
        'CLNT_NAME' => $Name,
        'CLNT_ADRS' => $Address,
        'CLNT_CRGD' => $Gold,
        'CLNT_CRMN' => $Money,
        'CLNT_MOB'  => $Mob,
        'CLNT_SCID' => $Scid,
        'CLNT_ACTP' => $Type,
        'CLNT_CMNT' => $Comment
      ]);
    }

    public static function updateClientBalance($id, $gold, $money, $isIncrement = true){
      if($isIncrement)
      //Increment y3ny el client 3aleh floos aktar
        return DB::table('clients')->where('id', $id)->update([
          'CLNT_CRGD' => DB::raw('CLNT_CRGD + ' . $gold),
          'CLNT_CRMN' => DB::raw('CLNT_CRMN + ' . $money)
        ]);
      else
        return DB::table('clients')->where('id', $id)->update([
          'CLNT_CRGD' => DB::raw('CLNT_CRGD - ' . $gold),
          'CLNT_CRMN' => DB::raw('CLNT_CRMN - ' . $money)
        ]);
    }

    public static function editClient($id, $Name, $Type, $Gold, $Money, $Address=null, $Mob=null, $Scid=null, $Comment=null) {
      return DB::table('clients')->where('id', $id)
                  ->update([
                    'CLNT_NAME' => $Name,
                    'CLNT_ADRS' => $Address,
                    'CLNT_CRGD' => $Gold,
                    'CLNT_CRMN' => $Money,
                    'CLNT_MOB'  => $Mob,
                    'CLNT_SCID' => $Scid,
                    'CLNT_ACTP' => $Type,
                    'CLNT_CMNT' => $Comment
                  ]);
    }
}
