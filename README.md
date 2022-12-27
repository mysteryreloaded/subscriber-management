Install 'Subscriber Management App' in just a few steps:

- Make sure you have the latest PHP and Node versions
- git clone https://github.com/mysteryreloaded/subscriber-management
- Create new sqlite database file in 'project/database' directory: `{subsriber-management}/database/database.sqlite` (with read/write permissions)
- [optional] If you want to run tests make sure to add another sqlite database file to the same directory: `{subsriber-management}/database/test.sqlite`
- Run `composer install` command
- Run migrations: `php artisan migrate`
- Run seeders: `php artisan db:seed`
- Run (`npm install`/`yarn`) command
- Run (`npm run build`/`yarn build`) command
- Run `php artisan serve`
- Visit the app by using link provided by the last command (usually it's `127.0.0.1:8000`)
- [optional] Run `php artisan test` and you should see 11 tests that have passed.
- In case of encountering technical difficulties during local deployment you can check out live production app: https://mailerlite.zetasoft.io
  - This deployment is hosted on a raspberry pi 4 device with a single location in Serbia, therefore your requests will likely have ~1000ms timeout (depending on your location).
  - Local deployment using steps above will provide better user experience
