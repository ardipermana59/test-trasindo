<?php

namespace App\Actions\Fortify;

use App\Models\Customer;
use App\Models\Merchant;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Profile;
use App\Models\User;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */

    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'address' => ['nullable', 'string', 'max:200'],
            'contact' => ['nullable', 'string', 'max:100'],
            'village' => ['nullable', 'string', 'max:100'],
            'district' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'province' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string',],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();
            if ($user->role == 'customer') {
                $customer = Customer::where('user_id', $user->id)->first();
                $customer->company_name = $input['name'];
                $customer->address = $input['address'];
                $customer->contact = $input['contact'];
                $customer->save();
            }

            if ($user->role == 'merchant') {
                $merchant = Merchant::where('user_id', $user->id)->first();
                $merchant->company_name = $input['name'];
                $merchant->address = $input['address'];
                $merchant->village = $input['village'];
                $merchant->district = $input['district'];
                $merchant->city = $input['city'];
                $merchant->province = $input['province'];
                $merchant->description = $input['description'];
                $merchant->save();
            }

        }
    }


    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
