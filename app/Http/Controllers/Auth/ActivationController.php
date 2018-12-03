<?php

namespace App\Http\Controllers\Auth;

use App\ConfirmationToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['confirmation_token.expired:/']);
    }

    protected $redirectTo = '/';

    public function activate(ConfirmationToken $token)
    {
        $token->user->update([
            'activated' => true
        ]);

        $token->delete();

        return redirect()->intended($this->redirectPath())->withSuccess('Your account has been activated. Please sign in.');
    }

    protected function redirectPath()
    {
        return $this->redirectTo;
    }
}
