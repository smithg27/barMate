<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class APIController extends Controller
{
    public function index () {
        $item = \App\Inventory::find(22);
        return response()->json([
            $item,
            'page' => 'home',
            'options' => 'view drinks, add drinks, view inventory']);
    }
}
