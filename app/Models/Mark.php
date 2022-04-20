<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;
    public function students(){
        return $this->belongsTo(Student::class,'student');
    }
    public function terms(){
        return $this->belongsTo(Term::class,'term');
    }
    public function subjects(){
        return $this->belongsTo(Subject::class,'subject');
    }
}
