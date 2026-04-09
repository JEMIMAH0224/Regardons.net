<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    // This trait (provided by Fortify) defines a method passwordRules()
    // that returns the default password validation rules:
    // required, min length, confirmed, etc.
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input  All form fields sent by the register form.
     *
     * @throws ValidationException  If any validation rule fails.
     */
    public function create(array $input): User
    {
        // 1) VALIDATION
        // Validator::make(...) builds a validator for the incoming form data.
        // - $input: contains 'username', 'prenom', 'nom', 'email', 'password', 'password_confirmation', etc.
        // - First array: validation rules for each field.
        Validator::make(
            $input,
            [
                // USERNAME:
                // - required: user must fill it
                // - string: must be text
                // - max:255: not longer than 255 chars
                // - unique: value must be unique in the users.username column
                'username' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique(User::class, 'username'),
                ],

                // FIRST NAME ("prenom" in your form):
                // stored in database as first_name
                'prenom' => [
                    'required',
                    'string',
                    'max:255',
                ],

                // LAST NAME ("nom" in your form):
                // stored in database as last_name
                'nom' => [
                    'required',
                    'string',
                    'max:255',
                ],

                // EMAIL:
                // - required, valid email format, unique in users.email
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class, 'email'),
                ],

                // PASSWORD:
                // Uses Fortify's default password rules from the trait.
                // Includes:
                // - required
                // - min length
                // - confirmed => must match password_confirmation field
                'password' => $this->passwordRules(),
            ]
        )->validate();
        // ->validate() actually runs the validation and throws ValidationException
        // if any rule fails. In that case, the user is redirected back with errors
        // and nothing below this line executes.

        // 2) USER CREATION
        // If validation passes, we now create a new user row in the database.
        // User::create([...]) uses mass assignment to insert a record into users table.
        return User::create([
            // Save the username directly in the 'username' column.
            // $input['username'] comes from the form field name="username".
            'username' => $input['username'],

            // Save the first name (prenom) in the 'first_name' column.
            // This keeps first name separate;
            // Example:
            // prenom = "Marie"
            'first_name' => $input['prenom'],

            // Save the last name (nom) in the 'last_name' column.
            // Example:
            // nom = "Dupont"
            'last_name' => $input['nom'],

            
            // Save the email entered in the form into the 'email' column
            'email' => $input['email'],

            // Save password.
            // If your User model has 'password' => 'hashed' cast,
            // you typically do NOT need Hash::make() here (Laravel will hash automatically).
            // If you do not use the 'hashed' cast, then Hash::make() is required.
            'password' => $input['password'],
        ]);
    }
}

