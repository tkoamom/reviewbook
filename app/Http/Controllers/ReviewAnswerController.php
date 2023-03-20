<?php

namespace App\Http\Controllers;

use App\Models\ReviewAnswer;
use Illuminate\Http\Request;

class ReviewAnswerController extends Controller
{
    public function answers(Request $request){
        return ReviewAnswer::orderBy('created_at', 'DESC')->get();
    }
}
