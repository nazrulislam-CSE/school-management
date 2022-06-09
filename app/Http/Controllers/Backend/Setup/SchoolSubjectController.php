<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolSubject;
use Session;

class SchoolSubjectController extends Controller
{
    /* ================= Start ViewExamType Method ================= */
    public function ViewSubject(){
        $data['allData'] = SchoolSubject::all();
        return view('backend.setup.school_subject.view_school_subject',$data);
 
    }
    /* ================= End ViewExamType Method ================= */

    /* ================= Start SubjectAdd Method ================= */
    public function SubjectAdd(){
        return view('backend.setup.school_subject.add_school_subject');
    }
    /* ================= End SubjectAdd Method ================= */

    /* ================= Start SubjectStore Method ================= */
    public function SubjectStore(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|unique:school_subjects,name',
            
        ]);

        $data = new SchoolSubject();
        $data->name = $request->name;
        $data->save();

        Session::flash('success','Subject Inserted Successfully');
        return redirect()->route('school.subject.view');

    }

    /* ================= End SubjectStore Method ================= */

    /* ================= Start SubjectEdit Method ================= */
    public function SubjectEdit($id){
        $editData = SchoolSubject::find($id);
            return view('backend.setup.school_subject.edit_school_subject',compact('editData'));
        }
    /* ================= End SubjectEdit Method ================= */

    /* ================= Start SubjectUpdate Method ================= */
    public function SubjectUpdate(Request $request,$id){

        $data = SchoolSubject::find($id);
     
        $validatedData = $request->validate([
            'name' => 'required|unique:school_subjects,name,'.$data->id
                
        ]);

        $data->name = $request->name;
        $data->save();

        Session::flash('success','Subject Updated Successfully');
        return redirect()->route('school.subject.view');
    }
    /* ================= End SubjectUpdate Method ================= */
    /* ================= Start SubjectDelete Method ================= */
    public function SubjectDelete($id){
        $user = SchoolSubject::find($id);
        $user->delete();

        Session::flash('error','Subject Deleted Successfully');
        return redirect()->route('school.subject.view');

    }
    /* ================= End SubjectDelete Method ================= */
}
