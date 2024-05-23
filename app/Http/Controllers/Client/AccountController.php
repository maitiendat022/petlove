<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\ChangePasswordRequest;
use App\Http\Requests\Account\UpdateAccountRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index(){
        $user = $this->user->findOrfail(auth()->user()->id);
        return view('client.user.account',compact('user'));
    }
    public function changePassword(ChangePasswordRequest $request){
        $user = $this->user->findOrfail(auth()->user()->id);
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Mật khẩu cũ không chính xác']);
        }
        $password = Hash::make($request->new_password);
        $user->update(['password' => $password]);
        return back()->with(['success' => 'Đổi mật khẩu thành công']);
    }
    public function update(UpdateAccountRequest $request){
        $user = $this->user->findOrfail(auth()->user()->id);
        $data = $request->all();
        if($request->has('image')){
            if($user->images()->first()){
                $curentImage = $user->images()->first()->url;
                $data['image'] = $this->user->uploadImage($request, $curentImage);
                $user->images()->update(['url'=>$data['image']]);
            }else{
                $data['image'] = $this->user->saveImage($request);
                $user->images()->create(['url'=>$data['image']]);
            }
        }
        $user->update($data);
        return back()->with(['success' => 'Cập nhật thông tin tài khoản thành công']);
    }
}
