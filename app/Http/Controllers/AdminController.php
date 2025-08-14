<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function forwardToElectionsIndex() {
        return redirect()->route('admin-elections-index');
    }
}