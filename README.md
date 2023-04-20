# Let's Start Role Permission Step By Step

   1. Create a model for permissions and a migration:
       `php artisan make:model Permission -m`.
   2. Create a table to represent the many-to-many relationship between users and permissions: 
    `php artisan make:migration create_permission_user_table --create=permission_user`
   3. Run the migration:   `php artisan migrate`
   4. Write a trait to work with permissions:
      . Create a file in  `App\Services\Permission\Traits` 
      . Add a many-to-many relationship query in the constructor: 
         `$this->belongsToMany(Permission::class, 'permission_user')`
      . Use this trait in `User.php`
      . Write a method in the trait called `givePermissionsTo` that accepts an array of permissions
   5. Use the `Arr::flatten()` helper function to flatten a multi-dimensional array
   6. In the `givePermissionsTo` method, use `syncWithoutDetaching` to assign permissions to the user with a many-to-many relationship
   7. Delete permission
      . Define a method called `withdrawPermissions` and use `detach` on the permissions
   8. Refreshing permissions: (delete the user's old permissions and add new ones)
      . Define a method called `refreshPermissions` and use `sync` on the permissions
   9. Checking permissions: define a method called `hasPermissions` and use `contains()` on the permissions. this function will give us a boolean(true/false).

   ## How to check permissions with Laravel Gate

   1. Create a service provider: `php artisan make:provider PermissionServiceProvider`.
   2. In the `boot` method of the `PermissionServiceProvider`.
      . retrieve all permissions and map them to the `Gate` facade to determine if a user has the required permission
      . To use another value in the callback function, you should use the `use` keyword.
   3. Register the provider in the `providers` array of the `config/app.php` configuration file.
   4. Test the functionality by using `dd(Auth::user()->can('delete post'));` to check if the logged-in user has the permission to delete a post.
