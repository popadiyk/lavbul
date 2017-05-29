<?php

namespace App\Http\Controllers;

use App\User;
use App\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FeedbacksController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all();
        //$feedbacks =
        return view('feedbacks_page', ['feedbacks' => $feedbacks]);
    }
}