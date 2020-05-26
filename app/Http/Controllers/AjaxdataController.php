<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Student;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTablesServiceProvider;
use Yajra\DataTables\Facades\DataTables;




class AjaxdataController extends Controller
{

    public  function index(){
        return view("student.ajax");

    }

    function getData(){
        $students = Student::select('id','first_name', 'last_name');
        return Datatables::of($students)->addColumn('action',function ($student){
            return '<a href="#" class="btn btn-xs btn-primary edit" id="'.$student->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        })->make(true);

    }

    function postData(Request $request){

        $validation = Validator::make($request->all(),[
            "first_name"=>"required",
            "last_name"=>"required",
        ]);

        $error_array = array();
        $success_output = '';
        if ($validation->fails())
        {
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }
        else{

            if ($request->get("button_action")=="insert"){

                $student = new Student([
                    "first_name"=>$request->get("first_name"),
                    "last_name"=>$request->get("last_name")
                ]);
                $student->save();
                $success_output= "<div class='alert  alert-success'>Adta Inserted</div>";

            }

            if ($request->get("button_action")=="update"){

                $student = Student::find($request->get("studnet_id"));
                //var_dump($student);

                $student->first_name = $request->get("first_name");
                $student->last_name = $request->get("last_name");

                $student->save();

            }


        }

        $output = array(
            "error"=>$error_array,
            "success"=>$success_output,
        );

        echo  json_encode($output);

    }

    function fetchData(Request $request){
        $id = $request->input("id");
        $student = Student::find($id);

        $output = array(
          "first_name"=>$student->first_name,
          "last_name"=>$student->last_name,
        );

        echo json_encode($output);

    }
}
