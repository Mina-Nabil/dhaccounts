<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Ledger;
use Laravel\Clients;
use Laravel\Workshops;
use Auth;

class LedgerController extends Controller
{
    //
    public function __construct(Request $request){
      $this->middleware('auth');

    }

    public function home($clientID = 0){

      if(is_numeric($clientID) && $clientID != 0){
        $data['client'] = Clients::getClient($clientID);

        if(!isset($data['client']->CLNT_NAME)) return redirect("home");

        $data['clientPage'] = true;

        $data['Ledger']    = Ledger::getClientLedger($clientID);

      } else {
        $data['clientPage'] = false;
        $data['maxLedger'] = Ledger::getLastEntry();
        $data['Ledger']    = Ledger::getFullLedger();
        $data['workshops'] = Workshops::getTotals();
        $data['clients'] = Clients::getTotals();
        $data['totalGold'] = ($data['maxLedger']->LDGR_GD18_CURR * (18/24) ) + ($data['maxLedger']->LDGR_GD21_CURR * (21/24) );
        $data['total18'] = ($data['maxLedger']->LDGR_GD18_CURR * (18/24) );
        $data['percent18'] = $data['total18']  /  $data['totalGold'] * 100;
        $data['total21'] = ($data['maxLedger']->LDGR_GD21_CURR * (21/24) );
        $data['percent21'] = $data['total21']  /  $data['totalGold'] * 100;
      }


      return view('ledger.home', $data);
    }

    public function addPage(){

      $data['Clients'] = Clients::getClients();
      $data['formURL'] = url('ledger/insert');

      return view('ledger.add', $data);
    }

    public function insert(Request $request){

      //Radiobuttons
      $goldRadio = $request->goldRadio;
      $gold21Radio = $request->gold21Radio;
      $gold18Radio = $request->gold18Radio;
      $moneyRadio  = $request->moneyRadio;

      $clientID = $request->clientID;
      $moneyAmount = $request->Money;
      $clientGold = $request->Gold;
      $entryGold21 = $request->Gold21;
      $entryGold18 = $request->Gold18;
      $isGoldDiff = $request->isGoldDiff;
      $comment = $request->ledgerComment;

      $moneyAmount = $moneyRadio * $moneyAmount;
      if($clientID == 0){
        $entryGold21 = $gold21Radio * $entryGold21;
        $entryGold18 = $gold18Radio * $entryGold18;
        Ledger::insertLedger($clientID, Auth::id(), $moneyAmount, $entryGold21, $entryGold18, false, $comment );
      }else {
        $clientGold = $goldRadio * $clientGold;
        Ledger::insertLedger($clientID, Auth::id(), $moneyAmount, $clientGold, $clientGold, $isGoldDiff, $comment );
      }

      return redirect('home');
    }

    public function delete(){
      Ledger::deleteLedger();
      return redirect('home');
    }
}
