<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{

    public function addToFavourites(Chirp $chirp): RedirectResponse
   {
        $favourites = session('favourites', collect([]));
        $favourites->push($chirp);
        session(['favourites' => $favourites]);
        return redirect(route('chirps.index'));
   }

   public function removeFromFavourites(Chirp $chirp): RedirectResponse
   {
        $favourites = session('favourites', collect([]));
        $favourites->forget($chirp);
        session(['favourites' => $favourites]);
        return redirect(route('chirps.favourites'));
   }

    public function confirms(): RedirectResponse
    {
        $favourites = session('favourites', collect([]));
        $favourites = [];
        session(['favourites' => $favourites]);
        return redirect(route('chirps.index'));
    }

   /**
    * Show the Chirps in Favourites
    */
    public function favourites(): View
    {
         $favourites = session('favourites', collect([]));
         return view('chirps.favourites', [
 
               'chirps' => $favourites,
 
         ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
   {
        return view('chirps.index', [
            'chirps' => Chirp::with('user')->latest()->get(),
        ]);
   }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
   {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $request->user()->chirps()->create($validated);
 
        return redirect(route('chirps.index'));
   }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        //
    }
}
