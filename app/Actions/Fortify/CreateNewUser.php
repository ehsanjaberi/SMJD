<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    protected $auth=1;
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'PersonId' => ['required', 'string', 'max:255'],
            'Username' => [
                'required',
                'string',
                'max:255',
                Rule::unique(User::class),
            ],
            'Password' => ['required', 'string', 'max:255'],
            // 'Password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'ModifyUser'=>Auth::user()->id,
            'Username' => $input['Username'],
            'PersonId' => $input['PersonId'],
            'password' => Hash::make($input['Password']),
        ]);
    }
}
