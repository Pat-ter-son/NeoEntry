<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SupportController extends Controller
{
   public function vue()
   {
     
      return view('Support');
   }
}
