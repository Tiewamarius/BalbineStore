<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function compte(Request $request): View
    {
        $user = $request->user();

        // Panier actif
        $cartItems = $user->activeCart
            ? $user->activeCart->items()->with('product.images')->get()
            : collect();

        // Commandes de l'utilisateur
        $orders = $user->orders()->latest()->get();

        // Wishlist
        $wishlist = $user->wishlist
            ? $user->wishlist->products()->with('images')->get()
            : collect();

        // Adresses de livraison
        $addresses = $user->addresses()->get();

        return view('compte', compact(
            'user',
            'cartItems',
            'orders',
            'wishlist',
            'addresses'
        ));
    }




    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
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
