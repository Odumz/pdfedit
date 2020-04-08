<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TicketStatusController extends Controller
{
    public function getTicketStatus(Request $request, $name = null)
    {
        $property = Helper::getRequest('properties/v1/contacts/properties?hapikey=');
        return $property;
        // Log::debug($name);
        // Mail::raw('plain text message', function ($message) use ($name) {
        //     $message->from('john@johndoe.com', $name);
        //     $message->to('john@johndoe.com', 'John Doe');
        //     $message->subject('My name is '.$name);
        // });
    }
}
