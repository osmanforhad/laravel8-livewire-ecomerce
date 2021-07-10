<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserChangePasswordComponent extends Component
{
    public $current_password;
    public $password;
    public $password_confirmation;


    //livewire hook function for validation
    public function validationSetup($fields)
    {
        $this->validateOnly($fields, [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed|different:current_password',
        ]);
    }

    //function for change password
    public function changePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed|different:current_password',
        ]);

        if (Hash::check($this->current_password, Auth::user()->password)) {

            //fetch user
            $user = User::findOrFail(Auth::user()->id);

            $user->password = Hash::make($this->password);

            $user->save();

            session()->flash('password_success', 'Password changes has been successfull!');
        }
        else {
            session()->flash('password_error', 'Password does not match!');
        }
    }

    public function render()
    {
        return view('livewire.user.user-change-password-component')->layout('layouts.base');
    }
}
