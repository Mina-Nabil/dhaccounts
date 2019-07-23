<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Laravel\Clients;

class Ledger extends Model
{
    //
    public static function getFullLedger(){
      return DB::table('ledger')
      ->leftJoin('clients', 'clients.id', '=', 'ledger.LDGR_CLNT_ID')
      ->join('users', 'users.id', '=', 'ledger.LDGR_USER_ID')
      ->select('ledger.*', 'clients.*', 'users.username')
      ->orderby('ledger.id', 'desc')
      ->limit(500)
      ->get();
    }

    public static function getLastEntry(){
      return DB::table('ledger')->latest('id')->first();
    }

    public static function getClientLedger($clientID){
      return DB::table('ledger')
      ->leftJoin('clients', 'clients.id', '=', 'ledger.LDGR_CLNT_ID')
      ->join('users', 'users.id', '=', 'ledger.LDGR_USER_ID')
      ->select('ledger.*', 'clients.*', 'users.username')
      ->orderby('ledger.id', 'desc')
      ->where('LDGR_CLNT_ID', $clientID)
      ->limit(500)
      ->get();
    }

    public static function getClientRecords($clientID, $startDate, $endDate){
      return DB::table('ledger')
      ->leftJoin('clients', 'clients.id', '=', 'ledger.LDGR_CLNT_ID')
      ->join('users', 'users.id', '=', 'ledger.LDGR_USER_ID')
      ->select('ledger.*', 'clients.*', 'users.username')
      ->orderby('ledger.id', 'desc')
      ->where('LDGR_CLNT_ID', $clientID)
      ->where('LDGR_DATE', '>' , $startDate)
      ->where('LDGR_DATE', '<' , $endDate)
      ->limit(500)
      ->get();
    }

    public static function insertLedger($clientID, $userID, $moneyAmount, $gold21Amount=0, $gold18Amount=0, $isGoldDiff=false, $comment=null , $isInvoice = false){

      DB::transaction(function () use ($clientID, $userID, $gold21Amount, $gold18Amount, $moneyAmount, $isGoldDiff, $comment){

        $lastLedger = Ledger::getLastEntry();
        if (isset($clientID) && is_numeric($clientID) && $clientID!=0) {
          $client = Clients::getClient($clientID);
          $insertArray = [
            'LDGR_DATE' => date('Y-m-d H:i:s'),
            'LDGR_USER_ID'    =>  $userID,
            'LDGR_CLNT_ID'    =>  $clientID,
            'LDGR_MONY_AMNT'  =>  $moneyAmount,
            'LDGR_GOLD_CLNT'  =>  $client->CLNT_CRGD + $gold21Amount * -1,
            'LDGR_MONY_CLNT'  =>  $client->CLNT_CRMN + $moneyAmount * -1,
            'LDGR_CMNT'       =>  $comment
          ];
          //Gold diff not included in money accounts
          if(!$isGoldDiff)
            $insertArray['LDGR_MONY_CURR'] = $lastLedger->LDGR_MONY_CURR + $moneyAmount ;
          else
            $insertArray['LDGR_MONY_CURR'] = $lastLedger->LDGR_MONY_CURR ;

          //Change gold type Current depending on client account type
          if(strcmp($client->CLNT_ACTP, "18")  == 0){
            $insertArray['LDGR_GD18_CURR'] = $lastLedger->LDGR_GD18_CURR + $gold18Amount;
            $insertArray['LDGR_GD21_CURR'] = $lastLedger->LDGR_GD21_CURR ;
            $insertArray['LDGR_GD18_AMNT'] = $gold18Amount;
          }
          else{
            $insertArray['LDGR_GD18_CURR'] = $lastLedger->LDGR_GD18_CURR;
            $insertArray['LDGR_GD21_CURR'] = $lastLedger->LDGR_GD21_CURR + $gold21Amount;
            $insertArray['LDGR_GD21_AMNT'] = $gold21Amount;
          }

        }
        else {
          $insertArray = [
            'LDGR_DATE' => date('Y-m-d H:i:s'),
            'LDGR_USER_ID'    =>  $userID,
            'LDGR_MONY_AMNT'  =>  $moneyAmount,
            'LDGR_GD18_AMNT'  =>  $gold18Amount,
            'LDGR_GD21_AMNT'  =>  $gold21Amount,
            'LDGR_GD18_CURR'  =>  $lastLedger->LDGR_GD18_CURR + $gold18Amount,
            'LDGR_GD21_CURR'  =>  $lastLedger->LDGR_GD21_CURR + $gold21Amount,
            'LDGR_MONY_CURR'  =>  $lastLedger->LDGR_MONY_CURR + $moneyAmount,
            'LDGR_CMNT'       =>  $comment
          ];
        }


        DB::table('ledger')->insertGetId($insertArray);

        Clients::updateClientBalance($clientID, $gold21Amount , $moneyAmount , false); //Increment Balance
      });

    }

    public static function deleteLedger(){
      //MUST BE LAST LEDGER ENTRY ONLY
      DB::transaction(function (){
        $maxLedger = self::getLastEntry();
        $client = Clients::getClient($maxLedger->LDGR_CLNT_ID);
        if(isset($client)) {
          if(strcmp($client->CLNT_ACTP, "18")  == 0){
            Clients::updateClientBalance($maxLedger->LDGR_CLNT_ID, $maxLedger->LDGR_GD18_AMNT, $maxLedger->LDGR_MONY_AMNT, false); //Increment Balance
          } else {
            Clients::updateClientBalance($maxLedger->LDGR_CLNT_ID, $maxLedger->LDGR_GD21_AMNT, $maxLedger->LDGR_MONY_AMNT, false); //Increment Balance
          }
        }
          return DB::table('ledger')->where('id', $maxLedger->id)->delete();
      });
    }
}
