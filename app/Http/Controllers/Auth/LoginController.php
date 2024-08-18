<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('Admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('Camp')) {
            return redirect()->route('camp.dashboard');
        } elseif ($user->hasRole('Sales Supervisor')) {
            return redirect()->route('sales.dashboard');
        } elseif ($user->hasRole('Accounts')) {
            return redirect()->route('accounts.dashboard');
        } elseif ($user->hasRole('Staff')) {
            return redirect()->route('staff.dashboard');
        } elseif ($user->hasRole('Kitchen')) {
            return redirect()->route('kitchen.dashboard');
        }

        // If the user doesn't have any of the expected roles, throw an error
        throw new AuthenticationException('Unauthorized: Your account does not have the appropriate role.');
    }
}
