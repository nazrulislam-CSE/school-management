<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory; 
use Session;


class FeeCategoryController extends Controller
{
    /* ================= Start ViewFeeCat Method ================= */
    public function ViewFeeCat(){
        $data['allData'] = FeeCategory::all();
        return view('backend.setup.fee_category.view_fee_cat',$data);
 
    }
    /* ================= End ViewFeeCat Method ================= */ 

    /* ================= Start FeeCatAdd Method ================= */
    public function FeeCatAdd(){
        return view('backend.setup.fee_category.add_fee_cat');
    }
    /* ================= End FeeCatAdd Method ================= */

    /* ================= Start FeeCatStore Method ================= */
    public function FeeCatStore(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|unique:fee_categories,name',
            
        ]);

        $data = new FeeCategory();
        $data->name = $request->name;
        $data->save();

        Session::flash('success','Fee Category Inserted Successfully');
        return redirect()->route('fee.category.view');

    }
    /* ================= End FeeCatStore Method ================= */ 

    /* ================= Start FeeCatEdit Method ================= */
    public function FeeCatEdit($id){
        $editData = FeeCategory::find($id);
        return view('backend.setup.fee_category.edit_fee_cat',compact('editData'));

    }
    /* ================= End FeeCatEdit Method ================= */

    /* ================= Start FeeCategoryUpdate Method ================= */
    public function FeeCategoryUpdate(Request $request,$id){

        $data = FeeCategory::find($id);
     
        $validatedData = $request->validate([
            'name' => 'required|unique:fee_categories,name,'.$data->id
            
        ]);

        
        $data->name = $request->name;
        $data->save();

        Session::flash('success','Fee Category Updated Successfully');
        return redirect()->route('fee.category.view');
    }
    /* ================= End FeeCategoryUpdate Method ================= */

    /* ================= Start FeeCategoryDelete Method ================= */
    public function FeeCategoryDelete($id){
        $user = FeeCategory::find($id);
        $user->delete();

        Session::flash('error','Fee Category Deleted Successfully');
        return redirect()->route('fee.category.view');

    }
    /* ================= Start FeeCategoryDelete Method ================= */
}
