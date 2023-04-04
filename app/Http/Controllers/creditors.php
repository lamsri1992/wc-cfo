<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class creditors extends Controller
{
    public function dashboard()
    {
        $creditor = DB::table('d_list')->distinct('d_creditor_id')->count();
        $crelist  = DB::table('d_list')->where('d_status',1)->sum('d_cost');
        $list     = DB::table('d_list')->count();
        $pay      = DB::table('d_list')->where('d_status',3)->count();
        $paid     = DB::table('d_list')->where('d_status',3)->sum('d_cost');
        $year    = DB::select(DB::raw("SELECT d_year,SUM(d_cost) AS total
                    FROM d_list
                    WHERE d_status = 1
                    GROUP BY d_year
                    ORDER BY d_year ASC"));
        $chart    = DB::select(DB::raw("SELECT d_type_name,SUM(d_cost) AS total
                    FROM d_list
                    WHERE d_status = 1
                    GROUP BY d_type_id 
                    ORDER BY total DESC"));
        return view('pages.dashboard',['creditor'=>$creditor,'crelist'=>$crelist,'list'=>$list,'pay'=>$pay,'paid'=>$paid,'year'=>$year,'chart'=>$chart]);
    }

    public function all()
    {
        $result = DB::table('d_list')->where('d_status',1)->get();
        return view('pages.list',['result'=>$result]);
    }

    public function paid()
    {
        $result = DB::table('d_list')->where('d_status',3)->get();
        return view('pages.paid',['result'=>$result]);
    }

    public function show($id)
    {
        $list   = DB::table('d_list')
                    ->join('creditors','creditors.cre_id','d_list.d_creditor_id')
                    ->join('d_type','d_type.type_id','d_list.d_type_id')
                    ->where('d_id',$id)->first();
        return view('pages.show',['list'=>$list]);
    }

    public function update(Request $request,$id)
    {
        $log = 'มีการแก้ไขข้อมูลเมื่อ '.DateTimeThai(date('Y-m-d h:i:s')).' โดย :: ผู้ดูแลระบบ';
        $log_update = $request->d_log.','.$log;
        DB::table('d_list')->where('d_id',$id)->update(
            [
                'd_year' => $request->d_year,
                'd_date_create' => $request->d_date_create,
                'd_date_order' => $request->d_date_order,
                'd_cost' => $request->d_cost,
                'd_type_id' => $request->d_type_id,
                'd_creditor_id' => $request->d_creditor_id,
                'd_doc_no' => $request->d_doc_no,
                'd_bill_no' => $request->d_bill_no,
                'd_log' => $log_update,
            ]
        );
        return back()->with('success','แก้ไขข้อมูลสำเร็จ');
    }

    public function payment(Request $request, $id)
    {
        $list = DB::table('d_list')->where('d_id',$id)->first();
        $log = 'บิลถูกบันทึกการชำระ '.DateTimeThai(date('Y-m-d h:i:s')).' โดย :: ผู้ดูแลระบบ';
        $log_update = $list->d_log.','.$log;

        if(empty($request->file('d_bill'))){
            return back()->with('error','กรุณาแนบไฟล์เอกสารบิลการชำระหนี้');
        }else{

            $file  = $request->file('d_bill');
            $fileName  = $request->file('d_bill')->getClientOriginalName();
            $file->move('files/bill', $fileName);
            
            DB::table('d_list')->where('d_id',$id)->update(
                [
                    'd_date_payment' => $request->ft_date,
                    'd_status' => 3,
                    'd_log' => $log_update,
                    'd_note' => $request->ft_note,
                    'd_bill' => $fileName,
                ]
            );
            return back()->with('success','บันทึกการชำระหนี้สำเร็จ , BillNo :: '.$list->d_bill_no);
        }
    }

    public function report(Request $request)
    {
        if($request->s_year == NULL){ $qry_year = ""; } else { $qry_year = "AND d_year = '$request->s_year'"; }
        if($request->s_type == NULL){ $qry_type = ""; } else { $qry_type = "AND d_type_id = '$request->s_type'"; }
        if($request->s_credit == NULL){ $qry_credit = ""; } else { $qry_credit = "AND d_creditor_id = '$request->s_credit'"; }

        $result = DB::select(DB::raw("SELECT * FROM d_list
                LEFT JOIN d_status ON d_status.st_id = d_list.d_status
                WHERE d_status = '$request->s_status' $qry_year $qry_type $qry_credit
                AND d_date_create BETWEEN '$request->s_start' AND '$request->s_end'"));
        return view('pages.report',['result'=>$result]);
    }
}
