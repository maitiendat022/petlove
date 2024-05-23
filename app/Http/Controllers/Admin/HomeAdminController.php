<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bookings;
use App\Models\Categories;
use App\Models\Orders;
use App\Models\Pets;
use App\Models\Products;
use App\Models\Reviews;
use App\Models\Servieces;
use App\Models\User;
use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    //
    protected $user;
    protected $pet;
    protected $category;
    protected $product;
    protected $serviece;
    protected $order;
    protected $booking;
    protected $review;

    public function __construct(User $user, Pets $pet, Categories $category, Products $product,
        Servieces $serviece, Orders $order, Bookings $booking, Reviews $review)
    {
        $this->user = $user;
        $this->pet = $pet;
        $this->category = $category;
        $this->product = $product;
        $this->serviece = $serviece;
        $this->order = $order;
        $this->booking = $booking;
        $this->review = $review;
    }
    public function index(){
        $home = [
            'user' => $this->user->where('role_id',2)->count(),
            'pet' => $this->pet->count(),
            'category' => $this->category->count(),
            'product' => $this->product->count(),
            'serviece' => $this->serviece->count(),
            'order' => $this->order->count(),
            'booking' => $this->booking->count(),
            'review' => $this->review->whereNotNull('rating')->count(),
        ];

        return view('admin.index',compact('home'));
    }
}
