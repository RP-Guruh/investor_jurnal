<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Mail;

class PemasukanEmailController extends Controller
{
    public function index(){

        $details = [
        'title' => 'Mail from github.guruh@gmail.com',
        'body' => 'This is for testing email using smtp'
        ];
       
        \Mail::to('worksbrain38@gmail.com')->send(new \App\Mail\MyTestMail($details));
       
        dd("Email sudah terkirim.");
    
        }
}
