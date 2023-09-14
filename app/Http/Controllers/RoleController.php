<?php

namespace App\Http\Controllers;

use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Events\QueryExecuted;

class RoleController extends Controller
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
        if (is_null($this->user) || !$this->user->can('role.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view !');
        }

        $user_role = role::where('guard_name','web')->get();
        return view('backend.administrator.user_role',compact('user_role'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {

        if (is_null($this->user) || !$this->user->can('role.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view !');
        }
        //  return $request->all();
        $validate_data = $this->_userRoleValidation();
        
        $validator = Validator::make($request->all(), $validate_data);

        if ($validator->fails()) {
            return redirect('/user-role')->withErrors($validator)->withInput();
        }
 
            try{

                $data = $this->_getUserRoleData($request);

                $insert = role::create($data);
               
                if($insert){
                    flash()->addSuccess("insert Success");
                }else{
                    flash()->addError("Opps! Something is wrong.");
                }

                // return redirect()->route('user_role');
                return redirect()->back();

            }catch(QueryException $e){

                flash()->addError($e->errorInfo[2]);

            }
        

    }

    private function _userRoleValidation()  {
       return [
            'name' => 'required|unique:roles|max:255',
        ];
    }

    private function _getUserRoleData($request)  {

        $data['name'] = strtolower($request->name);
        $data['guard_name'] = 'web';

        if ($request->id) {

            // $data['updated_by'] = Auth::user()->id;

            $data['updated_at'] = date('Y-m-d H:i:s');

        } else {

            // $data['created_by'] = Auth::user()->id;

            $data['created_at'] = date('Y-m-d H:i:s');

        }

        return $data;
    }

    
    public function show(role $role)
    {
        //
    }

    
    public function editRole($id)
    {

        echo $id;
        exit();

    }

    
    public function update(Request $request, role $role)
    {
        //
    }

    
    public function destroy(role $role)
    {
        if (is_null($this->user) || !$this->user->can('role.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to view !');
        }
      echo"Ok";
    }
}
