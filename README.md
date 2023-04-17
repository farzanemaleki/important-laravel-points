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

