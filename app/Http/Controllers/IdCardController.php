<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Employee;
use App\Models\IdType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;


class IdCardController extends BaseController
{
    public   function print_id($id)
    {
        $emp = Employee::where('id', '=', $id)->with('job')->get()->first();
        $data=['emp' => $emp];
        $data['doc'] = Attachment::where("user_id", "=", $id)->get()->last();

        return view('print_id', $data);
    }
    public   function notify()
    {
        $data['employees'] = Employee::where("status", "=", 0)->get();
        
        return view('notify', $data);
    }
    public function send_noify(Request $request)
    {
        $validated = $request->validate([
            'send_to' => 'required',
            'message' => 'required'
        ]);
        $send_to = $request->send_to;

        if (in_array('all', $send_to))
            $employees = Employee::where("status", "=", 0)->get();
        else
            $employees = Employee::whereIn("id",  $send_to)->get();
        $send_to_list = [];
        foreach ($employees as $v){
            $message ="<p>";
            $message .= $request->message;
            $send_to_list[] = ["name" => $v->name, "email" => $v->email];
            $message .="</p><br>".' <div style="text-align: center;";>  <a style="text-decoration: none;color:white;background-color: #4b66a0;padding:5px 10px
            font-weight:bold;" href="'.route('confrim_info_link',[encrypt_id($v->id)]).'" >
            <span >
                رابط التاكيد
            </span>
        </a></div>';
        send_email($send_to_list, $message, 'الرجاء تاكيد معلومات البطاقة');
        $data['employees'] = Employee::where("status", "=", 0)->get();
        $data['msg'] = "تم ارسال الاشعار بنجاح";

        return view('notify', $data);

        }
    }
}
