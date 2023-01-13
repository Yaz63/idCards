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
    //dd($id);
    $emp = $data['emp'] = Employee::where("id", "=", $id)->with("job")->get()->first();

    $data['doc_types'] = IdType::all();
    return view("confirm", $data);
  }
  public function save(Request $request)
  {
    $emp = Employee::findOrFail($request->id);
    $validated = $request->validate([
      'image' => 'required|image|mimes:jpg,jpeg,png',
      'type_id' => 'required',
      'doc' => 'required',
      'confirm' => 'required',
    ]);
    $image = $request->file('image')->store('employees');
    $extension = pathinfo(storage_path('app/public/'.$image ), PATHINFO_EXTENSION);
    $image_name = time() . '.' . $extension;
    $destinationPath = storage_path('app/public/employees');
    $imgFile = Image::make(storage_path('app/public/'.$image ));
    $imgFile->resize(220, 220)->save($destinationPath . '/' . $image_name);
    $emp->image = 'employees/'.$image_name;
    $emp->status = $request->confirm;
    $emp->save();

    if ($request->hasFile('doc')) {
      //
    }

    Attachment::create([
      "orginal_name" => $_FILES['doc']['name'],
      'name' => $request->file('doc')->store('employees'),
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
