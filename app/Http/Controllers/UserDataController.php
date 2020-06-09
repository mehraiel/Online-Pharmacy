<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\UserData;
use Illuminate\support\facades\url;
use Illuminate\support\facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class UserDataController extends Controller
{
   public function InsertTodbb()
    {
        $products = DB::select('select * from users');
        return view('AdminPages.UserDetails',['products'=>$products]);
    }
    
     public function deletes($id)
    {
        DB::delete('delete from users where id = ?',[$id]);
        return redirect('AdminPages.UserDetails')->with('success','datadelete');
    }


    public function indexeee()
    {
      $UserData = $UserData::all()->toArray();
      return view ('UserPages.retrieve',compact('UserData')) ;
       
    }

    public function storees (Request $request)
    { $UserData = new UserData();
    $validatedData = $request->validate([
        'User_name' => 'required',
        'Address' => 'required',
        'Mobile' => 'required|numeric'

    ]);
    $UserData->save();

    
    UserData::create($request->all());

      return redirect()->route('UserPages.retrieve')->with('success','User Added');

    }

    public function edit($id)
    {
      $UserData = UserData::find($id);
      return view('UserPages.edit',compact('UserData','id'));

    }


    

    
    public function update(Request $request ,$id)
    {
      $this->validate($request ,[
        'User_name' => 'required',
        'Address' => 'required',
        'Mobile' => 'required|numeric'
      ]);

      $UserData = $UserData::find($id);
      $UserData -> User_name = $request->get('User_name');
      $UserData -> Address = $request->get('Address');
      $UserData -> Mobile = $request->get('Mobile');
      $UserData->save();
      
      return redirect()->route('UserPages.retrieve')->with('success','information updated');

    }

    public function destroy($id)
    {
      $UserData = $UserData::find($id); 
      $UserData->delete(); 
      return redirect()->route('UserPages.retrieve')->with('success','Your Information Deleted');


    }



}
