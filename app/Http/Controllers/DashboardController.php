<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public $pageTitle = 'Dashboard';

    public function index()
    {
        return view('index', 
            [
                'pageTitle' => $this->pageTitle
            ]);
    }

}
