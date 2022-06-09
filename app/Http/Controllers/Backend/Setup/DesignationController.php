<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation; 
use Session;

class DesignationController extends Controller
{
    /* ================= Start ViewDesignation Method ================= */
    public function ViewDesignation(){
        $data['allData'] = Designation::all();
        return view('backend.setup.designation.view_designation',$data);
 
    }
    /* ================= End ViewDesignation Method ================= */

    /* ================= Start DesignationAdd Method ================= */
    public function DesignationAdd(){
        return view('backend.setup.designation.add_designation');
    }
    /* ================= End DesignationAdd Method ================= */

    /* ================= Start DesignationStore Method ================= */
    public function DesignationStore(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|unique:designations,name',
            
        ]);

        $data = new Designation();
        $data->name = $request->name;
        $data->save();

        Session::flash('success','Designation Inserted Successfully');
        return redirect()->route('designation.view');

    }
    /* ================= End DesignationStore Method ================= */

    /* ================= Start DesignationEdit Method ================= */
    public function DesignationEdit($id){
        $editData = Designation::find($id);
        return view('backend.setup.designation.edit_designation',compact('editData'));
    }
    /* ================= End DesignationEdit Method ================= */

    /* ================= Start DesignationEdit Method ================= */
    public function DesignationUpdate(Request $request,$id){

        $data = Designation::find($id);
     
        $validatedData = $request->validate([
            'name' => 'required|unique:designations,name,'.$data->id
            
        ]);

        
        $data->name = $request->name;
        $data->save();

        Session::flash('success','Designation Updated Successfully');
        return redirect()->route('designation.view');
    }
    /* ================= Start DesignationEdit Method ================= */

    /* ================= Start DesignationDelete Method ================= */
    public function DesignationDelete($id){

        $user = Designation::find($id);
        $user->delete();

       
        Session::flash('error','Designation Deleted Successfully');
        return redirect()->route('designation.view');

    }
    /* ================= End DesignationDelete Method ================= */

}
