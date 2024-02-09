<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AddressController extends Controller
{
    public function index() {
        $user = auth()->user();
        $proTypes = ProductType::orderBy('name','ASC')->get();
        $addresses = Address::orderBy('id','ASC')->where('user_id', $user->id)->get();
        $address_count = Address::where('user_id', $user->id)->count();
        return view('account.address.index', compact('proTypes','addresses','address_count'));
    }

    public function add_address() {
        $proTypes = ProductType::orderBy('name','ASC')->get();
        $auth = auth()->user();
        return view('account.address.create', compact('auth','proTypes'));
    }

    public function check_add_address(Request $request) {
        $user = auth()->user();
        $request->validate([
            'receiver_name' => 'required',
            'address'=> 'required',
            'phone' => 'required',
            'password_confirm' => ['required', function($att, $value, $fail) use($user) {
                if (!Hash::check($value, $user->password)) {
                    return $fail('Your password is incorrect');
                }
            }],
        ]);
        $data = $request->only('receiver_name','address','phone');
        $data['user_id'] = $user->id;
        $check = Address::create($data);
        if ($check) {
            return redirect()->route('account.address');
        }
        return redirect()->back();
    }

    public function delete_address(Address $address) {
        $user = auth()->user();
        $data = Address::where([
            'id' => $address->id,
            'user_id' => $user->id
        ])->delete();

        if($data) {
            return redirect()->route('account.address');
        }
    }

    public function delete_all_address() {
        $user = auth()->user();
        $data = Address::where('user_id', $user->id);
        if($data->delete()) {
            return redirect()->route('account.address');
        }
    }

    public function edit_address(Address $address) {
        $proTypes = ProductType::orderBy('name','ASC')->get();
        $auth = auth()->user();
        $address = Address::where([
            'id' => $address->id,
            'user_id' => $auth->id
        ])->first();
        return view('account.address.edit', compact('proTypes','auth','address'));
    }

    public function check_edit_address(Request $request, Address $address) {
        $user = auth()->user();
        $request->validate([
            'receiver_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'password_confirm' => ['required', function($attr, $value, $fail) use($user) {
                if(!Hash::check($value, $user->password)) {
                    return $fail('Your password is incorrect');
                }
            }],
        ]);
        $data = $request->only('receiver_name','address','phone');
        $check = Address::where([
            'id' => $address->id,
            'user_id' => $user->id
        ])->update($data);
        if($check) {
            return redirect()->route('account.address');
        }
    }
}
