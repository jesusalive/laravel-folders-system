<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ApplicationController extends Controller
{
    public function index()
    {
        return Inertia::render('FolderPage', ['id' => 1]);
    }

    public function subFolder($id)
    {
        return Inertia::render('FolderPage', ['id' => $id]);
    }
}
