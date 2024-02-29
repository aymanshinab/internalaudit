<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {


        $messages = [
            'required' => "*هذا الحقل مطلوب.",
            'digits_between' => ' رقم الهاتف يجب أن يكون مكون من عشرة أرقام.',
            'starts_with' => ' رقم الهاتف يجب أن يبدأ بـ 091, 092, 094, 021.',
            'email.unique' => '    البريد الالكتروني مستعمل.',
            'phone_number.unique' => '     رقم الهاتف مستعمل.',
            'starts_with' => ' رقم الهاتف يجب أن يبدأ بـ 091, 092, 094, 021.',
            'password' => 'يجب أن يتكون حقل كلمة المرور من 8 أحرف على الأقل  .',

        ];


        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], $messages);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
