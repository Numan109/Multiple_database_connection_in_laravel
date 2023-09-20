<?php

namespace App\Http\Controllers;


use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

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




    public function bidyaanLogin()
    {
        $username = 'viceprincipal';
        $password = md5(123456);

        try{
                $users = DB::connection('school_1')->table('users')->where('username', $username)->where('password', $password)->first();

                if($users){

                    return redirect()->to('https://v2.bidyaan.com/Auth/loginFromCentralPanel?username=' . $username . '&password=' . $password);
                }
        

        }catch(Exception $e){
                return $e->getMessage();
        }
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
                $data['created_at'] =  date('Y-m-d H:s:i');
                $data['created_by'] =  1;
                $already_inserted = DB::table('monthly_active_students')->where('school_id', $value->id)->where('month', $month)->where('year', $year)->where('status', 1)->first();

                if (!$already_inserted && empty($already_inserted)) {

                    $insert =  DB::table('monthly_active_students')->insert($data);
                }
            }

            if ($insert) {
                flash()->addSuccess('Insert success.');
            } else {
                flash()->addError('Already Inserted.');
            }
            return redirect()->route('dashboard');
        } catch (QueryException $e) {
            // return $e->getMessage();
            // Session::flash("message",$e->getMessage());
            //    Session::flash("message", $e->errorInfo[2]);
            flash()->addError($e->errorInfo[2]);
        }
    }


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

// return $school_info;exit;
        return view('backend.index', compact('all_school_active_student', 'school_info', 'months', 'active_student', 'year'));
    }


    public function roleWisePermissionList()
    {
        $id = Auth::user()->id;
        $roleWisePermissionList = DB::table('model_has_roles')
            ->join('role_has_permissions', 'model_has_roles.role_id', '=', 'role_has_permissions.role_id')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->select('permissions.name', 'permissions.id')
            ->where('model_has_roles.model_id', $id)
            ->get();

        return response()->json(['roleWisePermissionList' => $roleWisePermissionList], 200);
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


    public function change($id)
    {


        $data = 'http://v2.bidyaan.com/';
        return view('backend.school_view', compact('data'));
    }
}
