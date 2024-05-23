<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bookings;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    //
    protected $booking;
    protected $bookStatus = [
        ['id' => 'unconfirmed','name' => 'Chờ xác nhận'],
        ['id' => 'confirmed','name' => 'Đã xác nhận'],
        ['id' => 'cancel','name' => 'Đã hủy'],
    ];
    public function __construct(Bookings $booking)
    {
        $this->booking = $booking;
    }
    public function index(){
        $status = request()->status;
        $name = request()->name;
        $query = $this->booking->latest('id');

        if($status){
            $query->where('status', $status);
        }
        if($name){
            $query->where('book_phone', 'LIKE', "%$name%");
        }
        $bookings = $query->paginate(7);
        $bookStatus = $this->bookStatus;
        return view('admin.bookings.index', compact('bookings','bookStatus', 'status','name'));
    }
    public function show(string $id){
        $booking = $this->booking->findOrfail($id);
        return view('admin.bookings.show', compact('booking'));
    }
    public function update(Request $request){
        $booking = $this->booking->findOrfail($request->id);
        $booking->update(['status'=> 'confirmed']);
        return to_route('bookings.index')->with(['success' => 'Xác nhận lịch đặt thành công']);
    }
    public function cancel(Request $request){
        $booking = $this->booking->findOrfail($request->id);
        $booking->update(['status'=> 'cancel']);
        return to_route('bookings.index')->with(['success' => 'Hủy lịch đặt thành công']);
    }
}
