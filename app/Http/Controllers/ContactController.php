<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function get(Request $request)
    {
        $appId = '215934';
        // $url = '/webhooks/v1/215934/'.$appId.'/subscriptions?';
        // dd($url);
        $contacts = Helper::getRequest('webhooks/v1/'.$appId.'/subscriptions?');
        dd($contacts);
        return $contacts;
        // dd($contacts);
    }

    public function getPayload(Request $request)
    {
        $appId = '215934';
        // $url = '/webhooks/v1/215 934/'.$appId.'/subscriptions?';
        // dd($url);
        $contacts = Helper::getRequest('webhooks/v1/'.$appId.'/subscriptions?');
        dd($contacts);
        return $contacts;
        // dd($contacts);
    }

    public function home(Request $request)
    {
        $request = Helper::getPayloadRequest();
        // dd($request);
        return view('welcome', compact('request'));
    }

    public function getRecentContact(Request $request)
    {
        // $hapikey = 'hapikey=ea03f4e6-88a7-461a-ae96-9ff2ffd97446';
        // $route = 'contacts/v1/lists/all/contacts/recent?'.$hapikey.'&count=1';
        // dd($route);
        // $response = Helper::getPayRequest($route);
        // return $response;

        dd($request);
    }
}
