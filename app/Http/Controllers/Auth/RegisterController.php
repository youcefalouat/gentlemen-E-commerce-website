<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Wilaya;
use App\Models\Commune;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $wilayas = Wilaya::all();
        return view('auth.register', compact('wilayas'));
    }

    public function getCommunes($wilayaId)
    {
        $communes = Commune::where('wilaya_id', $wilayaId)->get();
        return response()->json($communes);
    }
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
       // Define the validation rules
    $rules = [
        'nom' => ['required', 'string', 'max:30'],
        'prenom' => ['required', 'string', 'max:30'],
        'commune' => ['string'] ,
        'adresse' => ['required', 'string', 'max:255'],
        'telephone' => ['required', 'regex:/^0\d{9}$/'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ];

    // Define custom error messages
    $customMessages = [
        'nom.required' => 'Le nom est obligatoire.',
        'nom.string' => 'The nom field must be a string.',
        'nom.max' => 'The nom field may not be greater than :max characters.',
        'prenom.required' => 'Le prenom est obligatoire.',
        'prenom.string' => 'The prenom field must be a string.',
        'prenom.max' => 'The prenom field may not be greater than :max characters.',
        'adresse.required' => 'L\'adresse est obligatoire.',
        'adresse.string' => 'The adresse field must be a string.',
        'adresse.max' => 'The adresse field may not be greater than :max characters.',
        'telephone.required' => 'Le numero de telephone est obligatoire.',
        'telephone.regex' => 'Le format du numéro doit correspond a celui de l\'Algérie',
        'email.required' => 'L\'email est obligatoire.',
        'email.string' => 'The email field must be a string.',
        'email.email' => 'L\'adresse email doit etre valid.',
        'email.max' => 'The email field may not be greater than :max characters.',
        'email.unique' => 'Ce compte existe déjà.',
        'password.required' => 'Le mot de passe est obligatoire.',
        'password.string' => 'The password field must be a string.',
        'password.min' => 'Le mot de passe doit au moins contenir :min caractéres.',
        'password.confirmed' => 'Le mot de passe de confirmation ne match pas votre mot de passe.',
    ];

    return Validator::make($data, $rules, $customMessages);
}
    

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'commune' => $data['selected_commune'],
            'adresse' => $data['adresse'],
            'telephone' => $data['telephone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            
        ]);
    }
}
