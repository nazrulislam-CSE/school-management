<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AssignStudent;
use App\Models\User;
use App\Models\DiscountStudent;

use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use DB;
use PDF;

use App\Models\Designation;
use App\Models\EmployeeSallaryLog;
use Session;

class EmployeeSalaryController extends Controller
{
    /* ================= Start SalaryView Method ================= */
    public function SalaryView(){
        $data['allData'] = User::where('usertype','employee')->get();
        return view('backend.employee.employee_salary.employee_salary_view',$data);
    }
    /* ================= End SalaryView Method ================= */

    /* ================= Start SalaryIncrement Method ================= */
    public function SalaryIncrement($id){
        $data['editData'] = User::find($id);
        return view('backend.employee.employee_salary.employee_salary_increment',$data);

    }
    /* ================= End SalaryIncrement Method ================= */

    /* ================= Start SalaryStore Method ================= */
    public function SalaryStore(Request $request, $id){

        $user = User::find($id);
        $previous_salary = $user->salary;
        $present_salary = (float)$previous_salary+(float)$request->increment_salary; 
        $user->salary = $present_salary;
        $user->save();

        $salaryData = new EmployeeSallaryLog();
        $salaryData->employee_id = $id;
        $salaryData->previous_salary = $previous_salary;
        $salaryData->increment_salary = $request->increment_salary;
        $salaryData->present_salary = $present_salary;
        $salaryData->effected_salary = date('Y-m-d',strtotime($request->effected_salary));
        $salaryData->save();


        Session::flash('success','Employee Salary Increment Successfully');
        return redirect()->route('employee.salary.view');

    }
    /* ================= End SalaryStore Method ================= */


    /* ================= End SalaryStore Method ================= */
    public function SalaryDetails($id){
        $data['details'] = User::find($id);
        $data['salary_log'] = EmployeeSallaryLog::where('employee_id',$data['details']->id)->get();
        //dd($data['salary_log']->toArray());
        return view('backend.employee.employee_salary.employee_salary_details',$data);

    }
    
    /* ================= End SalaryStore Method ================= */


}
