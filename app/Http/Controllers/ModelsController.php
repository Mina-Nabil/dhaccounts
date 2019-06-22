<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Models;

class ModelsController extends Controller
{
    //
    public function __construct(){
      $this->middleware('auth');
    }

    public function home(){
      $data['Models'] = Models::getModels();
      return view('models.show', $data);
    }

    public function edit($id){
      $data['model'] = Models::getModelByID($id);
      $data['pageTitle'] = "تعديل موديل";
      $data['pageDescription'] = "تعديل ( " . $data['model']->MODL_NAME . " ) ";
      $data['formURL'] = url('models/update/'. $id);

       return view('models.add', $data);
    }

    public function add(){

      $data['pageTitle'] = "اضافه موديل";
      $data['pageDescription'] = "اضافه موديل جديد";
      $data['formURL'] = url('models/insert');

       return view('models.add', $data);
    }

    public function insert(Request $request){
      Models::insertModel($request->name);
      return redirect('models/home');
    }

    public function update($id, Request $request){
      Models::updateModel($id, $request->name);
      return redirect('models/home');
    }
}
