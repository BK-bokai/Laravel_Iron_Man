<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserAuthController extends Controller
{
    use AuthenticatesUsers;
    public function __construct()
    {
        $this->middleware('guest')->except('signOut');
    }
    function signUpPage(Request $request)
    {
        $title = '註冊';
        return view('auth.signUp', compact('title'));
    }

    public function signInPage()
    {
        $title = '登入';
        return view('auth.signIn', compact('title'));
    }


    protected function create(array $data)
    {
        return User::create([
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => $data['type'],
        ]);
    }
    public function signUpProcess(Request $request)
    {

        $input = $request->all();
        // var_dump($input);
        // exit;
        $rules = [
            'nickname' => [
                'required',
                'max:50',
            ],
            'email' => [
                'required',
                'max:150',
                'email',
            ],
            'password' => [
                'required',
                'same:password_confirmation',
                'min:6',
            ],
            'password_confirmation' => [
                'required',
                'min:6'
            ],
            'type' => [
                'required',
                'in:G,A'
            ]
        ];
        //驗證資料
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            //資料驗證錯誤
            return redirect(route('signUp'))->withErrors($validator)->withInput();
        } else {
            event(new Registered($user = $this->create($request->all())));
            return redirect(route('signIn'));
        }

        //寄送註冊通知信

        var_dump($input);
        exit;
        return ($request);
    }

    public function signInProcess(Request $request)
    {

        $input = $request->all();
        $rules = [
            'email' => [
                'required',
                'max:150',
                'email',
            ],
            'password' => [
                'required',
                'min:6',
            ],
        ];
        //驗證資料
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            //資料驗證錯誤
            return redirect(route('signIn'))->withErrors($validator)->withInput();
        }
        $user = User::where('email', $request->email)->first();

        if ($user !== null) {
            if (Hash::check($request->password, $user->password)) {
                // if ($this->guard()->attempt(['email' => $request->email, 'password' => $request->password])) {
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                        return redirect(route('trade'));
                }else{
                    return '系統錯誤';
                }
            } else {
                $errors = ['password' => '輸入的密碼有誤!'];
                return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors($errors);
            }
        } else {
            $errors = ['email' => '輸入的信箱有誤!'];
            return redirect()->back()
                ->withInput($request->only('email'))
                ->withErrors($errors);
        }
    }
    public function signOut(){
        // $this->guard()->logout();
        // $request->session()->invalidate();
        // return $this->loggedOut($request) ?: redirect(route('signIn'));
        Auth::logout();
        return redirect(route('signIn'));
    }
}
