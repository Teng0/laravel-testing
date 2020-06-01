<?php

namespace App\Http\Controllers;

use App\Exports\CountryExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Excel;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;



class LiveSearch extends Controller
{

    function index(){

        return view("live_search");

    }

    function action(Request $request)
    {
        if($request->ajax())
        {
            $output = '';
            $query = $request->get('query');
            if($query != '')
            {
                $data = DB::table('country_state_city')
                    ->where('country', 'like', '%'.$query.'%')
                    ->orWhere('state', 'like', '%'.$query.'%')
                    ->orWhere('city', 'like', '%'.$query.'%')
                    ->get();

            }
            else
            {
                $data = DB::table('country_state_city')
                    ->orderBy('country', 'desc')
                    ->get();
            }
            $total_row = $data->count();
            if($total_row > 0)
            {
                foreach($data as $row)
                {
                    $output .= '
        <tr>
         <td>'.$row->country.'</td>
         <td>'.$row->state.'</td>
         <td>'.$row->city.'</td>
        </tr>
        ';
                }
            }
            else
            {
                $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }

    public function export()
    {
        return Excel::download(new CountryExport(), 'Country.xlsx');
    }

    function excel(){

        $country_data = DB::table('country_state_city')->get()->toArray();

        $customer_array[]=array("country","state","city");

        foreach ($country_data as $counrty){

            $customer_array[]=array(
                "country"=>$counrty->country,
                "state"=>$counrty->state,
                "state"=>$counrty->state,

            );

        }
//        Excel::store('Customer Data', function($excel) use ($customer_array){
//            $excel->setTitle('Customer Data');
//            $excel->sheet('Customer Data', function($sheet) use ($customer_array){
//                $sheet->fromArray($customer_array, null, 'A1', false, false);
//            });
//        })->Excel::raw($customer_array, Excel::XLSX);

        //Excel::store($customer_array,Excel::XLSX);
        //Excel::raw($customer_array);
         return Excel::download( $customer_array, 'users.xlsx');

    }
}
