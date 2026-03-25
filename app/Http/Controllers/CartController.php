<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Currently returning a static view. 
        // Can be expanded to use Session or Database cart logic.
        return view('cart.index');
    }
}
