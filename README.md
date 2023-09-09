NOTE: This task was originally designed on MailerLite's request as a part of their hiring process. Below you can find the task followed by installation steps.

______________________________________________________________________

# Laravel developer task

The entire task assignment should take no longer than 4 hours to complete. It's fine to leave some rough edges. Just try to showcase your skills to the best of your ability.

## Background / Intro

Subscriber management is one of the the key features in MailerLite. There are a few different ways for subscribers to reach your mailing list:

* Adding subscribers directly through our iOS or web applications
* Web forms and a landing pages
* 3rd. party services which are integrated through our API
* Public HTTP API endpoints for your custom integrations

## Task I: back end

Your main task is to create an API for managing two resources and their relations: subscribers and fields.

* Subscriber resource must have these properties:
  * email address (in valid format and host domain must be active)
  * name
  * state (active, unsubscribed, junk, bounced, unconfirmed)
* Field resource must have these properties:
    * title (e.g. company, country, birthday)
    * type (date, number, string, boolean)
* Fields are shared between subscribers.
* Each subscriber can have different field values. Each field value belongs to a single field.

## Task II: front end

We also ask you to create a tiny client for your API using Vue.js. You can use any CSS framework. Feel free to showcase your creativity!

## General requirements

* Laravel framework
* Vue.js framework
* RESTful JSON API
* ORM and relationships, associations
* Request validation
* Efficient use of native framework features: migrations, seeders, tests, etc.
* PSR-2 compliant source code
* Please commit `.env` file to the repository. Environment variables should work out of the box.
* Please use SQLite database (`DB_CONNECTION=sqlite`)
* Ensure the project works with artisan's built-in web server (`artisan serve`)
* Document setup instructions in a README file.
* Please provide a link to the hosted project OR a screen recording of it in action - whichever is more convenient. This will serve as a reference point if there are problems running the project locally.

## Final steps

* Create a private repository on GitHub
* Give GitHub user `tadaspaplauskas` permissions to view it
* Send the repository link to jobs@mailerlite.com

______________________________________________________________________

# Install 'Subscriber Management App' in just a few steps:

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
______________________________________________________________________
