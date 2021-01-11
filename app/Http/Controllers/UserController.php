<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{
    public function __construct()
    {
    }
    public function index(){
        return view('user_display');
            }
            
        }
