<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Laravel\Ledger;
use Laravel\Workshops;

class Transactions extends Model
{
    // Workshop Transactions tables

    public static function getAllTransaction(){
      return DB::table('transactions')->leftJoin('inventory', 'WKTN_INVT_ID', 'inventory.id')
          ->select('transactions.*', 'inventory.INVT_NAME', DB::raw("(SELECT WKSP_NAME FROM workshops WHERE id = transactions.WKTN_WKSP_FROM) as fromWKSP") , DB::raw("(SELECT WKSP_NAME FROM workshops WHERE id = transactions.WKTN_WKSP_TO) as toWKSP"))
          ->orderby('id', 'desc')
          ->limit(500)
          ->get();
    }

    public static function getTransactionByWorkshop($id){
      return DB::table('transactions')->leftJoin('inventory', 'WKTN_INVT_ID', 'inventory.id')
          ->select('transactions.*', 'inventory.INVT_NAME', DB::raw("(SELECT WKSP_NAME FROM workshops WHERE id = transactions.WKTN_WKSP_FROM) as fromWKSP") , DB::raw("(SELECT WKSP_NAME FROM workshops WHERE id = transactions.WKTN_WKSP_TO) as toWKSP"))
          ->where('transactions.WKTN_WKSP_TO', '=', $id)->orWhere('transactions.WKTN_WKSP_FROM', '=', $id)
          ->orderby('id', 'desc')
          ->limit(500)
          ->get();
    }

    public static function getTransactionRecordsByWorkshop($id, $startDate, $endDate){
      return DB::table('transactions')->leftJoin('inventory', 'WKTN_INVT_ID', 'inventory.id')
          ->select('transactions.*', 'inventory.INVT_NAME', DB::raw("(SELECT WKSP_NAME FROM workshops WHERE id = transactions.WKTN_WKSP_FROM) as fromWKSP") , DB::raw("(SELECT WKSP_NAME FROM workshops WHERE id = transactions.WKTN_WKSP_TO) as toWKSP"))
          ->whereBetween('WKTN_DATE', [$startDate, $endDate])
          ->where(function($query) use($id){
            $query->where('transactions.WKTN_WKSP_TO', '=', $id)->orWhere('transactions.WKTN_WKSP_FROM', '=', $id);
          })
          ->orderby('id', 'desc')
          ->limit(500)
          ->get();
    }

    /*
    * fromID = 0 -> ledger to workshop
    * toID = 0 -> workshop to inventory
    */
   public static function insertTransaction($fromWorkshop, $toWorkshop, $gold18=0, $gold21=0, $money=0, $userID, $inventoryID = null, $count=null, $isSalary=false, $comment=null){


     return DB::transaction(function () use ($fromWorkshop, $toWorkshop, $gold18, $gold21, $money, $userID, $inventoryID, $count, $isSalary, $comment) {
       if($fromWorkshop == 0 && $toWorkshop == 0) return false;

       if($fromWorkshop == 0 ){
		     $isSalary=false;
         $workshopName = Workshops::get($toWorkshop)->WKSP_NAME;
         Ledger::insertLedger(null, $userID, $money*-1, $gold21*-1, $gold18*-1, false, " من اليوميه الي  " . $workshopName , false);
       } else {
		     Workshops::updateWorkshopBalance($fromWorkshop, -1*$gold18, -1*$gold21, -1*$money);
	     }


       if($toWorkshop == 0){
		     $isSalary=false;
         $workshopName = Workshops::get($fromWorkshop)->WKSP_NAME;
         Ledger::insertLedger(null, $userID, $money , $gold21, $gold18, false, "من " . $workshopName . " الي المخزن ", false);
         if(isset($inventoryID) && isset($count))
         Inventory::incrementInventory($inventoryID, $count);
       } else if( !$isSalary){
         Workshops::updateWorkshopBalance($toWorkshop, $gold18, $gold21, $money);
       } else {
		     Workshops::updateWorkshopBalance($toWorkshop, $gold18, $gold21, 0);
	     }

       DB::table('transactions')->insert([
         "WKTN_WKSP_FROM" => $fromWorkshop,
         "WKTN_WKSP_TO"   => $toWorkshop,
         "WKTN_USER_ID"   => $userID,
         "WKTN_GD21"      => $gold21,
         "WKTN_GD18"      => $gold18,
         "WKTN_MONY"      => $money,
         "WKTN_INVT_ID"   => $inventoryID,
         "WKTN_INVT_CONT" => $count,
         "WKTN_CMNT" => $comment,
         "WKTN_DATE"      => date("Y-m-d")
       ]);
     });
   }
}
