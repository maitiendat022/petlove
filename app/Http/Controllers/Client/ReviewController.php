<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reviews\CreateReviewRequest;
use App\Models\Reviews;

class ReviewController extends Controller
{
    protected $review;

    public function __construct(Reviews $review)
    {
        $this->review = $review;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = $this->review
            ->whereNull('rating')
            ->where('user_id', auth()->user()->id)
            ->latest('id')
            ->paginate(5);

        return view('client.review.index',compact('reviews'));
    }
    public function reviewed()
    {
        $rating = request()->rating;

        $query = $this->review
            ->whereNotNull('rating')
            ->where('user_id', auth()->user()->id)
            ->latest('id');
        if($rating){
            $query->where('rating',$rating);
        }
        $reviewed = $query->paginate(3);
        return view('client.review.reviewed',compact('reviewed','rating'));
    }
    public function create(string $id)
    {
        $review = $this->review->findOrfail($id);
        return view('client.review.create',compact('review'));
    }
    public function store(CreateReviewRequest $request)
    {
        $review = $this->review->findOrfail($request->id);
        $data = $request->all();
        $data['created_at'] = now();
        if($request->has('image')){
            $data['image'] = $this->review->saveImage($request);
        }
        $review->created_at = now();
        $review->update($data);
        return to_route('user.review.reviewed')->with('success','Đánh giá sản phẩm thành công');
    }
}
