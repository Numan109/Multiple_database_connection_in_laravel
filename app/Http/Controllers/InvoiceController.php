<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Invoice as GlobalInvoice;

class InvoiceController extends Controller
{

    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }



    public function index()
    {

        if (is_null($this->user) || !$this->user->can('dashboard.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any dashboard !');
        }

        try {

            $page_header = "";
            $add_button = "";
            $invoices = Invoice::where('status', 1)->get();
            return view('backend.invoice.index', compact('page_header', 'add_button', 'invoices'));
        } catch (Exception $e) {
            $e->getMessage();
        }
    }


    public function create()
    {

        if (is_null($this->user) || !$this->user->can('dashboard.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any dashboard !');
        }
        try {
            $page_header = "Invoice Management";
            $add_button = "";


            $data = '';

            $selected_month = '';

            return view('backend.invoice.create_invoice', compact('data', 'page_header', 'add_button', 'selected_month'));
        } catch (Exception $e) {
            $e->getMessage();
        }
    }


    public function acticeStudentForInvoice(Request $request)
    {
        try {

            $month = $request->month;
            $year = date('Y');

            $data = DB::table('monthly_active_students')
                ->select('monthly_active_students.*', 'school_info.school_name')
                ->join('school_info', 'school_info.id', '=', 'monthly_active_students.school_id')
                ->where('monthly_active_students.month', $month)
                ->where('monthly_active_students.year', $year)
                ->get();

            $selected_month = $month;
            $page_header = "Invoice Management";
            $add_button = "";
            return view('backend.invoice.create_invoice', compact('data', 'page_header', 'add_button', 'selected_month'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function store()
    {

        if (is_null($this->user) || !$this->user->can('dashboard.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any dashboard !');
        }

        try {


            $rate = 10;
            $discount = '00.00';
            $day = '01';
            $month = date('m');
            $year = date('Y');
            $bill_info = DB::table('monthly_active_students')
                ->select('monthly_active_students.*', 'school_info.school_name')
                ->join('school_info', 'school_info.id', '=', 'monthly_active_students.school_id')
                ->where('monthly_active_students.month', $month)
                ->where('monthly_active_students.year', $year)
                ->get();



            $total_student = 0;
            foreach ($bill_info as $row) {
                $total_student += $row->total;
            }

            $already_inserted = Invoice::where('month',$month)->first();
            if( $already_inserted && !empty($already_inserted)){

                return "Already inserted invoice for this month.";
              
            }else{
            $data = [];

            $data['invoice_type'] = 'invoice';
            $data['month'] = $month;
            $data['total_student'] = $total_student;
            $data['gross_amount'] = $total_student * $rate;
            $data['net_amount'] = $total_student * $rate;
            $data['discount'] = $discount;
            $data['paid_status'] = 'unpaid';
            $data['date'] = date('m-Y', strtotime($day . '-' . $month . '-' . $year));
            $data['note'] = '';
            $data['status'] = 1;
            $data['created_at'] = date('Y-m-d H:s:i');
            $data['modified_at'] = date('Y-m-d H:s:i');
            $data['created_by'] = Auth::user()->id ?? '';
            $data['modified_by'] = Auth::user()->id ?? '';
            // return $data;

            $lastInsertId = DB::table('invoices')->insertGetId($data);

            if ($lastInsertId) {
                DB::table('invoices')->where('id', $lastInsertId)->update([

                    'custom_invoice_id' =>  'INV-' . sprintf('%06d', $lastInsertId)
                ]);

                $single_data = [];
                foreach ($bill_info as $key => $value) {

                    $single_data['invoice_id'] = $lastInsertId;
                    $single_data['school_id'] = $value->school_id;
                    $single_data['month'] = date('m-Y', strtotime($day . '-' . $month . '-' . $year));
                    $single_data['student'] = $value->total;
                    $single_data['gross_amount'] = $value->total * $rate;
                    $single_data['discount'] = $discount;
                    $single_data['net_amount'] = $single_data['gross_amount'] - $single_data['discount'];
                    $single_data['status'] = 1;
                    $single_data['created_at'] = date('Y-m-d H:s:i');
                    $single_data['modified_at'] = date('Y-m-d H:s:i');
                    $single_data['created_by'] = Auth::user()->id ?? '';
                    $single_data['modified_by'] = Auth::user()->id ?? '';

                    $invoice_details = DB::table('invoice_detail')->insert($single_data);
                }
            }

            if ($invoice_details) {
                return "Insert success.";
                // flash()->addSuccess('Insert success.');
            } 

            // return redirect()->route('invoice_view');
        }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function show($id)
    {

        if (is_null($this->user) || !$this->user->can('dashboard.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any dashboard !');
        }


        try {

           
            $invoice = Invoice::where('id', $id)->first();
            // $invoice_with_details = Invoice::with('invoiceDetails')->where('id', $id)->get()->toArray();

            $invoice_with_details = DB::table('invoices as I')
                ->select('I.*','ID.student','ID.gross_amount as g_amount','ID.discount as id_discount', 'ID.net_amount as id_net_amount','SI.school_name')
                ->join('invoice_detail as ID', 'ID.invoice_id', '=', 'I.id')
                ->join('school_info as SI', 'SI.id', '=', 'ID.school_id')
                ->where('I.id', $id)
                ->get();

            //  return $invoice_with_details;
            $page_header = "";
            $add_button = "";

            return view('backend.invoice.view_invoice', compact('invoice','invoice_with_details','page_header', 'add_button'));

        } catch (Exception $e) {
            $e->getMessage();
        }
    }


    public function print($id)
    {

        if (is_null($this->user) || !$this->user->can('dashboard.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any dashboard !');
        }


        try {

           
            $invoice = Invoice::where('id', $id)->first();

            $invoice_with_details = DB::table('invoices as I')
            ->select('I.*','ID.student','ID.gross_amount as g_amount','ID.discount as id_discount', 'ID.net_amount as id_net_amount','SI.school_name')
            ->join('invoice_detail as ID', 'ID.invoice_id', '=', 'I.id')
            ->join('school_info as SI', 'SI.id', '=', 'ID.school_id')
            ->where('I.id', $id)
            ->get();

           
            return view('backend.invoice.print_invoice', compact('invoice','invoice_with_details',));

        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function edit(invoice $invoice)
    {
        //
    }


    public function update(Request $request, invoice $invoice)
    {
        //
    }


    public function destroy(invoice $invoice)
    {
        //
    }
}
