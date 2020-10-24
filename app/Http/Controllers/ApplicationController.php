<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ApplicationController extends Controller
{
    public function index()
    {
        return Inertia::render('Index');
    }

    public function subFolder($id)
    {
        return Inertia::render('SubFolder', ['id' => $id]);
    }
}
