<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Term;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    public function list(Request $request,$id=''){
        $mark ='';
        if($id){
            $mark = Mark::where('id',$request->id)->first();
        }

        $students = Student::take(3)->get();
        $terms = Term::take(3)->get();
        $subjects = Subject::take(3)->get();
        $marks = Mark::all();
        return view('admin.showMarks')->with(['marks'=>$marks,'mark'=>$mark,'students'=>$students,'terms'=>$terms,'subjects'=>$subjects]);
    }
    public function save(Request $request){
        try {
            if($request->id){
                $mark = Mark::find($request->id);
            }else{
                Mark::where('student',$request->student)->where('term',$request->term)->delete();
                $mark = new Mark;
            }
            if(isset($request->student) && isset($request->term) ){
                $mark->student = $request->student;
                $mark->term  = $request->term;
                $mark->mark  = json_encode($request->mark);
                $mark->created_at  = date('Y-m-d h:i:s');
                // print_R($data);exit;
                if($mark->save()){
                    if($request->id){
                        return redirect('admin/marks')->with('message', 'Marks updated successfully');
                    }
                    return redirect()->back()->with('message', 'Marks added successfully');
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
