## Let's Start Coding Step by Step

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

# Now Start the Register System
    
1. Add a phone number to the users table using the command  `php artisan make:migration add_phone_number_to_users_table --table=users`
2. Add the RegisterController and routes
    . First, add a route for showing the registration form.
    . Next, add a route for submitting the registration form and creating the user.
        .In the Register method in RegisterController, follow these steps:
            1. Validate the register form.
            2. Create the user in the database.
            3. Log in the user.
            5. Redirect to the home page with a success alert.


    

