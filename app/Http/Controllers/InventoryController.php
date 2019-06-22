<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Inventory;
use Laravel\Models;

class InventoryController extends Controller
{
    //
    public function __construct(){
      $this->middleware('auth');
    }

    public function home(){
      $data['Inventory'] = Inventory::getAll();
      return view('inventory.show', $data);
    }

    public function edit($id){
      $data['inventory'] = Inventory::getInventoryByID($id);
      $data['pageTitle'] = "تعديل نوع موديل";
      $data['pageDescription'] = "تعديل ( " . $data['inventory']->INVT_NAME . " ) ";
      $data['formURL'] = url('inventory/update/'. $id);

      $data['Models'] = Models::getModels();
       return view('inventory.add', $data);
    }

    public function add(){

      $data['pageTitle'] = "اضافه صنق";
      $data['pageDescription'] = "اضافه نوع جديد";
      $data['formURL'] = url('inventory/insert');

      $data['Models'] = Models::getModels();
       return view('inventory.add', $data);
    }

    public function insert(Request $request){
      Inventory::insertInventory($request->name, $request->modlID, $request->count);
      return redirect('inventory/home');
    }

    public function update($id, Request $request){
      Inventory::updateInventory($id, $request->name, $request->modlID, $request->count);
      return redirect('inventory/home');
    }
}
