<?php

namespace App\Http\Controllers;

use App\Employees;
use App\Companies;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use View;
use Exception;
class EmployeesController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employees.employee');
    }
    public function getallemployees()
    {
      $employees = Employees::orderBy('employees.id', 'employees.desc')->leftJoin('companies', 'employees.company', '=', 'companies.id')->select('employees.*','companies.name as c_name');
      return Datatables::of($employees)
        //  ->setRowAttr(['align' => 'center'])
      ->addColumn('company', function ($employees) {
           return $employees->c_name;
        })
        ->addColumn('created_at', function ($employees) {
           return $employees->created_at->diffForHumans();
        })
        ->addColumn('action', 'employees.action')->make(true);
        
     }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Companies::all();
        $view = View::make('employees.create', compact('companies'))->render();
        return response()->json(['html' => $view]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    $validator = Validator::make($request->all(), [
        'first_name' => 'required',
        'last_name' => 'required',
        'company' => 'required',
        'phone' => 'required|min:10|numeric',
        'email' => 'required|email',
    ]);


    if ($validator->passes()) {
      
          $employees = new Employees;

          $employees->first_name = $request->first_name;
          $employees->last_name = $request->last_name;
          $employees->company = $request->company;
          $employees->phone =  $request->phone;
          $employees->email = $request->email;

          //$employees->save(); //
            try
            {
                $employees->save(); 
                return response()->json(['html' => 'Successfully Inserted']);
            }
            catch(Exception $e)
            {
                return response()->json(['error'=>$e->getMessage()]);
               //dd($e->getMessage());
            }
          
        }
    
      return response()->json(['error'=>implode('<br>',$validator->errors()->all())]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    // $view = view("ajaxView",compact('title'))->render();
     $employees = Employees::find($id);
     $view = View::make('employees.view', compact('employees'))->render();
     return response()->json(['html' => $view]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    $employees = Employees::find($id);
      // $view = view("ajaxView",compact('title'))->render();
    $companies = Companies::all(); 
      $view = View::make('employees/edit', compact('employees'),compact('companies'))->render();

      return response()->json(['html' => $view]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $validator = Validator::make($request->all(), [
        'first_name' => 'required',
        'last_name' => 'required',
        'company' => 'required',
        'phone' => 'required|min:10|numeric',
        'email' => 'required|email'
    ]);
    if ($validator->passes()) {
        $employees = Employees::find($id);
        $employees->first_name = $request->first_name;
        $employees->last_name = $request->last_name;
        $employees->company = $request->company;
        $employees->phone =  $request->phone;
        $employees->email = $request->email;

        $employees->save(); //
        return response()->json(['html' => 'Successfully Updated']);
    }
    return response()->json(['error'=>implode('<br>',$validator->errors()->all())]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $employees=Employees::where('id',$id)->delete();
        if($employees){
            return response()->json(['type' => 'success', 'message' => 'Successfully Deleted']);
       }
    }
}
