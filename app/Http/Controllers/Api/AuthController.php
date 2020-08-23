<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function adminLogin(Request $request)
    {
        //first check if the data is valid or not
        //then check if this account is found in the database
        //if the user hasnot api token then create it through Str::random(120)
    }
    public function professorLogin(Request $request)
    {
        //first check if the data is valid or not
        //then check if this account is found in the database
        //if the user hasnot api token then create it through Str::random(120)
    }
    public function studentLogin(Request $request)
    {
        //first check if the data is valid or not
        //then check if this account is found in the database
        //if the user hasnot api token then create it through Str::random(120)
    }
    private function validateLogin($data)
    {
        // write here validation logic
        $rules = [];
        return validator()->make($data, $rules);
    }
}