<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{

    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }



    function insert_monthly_active_student()
    {

        try {
            $month = date('m');
            $year = date('Y');

            $school_info = DB::table('school_info')->where('status', 1)->get();

            $users = [];

            foreach ($school_info as $row => $value) {

                $users[$value->id] = DB::connection($value->database_name)->table('students')->where('status_type', 'regular')->count();
            }
            $data = [];
            $insert = '';
            foreach ($school_info as $row => $value) {
                $data['school_id'] =  $value->id;
                $data['month'] =  $month;
                $data['year'] =  $year;
                $data['total'] =  $users[$value->id];
                $data['status'] =  1;
                $already_inserted = DB::table('monthly_active_students')->where('school_id', $value->id)->where('month', $month)->where('year', $year)->where('status', 1)->first();
               
                if (!$already_inserted && empty($already_inserted)) {

                    $insert =  DB::table('monthly_active_students')->insert($data);
                }
            }

            if($insert){
                flash()->addSuccess('Insert success.');
             }else{
                flash()->addError('Insert fail.');
             }
            return redirect()->route('dashboard');


        } catch (QueryException $e) {
            return $e->getMessage();
            //Session::flash("message",$e->getMessage());
            //    Session::flash("message", $e->errorInfo[2]);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (is_null($this->user) || !$this->user->can('dashboard.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any dashboard !');
        }
        $year = date('Y');
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $school_info = DB::table('school_info')->where('status', 1)->get();
        $active_student = DB::table('monthly_active_students')->where('status', 1)->get();
        $all_school_active_student = [];
        $users = [];

        foreach ($school_info as $row => $value) {
            $all_school_active_student[$value->school_name] = DB::table('monthly_active_students')->where('school_id', $value->id)->where('year', $year)->where('status', 1)->get();
            $users[$value->id] = DB::connection($value->database_name)->table('students')->where('status_type', 'regular')->count();
        }



        // echo"<pre>"; print_r($year); exit;
        // echo "<pre>";
        // print_r($users);
        // exit;
        // echo"<pre>"; print_r($all_school_active_student); exit;
        // echo"<pre>"; print_r($school_info); exit;
        // echo"<pre>"; print_r($active_student); exit;
        return view('backend.index', compact('all_school_active_student', 'school_info', 'months', 'active_student', 'year'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
