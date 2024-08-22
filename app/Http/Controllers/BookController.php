<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        echo "Hello From the Book Controller -> index method";
    }
}
