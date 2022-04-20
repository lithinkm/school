<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function showDashboard(Request $request){
        return view('admin.viewDashboard');
    }
    public function list(Request $request,$id=''){
        $student ='';
        if($id){
            $student = Student::where('id',$request->id)->first();
        }
        $students  = Student::paginate();
        $teachers  = Teacher::take(3)->get();
        return view('admin.showStudents')->with(['students' => $students,'student'=>$student,'teachers'=>$teachers]);
    }
    public function save(Request $request){
        try {
            if($request->id){
                $student = Student::find($request->id);
            }else{
                $student = new Student();
                $student->code = time() . rand(111, 999);
            }
            if(isset($request->name) && isset($request->age) && isset($request->gender) && isset($request->teacher)){
                $student->name = $request->name;
                $student->age = $request->age;
                $student->gender = $request->gender;
                $student->teacher = $request->teacher;
                if($student->save()){
                    if($request->id){
                        return redirect('admin/students')->with('message', 'Student details updated successfully');
                    }
                    return redirect()->back()->with('message', 'Student added successfully');
                }else{
                    return redirect()->back()->with('message', 'Something went wrong');
                }
            }else{
                return redirect()->back()->with('message', 'Please fill all the fields');
            }
        } catch (\Exception  $e) {
            // print_R($e->getMessage()); exit;
            return redirect()->back()->with('message', 'Something went wrong.');
        }

    }
    public function delete($id){
        try {
            $student = Student::find($id);
            $student->delete();
            return redirect()->back()->with('message', 'Student deleted successfully');
        } catch (\Exception  $e) {
            // print_R($e->getMessage());exit;
            return redirect()->back()->with('message', 'Could not delete');
        }

    }
}
