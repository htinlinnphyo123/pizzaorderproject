<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    public function rating(Request $request){
        $this->validationforrating($request);
        // dd($request->all());

        $data = $this->getRatingData($request);

        Rating::create($data);
        return back()->with(['success'=>'Sent Review Successfully.We will reply to you later']);


    }

    // get rating data
    private function getRatingData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'rating_count' => $request->rating_count,
            'message' => $request->review
        ];
    }

    //validation for rating data
    private function validationforrating($request){
        Validator::make($request->all(),[
            'review' => 'required'
        ])->validate();
    }

}
