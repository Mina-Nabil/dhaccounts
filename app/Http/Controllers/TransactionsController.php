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
      $data['workshopPage'] = false;
      return view('transactions.home', $data);
    }

    public function showWorkshop($workshopID){
      $data['transactions'] = Transactions::getTransactionByWorkshop($workshopID);
      $data['workshopPage'] = true;
      if($workshopID==0)
        $data['workshop'] = (object) array('WKSP_NAME' => 'يوميه', 'id'=> 0);
      else
        $data['workshop']     = Workshops::get($workshopID);

      $data['workshopFormURL'] = url('transactions/records');

      return view('transactions.home', $data);
    }

    public function showWorkshopRecords(Request $request){

      $workshopID = $request->workshopID;
      $startDate = $request->startDate;
      $endDate   = $request->endDate;

      $data['transactions'] = Transactions::getTransactionRecordsByWorkshop($workshopID, $startDate, $endDate);
      $data['workshopPage'] = true;
      if($workshopID==0)
        $data['workshop'] = (object) array('WKSP_NAME' => 'يوميه', 'id'=> 0);
      else
        $data['workshop']     = Workshops::get($workshopID);

      $data['workshopFormURL'] = url('transactions/records');

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
      $comment = $request->comment;

      Transactions::insertTransaction($fromID, $toID, $entryGold18, $entryGold21, $moneyAmount, Auth::id(), $inventoryID, $count, $isSalary, $comment);

      return redirect('transactions/show');

    }
}
