<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;

use Laravel\Workshops;

class WorkshopsController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

  function home(){
    $data['Tabledata'] = Workshops::getAll();
    $data['totals']    = Workshops::getTotals();
    return view('workshops.show', $data);
  }

  function add(){

    $data['pageTitle'] = "اضافه ورشه";
    $data['pageDescription'] = "اضافه ورشه جديده";
    $data['formURL'] = url('workshops/insert');

    return view('workshops.add', $data);
  }

  function insert(Request $request){
    Workshops::insert($request->name, $request->gold18, $request->gold21, $request->money, $request->comment, $request->mobNumber, $request->address);
    return redirect('workshops/show');
  }

  function modify($id){

    $data['workshop'] = Workshops::get($id);
    $data['pageTitle'] = "تعديل ورشه";
    $data['pageDescription'] = "تعديل ( " . $data['workshop']->WKSP_NAME . " ) ";
    $data['formURL'] = url('workshops/update/'. $id);

    return view('workshops.add', $data);
  }

  function update($id, Request $request){
    Workshops::updateWorkshop($id, $request->name, $request->gold18, $request->gold21, $request->money, $request->comment, $request->mobNumber, $request->address);
    return redirect('workshops/show');
  }

}
