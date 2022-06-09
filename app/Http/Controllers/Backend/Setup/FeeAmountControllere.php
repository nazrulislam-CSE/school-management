<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory;
use App\Models\StudentClass; 
use App\Models\FeeCategoryAmount;
use Session;

class FeeAmountControllere extends Controller
{
    /* ================= Start FeeCategoryUpdate Method ================= */
    public function ViewFeeAmount(){
        // $data['allData'] = FeeCategoryAmount::all();
        $data['allData'] = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.fee_amount.view_fee_amount',$data);
    }
    /* ================= End FeeCategoryUpdate Method ================= */

    /* ================= Start AddFeeAmount Method ================= */
    public function AddFeeAmount(){
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.add_fee_amount',$data);
    }
    /* ================= End AddFeeAmount Method ================= */

    /* ================= Start StoreFeeAmount Method ================= */
    public function StoreFeeAmount(Request $request){

        $countClass = count($request->class_id);
        if ($countClass != NULL) {
            for ($i=0; $i < $countClass ; $i++) { 
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();

            } // End For Loop
        }// End If Condition 

        Session::flash('success','Fee Amount Inserted Successfully');
        return redirect()->route('fee.amount.view');

    }  // End Method 
    /* ================= End StoreFeeAmount Method ================= */

    /* ================= Start EditFeeAmount Method ================= */
    public function EditFeeAmount($fee_category_id){
        $data['editData'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        // dd($data['editData']->toArray());
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.edit_fee_amount',$data);

    }
    /* ================= End EditFeeAmount Method ================= */

    /* ================= Start EditFeeAmount Method ================= */
    public function UpdateFeeAmount(Request $request,$fee_category_id){

        if ($request->class_id == NULL) {

        Session::flash('warning','Sorry You do not select any class amount');
        return redirect()->route('fee.amount.edit',$fee_category_id);
             
        }else{
             
            $countClass = count($request->class_id);
            FeeCategoryAmount::where('fee_category_id',$fee_category_id)->delete(); 
            for ($i=0; $i <$countClass ; $i++) { 
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();

            } // End For Loop    

        }// end Else

        Session::flash('success','Data Updated Successfully');
        return redirect()->route('fee.amount.view');
    } // end Method
    /* ================= Start EditFeeAmount Method ================= */ 

    /* ================= Start DetailsFeeAmount Method ================= */ 
    public function DetailsFeeAmount($fee_category_id){
        $data['detailsData'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();

        return view('backend.setup.fee_amount.details_fee_amount',$data);
    }
    /* ================= End DetailsFeeAmount Method ================= */ 

}
