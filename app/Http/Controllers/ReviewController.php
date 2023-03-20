<?php

namespace App\Http\Controllers;

use App\Events\NewReview;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function reviews(Request $request){
        return Review::orderBy('created_at', 'DESC')->paginate(10);
    }

    public function reviewAnswer (){
        return $this->belongsTo('App\Models\ReviewAnswer');
    }

    public function newReview (Request $request){
        $newReview = new Review;
        $newReview->user_id = Auth::id();
        $newReview->message = $request->review;
        $newReview->save();

        broadcast(new NewReview($newReview))->toOthers();

        return $newReview;
    }
}
