<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'vorname' => ['required', 'string', 'max:255'],
            'nachname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'image', 'max:1024'],
            'geburtsdatum' => ['required', 'date', 'before:now'],
            'pin' => ['required', 'integer', 'digits:6'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'vorname' => $input['vorname'],
                'nachname' => $input['nachname'],
                'email' => $input['email'],
                'geburtsdatum' => $input['geburtsdatum'],
                'pin' => $input['pin'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'vorname' => $input['vorname'],
            'nachname' => $input['nachname'],
            'email' => $input['email'],
            'email_verified_at' => null,
            'geburtsdatum' => $input['geburtsdatum'],
            'pin' => $input['pin'],
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
