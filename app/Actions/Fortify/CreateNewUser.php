<?php

namespace App\Actions\Fortify;

use App\Models\Balances;
use App\Models\Profile;
use App\Models\Referal;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'role' => ['required', 'string', 'in:merchant,customer'],
        ])->validate();

        $role = $input['role'];
        $name = $input['name'];

        $user = User::create([
            'name' => $name,
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' => $role,
        ]);

        if ($role == 'customer') {
            $user->customer()->create([
                'company_name' => $name,
            ]);
        } elseif ($role == 'customer') {
            $user->merchant()->create([
                'company_name' => $name,
            ]);
        }
        return $user;
    }
}
