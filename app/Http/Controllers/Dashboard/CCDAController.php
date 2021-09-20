<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CCDAImport;
use Auth;
use Session;
use Storage;
use Illuminate\Support\Facades\Validator;
use Helper;
use App\Model\Allergies;
use App\Model\Labs;
use App\Model\Medications;
use App\Model\Notes;
use App\Model\Problems;
use App\Model\Vitals;
use App\Model\PatientFileUpload;
use App\Model\PatientMeta;

class CCDAController extends Controller
{
    public function ccdaimportFile(Request $request){
         $validator = Validator::make($request->all(), [
            'file' => ['required'],
            'description' => ['required']
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $path = '';
        if($request->hasfile('file')){
            if ($request->file('file')->isValid()) {
                $validated = $request->validate([
                    'file' => 'mimes:xml|max:3028',
                ]);
                $extension = $request->file->extension();
                $num = time();
                $request->file->storeAs('/public', $num.".".$extension);
                $url = Storage::url($num.".".$extension);
                $path = $url;
            }
        }

        $insertData = ['patient_id'=>$request->patient_id,'user_id'=>Helper::getParentId(),'description'=>$request->description,'file_path'=>$path,'status'=>'1'];
        $id = CCDAImport::insertGetId($insertData);
        $msg = "File has been uploaded successfully.";
        $insertData['insert_id'] = $id;
        Helper::processCCDA($insertData);

        Session::flash('msg', $msg); 
        Session::flash('tab', 'ccdafile'); 
        return redirect()->back();
    }
}
