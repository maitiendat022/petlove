<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reviews\FeedbackRequest;
use App\Models\Reviews;

class ReviewsController extends Controller
{
    //
    protected $review;

    public function __construct(Reviews $review)
    {
        $this->review = $review;
    }
    public function index()
    {
        $query = $this->review->whereNotNull('rating');
        $rating = request()->rating;
        $status = request()->status;
        if($rating){
            $query = $query->where('rating', $rating);
        }
        if($status){
            if($status == 'review'){
                $query = $query->whereNull('feedback');
            }else{
                $query = $query->whereNotNull('feedback');
            }
        }
        $reviews = $query->latest()->paginate(4);
        return view('admin.reviews.index',compact('reviews','rating','status'));
    }
    public function show(string $id){
        $review = $this->review->findOrfail($id);
        return view('admin.reviews.show',compact('review'));
    }
    public function feedback(FeedbackRequest $request){
        $review = $this->review->findOrfail($request->id);
        $data = $request->all();
        $review->update($data);
        return to_route('reviews.index')->with('success','Phản hồi đánh giá thành công');
    }
}
