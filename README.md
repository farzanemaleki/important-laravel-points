# Let's Start Coding Step by Step

1. Make the login and register UI.
3. Write `php artisan publish:lang` in the cmd then add fa and en and ... languages folders.
2. For supporting localization, we use `@lang('')` or `{{__('')}}` for static content of the website.
3. To show errors, make a blade file in the partials folder named `validation-errors.blade.php`. Use the following code:
        `@if($errors->any())
            @foreach($errors->all() as $error)
            ...
            @endforeach
        @endif`
4. To show alerts, make a blade file in the partials folder named `alert.blade.php`.
5. Use `@guest` and `@auth` for the login/register navbar button.

## Now Start the Register System
    
    1. Add a phone number to the users table using the command  `php artisan make:migration add_phone_number_to_users_table --table=users`
    2. Add the RegisterController and routes
        . First, add a route for showing the registration form.
        . Next, add a route for submitting the registration form and creating the user.
            .In the Register method in RegisterController, follow these steps:
                1. Validate the register form.
                2. Create the user in the database.
                3. Log in the user.
                5. Redirect to the home page with a success alert.


## Login System

    1.Add the LoginController and routes.
        . First, add a route to show the login form.
        . Next, add a route to submit the registration form and create the user.
            .In the login method of the LoginController, follow these steps:
                1. Validate the login form. 
                2. Check user and password and login with the `Auth::attempt($request->only('email', 'password'), $request->filled('remember'));`function. If the output is true, redirect the user to the page they were trying to access with `redirect()->inttended()`.
                If it's false, redirect back with an error message stored in a session.
                3. When a user logs in a session created for user security should generate a seprate session in every log in with `session->regenerate()` function.
 
    - Logout
        . Add a route to web.php and use Auth::logout() in the logout method of the LoginController.
        . It's also better to invalidate the user session with session->invalidate().

## Use Throttle Login
    
    - In Laravel 10 and later versions, the ThrottlesLogins trait is no longer available. Instead, you can use the Breeze or Jetstream authentication packages to enable login throttling. However, if you want to add login throttling manually, you can follow these steps:
    
        1- After validating the login credentials, add a function to check if the user is rate-limited `ensureIsNotRateLimited`
        2- In this function, use the RateLimiter::tooManyAttempts() method to check if the user has exceeded    the maximum number of login attempts. If the limit is reached, throw a ValidationException with a custom message using `ValidationException::withMessages()`. 
        For example:
            `throw ValidationException::withMessages([
                'throttle' => trans('auth.throttle', ['seconds' => $seconds]),
            ]);`

            The `trans('auth.throttle', ['seconds' => $seconds])` code displays a translated message to the user based on their locale, and includes the number of seconds they need to wait before attempting to log in again.


        3- Define the `throttleKey()` method

            `public function throttleKey(Request $request): string
            {
                return Str::transliterate(Str::lower($request->input($this->username())).'|'.$request->ip());

            }`

        4- If the login attempt is successful, clear the rate limiter for the user's throttle key by calling the RateLimiter::clear() method. For example:
            `RateLimiter::clear($this->throttleKey($request));`

        5- If the login attempt fails, increment the rate limiter for the user's throttle key by calling the RateLimiter::hit() method. This will add a delay before the user can attempt to log in again. For example:
            `RateLimiter::hit($this->throttleKey($request), $seconds = 60);`


