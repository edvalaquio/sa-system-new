# sa-system-new

clone the repository
Wait for the dependencies to install

1. Clone new repository.
2. Open terminal with directory set to the cloned folder then run "composer install".
3. Create a copy of .env from the template .env.example and fill up the database, username, and password
4. Install a key for your application by running "php artisan key:generate"
5. Modify the AppServiceProvider located in app/providers/appServiceProvider
6. Inside the boot function add "Schema::defaultStringLength(191);"
7. If bower is already installed in your PC, skip to #7. Install bower package manager. Instructions on how to install bower is found here: https://bower.io/.
8. Enter /'public' folder. Check if you have 'bower.json'.
9. If 'bower.json' exists, execute 'bower install' and wait for the UI dependencies to install.
