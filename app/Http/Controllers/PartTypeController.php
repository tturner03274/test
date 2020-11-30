<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartTypeController extends Controller
{
    public function index(Request $request)
    {
        // Handle searching by SQL LIKE
        $name = $request->get('name');

        $part_types = \App\PartType::when($name, function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })->where('predefined', true)->get();

        return $part_types;
    }
}
