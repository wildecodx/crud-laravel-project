<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Usermodel; // you need to use the model in controller to get the data from db

class Usercontroller extends Controller
{


    function adddata (Request $request) {
        $tbl = new Usermodel; // we will use the model

        parse_str($request->input('data'), $formdata);


        // The data accumulate from db
        $tbl->fname=$formdata['fname'];
        $tbl->lname=$formdata['lname'];
        $tbl->username=$formdata['username'];
        $tbl->course=$formdata['course'];
        $tbl->email=$formdata['email'];

        //  Updating clause

        if (empty($formdata['id']) || ($formdata['id'] == "")) {
         // This function would make inserting the data from database
            $tbl->save();
            echo'Added Successfully!';

   
         } else {
            $tbl=Usermodel::find($formdata['id']);
            $tbl->fname=$formdata['fname'];
            $tbl->lname=$formdata['lname'];
            $tbl->username=$formdata['username'];
            $tbl->course=$formdata['course'];
            $tbl->email=$formdata['email'];
    
            $tbl->update();
            echo'Edit Successfully!';
         } 
  


     
    }
// This function would make fetching the data from database
    function getdata() {
        return Usermodel::orderBy('id', 'asc')->get();
    }
// This function would make fetching and able to edit the data from database
    function editdata(Request $request) {
        return userModel::find($request->id);
    }

    function deletedata (Request $request) {
    userModel::where('id', $request->id)->delete();
    echo'Deleted Successfully!';
    }

}
