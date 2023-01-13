<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Employee;
use App\Models\IdType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use TCPDI;

class IdCardController extends BaseController
{
    public   function print_idold($id)
    {
        echo encrypt_id($id);
        exit;
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
    public function get_doc($id){

        //$emp = Employee::where('id', '=', $id)->with(['job','location'])->get()->first();
        $file=Attachment::where('user_id',"=",$id)->get()->last();

        return FacadesResponse::download(storage_path('app/public/'.$file->name));

    }
    public function print_id($id){

        $emp = Employee::where('id', '=', $id)->with(['job','location'])->get()->first();
            $pdf =  new TCPDI();
            $pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);
            $inputPath = "files/card.pdf";
            $outputName =  "card_{$emp->job_no}.pdf";
            $outputPath = $outputName;
            $pdf->numPages = $pdf->setSourceFile($inputPath);

            $lg['a_meta_charset'] = 'UTF-8';
           // $lg['a_meta_dir'] = 'rtl';
            $lg['a_meta_language'] = 'fa';
            $lg['w_page'] = 'page';

            // set some language-dependent strings (optional)
            $pdf->setLanguageArray($lg);
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            foreach (range(1, $pdf->numPages, 1) as $page) {
                ///echo    json_encode(["p"=>   $page]);
                $rotate = false;
                $degree = 0;
                try {
                    $pdf->_tplIdx = $pdf->importPage($page);
                } catch (\Exception $e) {
                    return false;
                }

                $size = $pdf->getTemplateSize($pdf->_tplIdx);
              //  $scale = round($size['w'] / $docWidth, 3);
                $pdf->AddPage(self::orientation($size['w'], $size['h']), array($size['w'], $size['h'], 'Rotate' => $degree), true);
                $pdf->useTemplate($pdf->_tplIdx);


                            $editted = true;
                            $imageArray =
                            $img = 'storage/'.$emp->image;
                            $logo = 'storage/'.$emp->location->logo;
                           // dd('storage/'.$emp->image);
                            $pdf->Image($logo, 48, 12, 40, 8, '', '', '', false);
                            $pdf->Image($img, 40, 43, 20, 20, '', '', '', false);
                            $editted = true;
                            $pdf->SetFont('helvetica', '', 6.5);
                            $pdf->SetFont('aefurat', '', 6.8    );


                            $pdf->writeHTMLCell(200,2.5, 42, 66,ltrim($emp->name), 0, true, '', false);
                            $pdf->writeHTMLCell(200,2.5, 42, 68.5,ltrim($emp->location->name), 0, true, '', false);
                            $pdf->writeHTMLCell(200,2.5, 42, 71.3,ltrim($emp->job->title), 0, true, '', false);
                }

            $f = $pdf->Output( $outputPath, 'I');



        return true;

    }
    public  function orientation($width, $height)
    {
        if ($width > $height) {
            return "L";
        } else {
            return "P";
        }
    }
    public  function scale($dimension, $scale)
    {
        return round($dimension * $scale);
    }
}
