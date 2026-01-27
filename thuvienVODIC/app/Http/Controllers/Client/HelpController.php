<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;

class HelpController extends Controller
{
    public function guide() {
        return view('client.help.guide');
    }
    public function contact() {
        return view('client.help.contact');
    }
}