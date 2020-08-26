<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function adminLogin(Request $request)
    {
        $validator = $this->validateLogin($request->all());
        if ($validator->fails()) {
            return jsonResponse(0, 'errors', $validator->errors());
        }
        //here we use session driver because attempt works only in it
        $auth = Auth::guard('admins_web')->attempt($this->getCredentials($request));
        if ($auth) {
            $user = Auth::guard('admins_web')->user();

            if (is_null($user->api_token)) {
                $user->api_token = Str::random(120);
                $user->save();
            }
            return jsonResponse('تم الدخول بنجاح', ['api_token' => $user->api_token, 'user' => $user]);
        } else {
            $msg = 'بيانات المستخدم غير صحيحة';
            return jsonResponse($msg, [], 401);
        }
    }
    public function professorLogin(Request $request)
    {
        $validator = $this->validateLogin($request->all());
        if ($validator->fails()) {
            return jsonResponse(0, 'errors', $validator->errors());
        }
        //here we use session driver because attempt works only in it
        $auth = Auth::guard('professors_web')->attempt($this->getCredentials($request));
        if ($auth) {
            $user = Auth::guard('professors_web')->user();

            if (is_null($user->api_token)) {
                $user->api_token = Str::random(120);
                $user->save();
            }
            return jsonResponse('تم الدخول بنجاح', ['api_token' => $user->api_token, 'user' => $user]);
        } else {
            $msg = 'بيانات المستخدم غير صحيحة';
            return jsonResponse($msg, [], 401);
        }
    }
    public function studentLogin(Request $request)
    {
        $validator = $this->validateLogin($request->all());
        if ($validator->fails()) {
            return jsonResponse(0, 'errors', $validator->errors());
        }
        //here we use session driver because attempt works only in it
        $auth = Auth::guard('students_web')->attempt($this->getCredentials($request));
        if ($auth) {
            $user = Auth::guard('students_web')->user();

            if (is_null($user->api_token)) {
                $user->api_token = Str::random(120);
                $user->save();
            }
            return jsonResponse('تم الدخول بنجاح', ['api_token' => $user->api_token, 'user' => $user]);
        } else {
            $msg = 'بيانات المستخدم غير صحيحة';
            return jsonResponse($msg, [], 401);
        }
    }
    private function validateLogin($data)
    {
        $rules = [
            'password' => 'required|string',
            'email' => 'required|email',
        ];
        return validator()->make($data, $rules);
    }
    private function getCredentials(Request $request)
    {
        return $request->only(['email', 'password']);
    }
    public function register(Request $request)
    {
        $validator = $this->validateRegister($request->all());
        if ($validator->fails()) {
            return jsonResponse('errors', $validator->errors(), 404);
        }
        $request->merge(['password' => bcrypt($request->password)]);
        $student = Student::create($request->all());
        $student->api_token = Str::random(120);
        $student->save();
        return jsonResponse('تم الاضافة بنجاح', ['api_token' => $student->api_token, 'student' => $student]);
    }
    public function validateRegister($data)
    {
        // regex rule should be in an array.
        // before : means before today and -16 years mean before this year about 16 years
        $rules = [
            'name' => 'required|string|min:5',
            'password' => 'required|string|min:8|confirmed',
            'email' => 'required|email|unique:clients',
            // 'phone' => ['required', 'regex:/^(010|011|012|015){1}[0-9]{8}$/', 'unique:clients'],
            // 'dob' => 'required|date|before: -16 years',
            // 'last_donation_date' => 'required|date|before_or_equal: -1 days',
            // 'city_id' => ['required', Rule::in(City::all()->pluck('id')->toArray())],
            // 'blood_type_id' => ['required', Rule::in(BloodType::all()->pluck('id')->toArray())],
        ];
        return validator()->make($data, $rules);
    }
}