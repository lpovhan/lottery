<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function view(ProfileRequest $request): Response
    {
        if  ($request->user === null) {
            session()->flash('status', '');
            return Inertia::render('Welcome', [
                'status' => session('status')
            ]);
        }
        auth()->login($request->user);
        return Inertia::render('Dashboard', [
            'status' => session('status'),
        ]);
    }

    public function new_link(Request $request): JsonResponse
    {
        $code = $this->service->getNewLink(auth()->user());

        return response()->json([
            'url' => route('dashboard', ['link' => $code], false)
        ]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
