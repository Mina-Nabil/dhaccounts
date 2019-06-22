<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Invoices;
use Laravel\Clients;
use Auth;

class InvoicesController extends Controller
{
    //
    public function __construct(){
      $this->middleware('auth');
    }

    public function home(){
      $data['Invoices'] = Invoices::getAllInvoices();
      return view('invoices.home', $data);
    }

    public function show($id){
      $data['invoice'] = Invoices::getInvoice($id);
      return view('invoices.profile', $data);
    }

    public function addPage(){

      $data['pageTitle'] = "اضافه فاتوره";
      $data['pageDescription'] = "اضافه فاتوره جديده";
      $data['formURL'] = url('invoice/insert');
      $data['isDynamicForm'] = true;
      $data['clients'] = Clients::getClients();

      return view('invoices.add', $data);

    }

    public function insert(Request $request){
      $clientID   = $request->clientID;
      $clientType = Clients::getClient($clientID)->CLNT_ACTP;
      $itemsArray = $this->getItemsArray($request, $clientType);

      $invoiceID = Invoices::insertInvoice($clientID, $itemsArray);
      return redirect('invoice/show/' . $invoiceID);
    }

    public function edit($id){
      $data['invoice'] = Invoices::getInvoice($id);

      if(!isset($data['invoice']['invoiceData']) || $data['invoice']['invoiceData']->INVC_STAT !=0) return redirect('404');

      $data['pageTitle'] = "تعديل فاتوره";
      $data['pageDescription'] = "  تعديل فاتوره ( " . sprintf("%08d" , $data['invoice']['invoiceData']->id ).  " ) ";
      $data['formURL'] = url('invoice/edit/' . $data['invoice']['invoiceData']->id );
      $data['isDynamicForm'] = true;
      $data['clients'] = Clients::getClients();

      return view('invoices.add', $data);
    }

    public function updateData($id, Request $request){
      $clientID   = $request->clientID;
      $clientType = Clients::getClient($clientID)->CLNT_ACTP;
      $itemsArray = $this->getItemsArray($request, $clientType);

      $invoiceID = Invoices::editInvoice($id, $clientID, $itemsArray);
      return redirect('invoice/show/' . $id);
    }

    public function confirmInvoice($id){
      Invoices::confirmInvoice($id, Auth::id());
      return redirect("invoice/show/" . $id);
    }

    public function cancelInvoice($id){
      Invoices::cancelInvoice($id);
      return redirect("invoice/show");
    }

    private function getItemsArray($requestArr, $clientType){
      $retArr = array();
      for($i = 0 ; isset($requestArr->item[$i]) ; $i++){
        $retArr[$i]['item'] = $requestArr->input('item')[$i];
        $retArr[$i]['milli'] = (!isset($requestArr->input('milli')[$i])  || is_null($requestArr->input('milli')[$i]) && $requestArr->input('milli')[$i] > 0)? 0 : $requestArr->input('milli')[$i];
        $retArr[$i]['price'] = $requestArr->input('price')[$i];
        $retArr[$i]['gram'] = $requestArr->input('gram')[$i];
        $retArr[$i]['count'] = $requestArr->input('count')[$i];
        $retArr[$i]['type'] = $clientType;
      }
      return $retArr;
    }
}
