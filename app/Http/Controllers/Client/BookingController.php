<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\CreateBookingRequest;
use App\Models\Bookings;
use App\Models\Servieces;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //
    protected $serviece;
    protected $booking;

    public function __construct(Servieces $serviece, Bookings $booking)
    {
        $this->serviece = $serviece;
        $this->booking = $booking;
    }
    public function index(){
        $bookings = $this->booking
            ->where('user_id', auth()->user()->id)
            ->latest('id')
            ->paginate(5);

        return view('client.booking.index', compact('bookings'));
    }
    public function create(){
        $servieces = $this->serviece->where('status','active')->get();
        $time = ['9:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00'];
        return view('client.booking.add',compact('servieces','time'));
    }
    public function store(CreateBookingRequest $request){
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $this->booking->create($data);
        return to_route('user.booking.index')->with('success','Đặt lịch thành công');
    }
    public function show(string $id)
    {
        $booking = $this->booking->findOrfail($id);
        return view('client.booking.show',compact('booking'));
    }
    public function update(Request $request){
        $booking = $this->booking->findOrfail($request->id);
        $booking->update(['status'=> 'cancel']);
        return to_route('user.booking.show',['id'=> $request->id ])->with(['success' => 'Bạn đã hủy lịch đặt thành công']);
    }
}
