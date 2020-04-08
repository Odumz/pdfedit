<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Stream;

class Helper {
    public static function getRequest(string $route, $output="json")
    {
        try {
            $apikey = 'hapikey=32fbb1af-094e-4afd-8cf9-22c407569608';
            $client = new Client();
            // $request = $client->get('https://recruitskillapi.herokuapp.com/api/'.$route);
            $url = 'https://api.hubapi.com/'.$route.$apikey;
            // dd($url);
            $request = $client->get('https://api.hubapi.com/'.$route.$apikey);
            $response = $request->getBody()->getContents();
            $project = json_decode($response);
            return $project;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $project = $e->getResponse();
        }
    }

    public static function getPayRequest(string $route, $output="json")
    {
        try {
            // $apikey = 'hapikey=32fbb1af-094e-4afd-8cf9-22c407569608';
            $client = new Client();
            // $request = $client->get('https://recruitskillapi.herokuapp.com/api/'.$route);
            // $url = 'https://api.hubapi.com/'.$route.$apikey;
            // dd($url);
            $request = $client->get('https://api.hubapi.com/'.$route);
            $response = $request->getBody()->getContents();
            $project = json_decode($response);
            return $project;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $project = $e->getResponse();
        }
    }

    public static function getPayloadRequest()
    {
        try {
            $apikey = 'hapikey=32fbb1af-094e-4afd-8cf9-22c407569608';
            $client = new Client();
            // $request = $client->get('https://recruitskillapi.herokuapp.com/api/'.$route);
            // $url = 'https://api.hubapi.com/'.$route.$apikey;
            // dd($url);
            $request = $client->get('https://app.cerebro.work/');
            $response = $request->getBody()->getContents();
            // $project = json_decode($response);
            return $response;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $response = $e->getResponse();
        }
    }

    public static function postRequest(string $route, array $fields, array $post_details = null)
    {

        try {
            $client = new Client();
            $url = 'https://api.hubapi.com/'.$route;

            $response = $client->request('POST', $url, [
                'form_params' => $fields
            ]);

            $final_response = ['status'=>'success', 'Message'=> $post_details["title"]. ' created successfully'];

            return $final_response;


        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $responseJSON = $e->getResponse();
        }
    }

    public static function putRequest(string $route, array $fields, int $id)
    {
        try {
            $client = new Client();
            $url = 'https://api.hubapi.com/'.$route.$id;
            $request = $client->request('PUT', $url, [
                'form_params' => $fields
            ]);
            // $request = $client->post($url, ['form_params' => $fields]);
            // $responseJSON = $request->getBody()->getContents();
            return $request;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $responseJSON = $e->getResponse();
        }
    }

    public static function deleteRequest(string $route, int $id)
    {
        try {
            $client = new Client();
            $url = 'https://api.hubapi.com/'.$route.$id;
            // $response = $client->request('DELETE', $url, ['query' => $id]);
            $request = $client->delete($url);
            // $response = $request->send();
            // $response = $client->send($request);
            // $responseJSON = $request->getBody()->getContents();
            // return $responseJSON;
            // dd($response);

            // dd($request);

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $request = $e->getResponse();
        }
    }

}
