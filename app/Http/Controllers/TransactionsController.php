<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Workshops;
use Laravel\Inventory;
use Laravel\Transactions;
use Auth;

class TransactionsController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function show(){
      $data['transactions'] = Transactions::getAllTransaction();
      return view('transactions.home', $data);
    }

    public function addPage(){
      $data['workshops'] = Workshops::getAll();
      $data['inventory'] = Inventory::getAll();
      $data['formURL'] = url('transactions/insert');

      return view('transactions.add', $data);
    }

    public function insert(Request $request){

      $fromID = $request->fromID;
      $toID = $request->toID;
      $moneyAmount = $request->Money;
      $entryGold21 = $request->Gold21;
      $entryGold18 = $request->Gold18;
	  $isSalary = $request->isSalary;
      $inventoryID = $request->inventoryID;
      $count = $request->count;

      Transactions::insertTransaction($fromID, $toID, $entryGold18, $entryGold21, $moneyAmount, Auth::id(), $inventoryID, $count, $isSalary);

      return redirect('transactions/show');

    }
}
