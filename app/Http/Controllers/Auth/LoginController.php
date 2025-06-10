<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(Request $request)
    {
        // Almacena la URL actual en la sesión
        $request->session()->put('url.intended', $request->redirect);

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        // Por defecto, se aplican las reglas más estrictas (para aprendices y usuarios no registrados)
        $rules = [
            $this->username() => 'required|string',
            'password' => ['required', 'string', 'regex:/^[a-zA-Z0-9]+$/', 'max:15'],
        ];

        $messages = [
            'password.regex' => 'La contraseña solo debe contener letras y números. No se permiten caracteres especiales.',
            'password.max' => 'La contraseña no debe tener más de :max caracteres.',
        ];

        $user = User::where($this->username(), $request->input($this->username()))->first();

        if ($user) {
            $is_admin = $user->roles()->where('name', 'Admin')->exists();
            $is_apprentice = $user->roles()->where('name', 'Aprendiz')->exists();

            if ($is_admin) {
                // Para el Admin, se quita la restricción de 15 caracteres
                $rules['password'] = ['required', 'string', 'regex:/^[a-zA-Z0-9]+$/'];
                $messages['password.regex'] = 'La contraseña solo debe contener letras y números. No se permiten caracteres especiales (ej: ?()/%#"-).';
            } elseif ($is_apprentice) {
                // Para el Aprendiz, solo se personaliza el mensaje de error de los caracteres
                 $messages['password.regex'] = 'La contraseña solo debe contener letras y números. No se permiten caracteres especiales (ej: &%$#"!=?¿*+-).';
            }
        }
        
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    protected function authenticated(Request $request, $user)
    {
        // Redirige al usuario a la URL previa o a la HOME si no hay una URL previa
        return redirect()->intended($this->redirectPath());
    }
}
