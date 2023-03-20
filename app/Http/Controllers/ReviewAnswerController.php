<?php

namespace App\Http\Controllers;

use App\Events\NewReview;
use App\Events\NewReviewAnswer;
use App\Models\Review;
use App\Models\ReviewAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewAnswerController extends Controller
{
    public function answers(Request $request){
        return ReviewAnswer::orderBy('created_at', 'DESC')->get();
    }

    public function review(){
        return $this->belongsTo('App\Models\Review');
    }

    public function newReviewAnswer(Request $request){
        $newReviewAnswer = new ReviewAnswer;
        $newReviewAnswer->review_id = $request->review['id'];
        $newReviewAnswer->message = $request->reviewAnswer;
        $newReviewAnswer->save();

        broadcast(new NewReviewAnswer($newReviewAnswer))->toOthers();

        return $newReviewAnswer;
    }
}
