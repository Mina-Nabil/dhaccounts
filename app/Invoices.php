<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoices extends Model
{
    public static function getAllInvoices(){
      return DB::table('invoices')->join('clients', 'INVC_CLNT_ID', 'clients.id')
          ->select('clients.CLNT_NAME', 'clients.CLNT_ACTP','invoices.*')
          ->orderby('id', 'desc')
          ->limit(500)
          ->get();
    }

    public static function getInvoice($id){
      $retArray['invoiceData'] = DB::table('invoices')
                                      ->join('clients', 'INVC_CLNT_ID', 'clients.id')
                                      ->select('clients.CLNT_NAME', 'clients.CLNT_ACTP','invoices.*')
                                      ->where("invoices.id", $id)->first();
      $retArray['invoiceItems'] = DB::table('invoice_items')->where('INIT_INVC_ID', $id)->get();

      return $retArray;
    }

    public static function confirmInvoice($id, $userID){
      DB::transaction(function () use ($id, $userID) {
        DB::table('invoices')->where('id', $id)->update([
          'INVC_STAT' => 1,
          'INVC_DATE'     => date('Y-m-d')
        ]);

        $invoice = DB::table('invoices')->find($id);
        $totalPrice = $invoice->INVC_TOTL;
        $clientID = $invoice->INVC_CLNT_ID;
        $gold = $invoice->INVC_TOTL_GOLD;

        Ledger::insertLedger($clientID, $userID, $totalPrice*-1, $gold*-1, $gold*-1, true, "فاتوره رقم " . $id );

      });
    }

    public static function cancelInvoice($id){
      DB::table('invoices')->where('id', $id)->update([
        'INVC_STAT'     =>  2,
        'INVC_DATE'     => date('Y-m-d')
      ]);
    }

    public static function insertInvoice($clientID, $itemsArray){

      $totalPrice = 0;
      $totalGold = 0;
      foreach($itemsArray as $item){
        $totalGold += ($item['gram'] + $item['milli']/1000) ;
        $totalPrice += $item['price'] * ($item['gram'] + $item['milli']/1000);
      }

      return DB::transaction(function () use ($clientID, $itemsArray, $totalPrice, $totalGold){
        $invoiceID = DB::table('invoices')->insertGetId([
          'INVC_DATE'     => date('Y-m-d'),
          'INVC_CLNT_ID'  => $clientID,
          'INVC_TOTL'     => number_format($totalPrice, 2),
          'INVC_TOTL_GOLD' => number_format($totalGold, 3)
        ]);

        // DB::table('invoice_items')->where('INIT_INVC_ID', $invoiceID)->delete();

        foreach($itemsArray as $item){
          DB::table('invoice_items')->insert([
            'INIT_INVC_ID' => $invoiceID,
            'INIT_MLLI' => $item['milli'],
            'INIT_GRAM' => $item['gram'],
            'INIT_CONT' => $item['count'],
            'INIT_GOLD_TYPE' => $item['type'],
            'INIT_ITEM' => $item['item'],
            'INIT_PRCE' => $item['price']
          ]);
        }
        return $invoiceID;
      });


    }

    public static function editInvoice($id, $clientID, $itemsArray){

      $totalPrice = 0;
      $totalGold = 0;
      foreach($itemsArray as $item){
        $totalGold += ($item['gram'] + $item['milli']/1000);
        $totalPrice += $item['price'] * ($item['gram'] + $item['milli']/1000);
      }

      DB::transaction(function () use ($id, $clientID, $itemsArray, $totalPrice, $totalGold){
        DB::table('invoice_items')->where('INIT_INVC_ID', $id)->delete();

        foreach($itemsArray as $item){
          DB::table('invoice_items')->insert([
            'INIT_INVC_ID' => $id,
            'INIT_MLLI' => $item['milli'],
            'INIT_GRAM' => $item['gram'],
            'INIT_CONT' => $item['count'],
            'INIT_GOLD_TYPE' => $item['type'],
            'INIT_ITEM' => $item['item'],
            'INIT_PRCE' => $item['price']
          ]);
         DB::table('invoices')->where('id', $id)->update([
          'INVC_DATE'     => date('Y-m-d H:i:s'),
          'INVC_CLNT_ID'  => $clientID,
          'INVC_TOTL'     => $totalPrice,
          'INVC_TOTL_GOLD' => $totalGold
        ]);

        }
      });
    }



}
