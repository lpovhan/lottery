<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class AuthController extends Controller
{
    public function __construct(UserService $service)
    {
        parent::__construct($service);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(RegisterRequest $request): Response
    {
        $user = $this->service->storeUser($request->validated());
        auth()->login($user);

        return Inertia::render('Welcome', [
            'user_link' => route('dashboard', ['link' => $user->getLink()]),
            'status' => session('status')
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function deactivate(Request $request): Response
    {
        auth()->logout();
        $request->session()->invalidate();

        return Inertia::render('Welcome', [
            'status' => session('status')
        ]);
    }
}
