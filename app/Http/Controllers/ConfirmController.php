<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Employee;
use App\Models\IdType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;


class ConfirmController extends BaseController
{
  public function index($id)
  {
    $id = decrypt_id($id);
    $emp = $data['emp'] = Employee::where("id", "=", $id)->with("job")->get()->first();
    // dd(url("employees".$emp->image));
    $data['doc_types'] = IdType::all();
    return view("confirm", $data);
  }
  public function save(Request $request)
  {
    $emp = Employee::findOrFail($request->id);
    $validated = $request->validate([
      'image' => 'required|image',
      'type_id' => 'required',
      'doc' => 'required',
      'confirm' => 'required',
    ]);
    $emp->image = $request->file('image')->store('public/employees');
    $emp->status = $request->confirm;
    //  $emp->status = 0;
    $emp->save();

    if ($request->hasFile('doc')) {
      //
    }

    Attachment::create([
      "orginal_name" => $_FILES['doc']['name'],
      'name' => $request->file('doc')->store('public/employees'),
      "user_id" => $emp->id,
      "type_id" => $request->type_id,
    ]);
    $data['emp'] = Employee::where("id", "=", $emp->id)->with("job")->get()->first();
    $data['doc_types'] = IdType::all();
    return view("confirm", $data);
  }


  public   function test()
  {

    return view('test');
  }
}
