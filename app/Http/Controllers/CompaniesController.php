<?php

namespace App\Http\Controllers;

use App\Companies;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use View;
class CompaniesController extends Controller
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
        return view('companies.company');
    }
    public function getall()
    {
      $companies = Companies::orderBy('id', 'desc');
      return Datatables::of($companies)
        //  ->setRowAttr(['align' => 'center'])
        ->addColumn('created_at', function ($companies) {
           return $companies->created_at->diffForHumans();
        })
        ->addColumn('action', 'companies.action')->make(true);
        
     }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = View::make('companies.create')->render();
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
        'name' => 'required',
        'email' => 'required|email',
        'logo' => 'required|dimensions:min_width=100,min_height=100'
    ]);


    if ($validator->passes()) {
      if($files=$request->file('logo')){  
          //$logo=$files->getClientOriginalName();
        $ext = '.'.$request->logo->getClientOriginalExtension();
        $logo = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->logo->getClientOriginalName()); 
        $files->move(storage_path('app/public/'),$logo);
        if($logo){
          $companies = new Companies;

          $companies->name = $request->name;
          $companies->email = $request->email;
          $companies->logo = $logo;

          $companies->save(); //
          return response()->json(['html' => 'Successfully Inserted']);
        }
        else{
          return response()->json(['html' => 'Logo not uploading']);
        }
      }
      else{
          return response()->json(['html' => 'Plese select logo']);
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
        //
     // $companies = Companies::where('id',$contact->id);

     // $view = view("ajaxView",compact('title'))->render();
     $companies = Companies::find($id);
     $view = View::make('companies.view', compact('companies'))->render();

     return response()->json(['html' => $view]);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Companies $companies
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
 
        $companies = Companies::find($id);
      // $view = view("ajaxView",compact('title'))->render();

      $view = View::make('companies/edit', compact('companies'))->render();

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
          //
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'logo' => 'required|dimensions:min_width=100,min_height=100'
    ]);
    if ($validator->passes()) {
      if($files=$request->file('logo')){  
        $logo=$files->getClientOriginalName();  
        $files->move(storage_path('app/public/'),$logo);
        }
        else{
        $logo = $request->hidden_image; 
        }
        if($logo){
        $companies = Companies::find($id);
        $companies->name = $request->name;
        $companies->email = $request->email;
        $companies->logo = $logo;

        $companies->save(); //
        return response()->json(['html' => 'Successfully Updated']);
      }
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
        $Companies=Companies::where('id',$id)->delete();
        if($Companies){
            return response()->json(['type' => 'success', 'message' => 'Successfully Deleted']);
       }

    }
}
