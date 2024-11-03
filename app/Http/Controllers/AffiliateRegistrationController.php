<?php

namespace App\Http\Controllers;

use App\Models\AffiliateRegistration;
use App\Models\User;
use App\Services\ReferralCodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class AffiliateRegistrationController extends Controller
{

    protected $referralCodeService;

    public function __construct(ReferralCodeService $referralCodeService)
    {
        $this->referralCodeService = $referralCodeService;
    }

    public function index()
    {

        return view('auth.affiliate_registration');
    }




    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $this->validateRequest($request);

        DB::transaction(function () use ($validatedData, &$user) {

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'phone' => $validatedData['phone'],
                'street_address' => $validatedData['address'],
                'refer_code' => $this->generateUniqueReferCode(),
            ]);


            $user->assignRole('affiliate');

            // Log the user in
            Auth::login($user);
        });


        return redirect()->route('dashboard')->with('success', 'Affiliate registration completed successfully!');
    }


    private function generateUniqueReferCode()
    {
        $code = strtoupper(Str::random(6));
        $exists = User::whereHas('roles', function ($query) {
            $query->where('name', 'affiliate');
        })
            ->where('refer_code', $code)
            ->exists();
        return $exists ? $this->generateUniqueReferCode() : $code;
    }


    /**
     * Validate the incoming request data.
     *
     * @param Request $request
     * @return array
     */
    private function validateRequest(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'promotion_ouroase' => 'nullable|string|max:255',
            'balance' => 'nullable|numeric|min:0',
        ]);
    }
}
