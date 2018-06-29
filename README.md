# sa-system-new

clone the repository
Wait for the dependencies to install

1. Clone new repository.
2. Open terminal with directory set to the cloned folder then run "composer install".
3. Install a key for your application by running "php artisan key:generate"
4. Modify the AppServiceProvider located in app/providers/appServiceProvider
5. Inside the boot function add "Schema::defaultStringLength(191);"
6. If bower is already installed in your PC, skip to #7. Install bower package manager. Instructions on how to install bower is found here: https://bower.io/.
7. Enter /'public' folder. Check if you have 'bower.json'.
8. If 'bower.json' exists, execute 'bower install' and wait for the UI dependencies to install.
