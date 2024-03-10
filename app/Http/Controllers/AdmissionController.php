<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdmissionController extends Controller
{
   public function index(){
    $colleges=DB::table('college_master')->get();
    $alldetails=DB::table('admission_tbl')
            ->join('college_master', 'admission_tbl.college_id', '=', 'college_master.college_id')
            ->select('admission_tbl.*', 'college_master.college_name','college_master.course_fee')
            ->get();
    return view('index')->with('colleges',$colleges)->with('alldetails',$alldetails);
   }

   public function add(Request $request){
    $rules = [
            'applicantName' => 'required',
            'collegeName' => 'required',
            'optionalField' => 'required',
        ];
        $messages = [
        'applicantName.required' => 'Applicant Name is required.',
        'collegeName.required' => 'College Name is required.',
        'optionalField.required' => 'Optional Field is required.',
    ];
        $validator = Validator::make($request->all(), $rules,$messages);


        if ($validator->fails()) {
            //  dd($validator);
            $message=$validator->errors();
            // dd($message);
            return redirect()->back()->with('errors',$message);
        }
        $collegeId=$request->collegeName;

        // dd($validator);
        $totalSeats = DB::table('college_master')
                    ->where('college_id', $collegeId)
                    ->select('total_seats')
                    ->first();
                    //dd($totalSeats);
        if($totalSeats->total_seats>0){
            DB::table('college_master')
            ->where('college_id', $collegeId)
            ->decrement('total_seats', 1);

            $requestData = [
                'applicant_name' => $request->input('applicantName'),
                'college_id' => $request->input('collegeName'),
                'fourth_optional' => $request->input('optionalField'),
            ];


            DB::table('admission_tbl')->insert($requestData);

            return redirect()->back()->with('success',"Enrollment Successful");
        }
        else{
            return redirect()->back()->with('error',"Seat is Full");

        }

   }


   public function delete(Request $request)
{
   $admissionId = $request->input('admission_id');


    $detail = DB::table('admission_tbl')
            ->where('enrollment_id', $admissionId)
            ->first();
    $collegeId=$detail->college_id;
    // dd($collegeId);
    DB::table('admission_tbl')->where('enrollment_id', $admissionId)->delete();

    DB::table('college_master')
    ->where('college_id', $collegeId)
    ->increment('total_seats', 1);

    return response()->json(['message' => 'Record deleted successfully']);
}

}
