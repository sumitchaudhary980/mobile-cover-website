<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class NotSameAsCurrentPassword implements Rule
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function passes($attribute, $value)
    {
        // Compare the new password with the current password
        return !Hash::check($value, $this->user->password);
    }

    public function message()
    {
        return 'The new password cannot be the same as the current password.';
    }
}

