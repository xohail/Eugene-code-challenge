# Senior Laravel API Developer Code Challenge

## Introduction

1. A dashboard where a list of all the doctors and their associated clinics and specialities can be verified.
2. Each doctor can be displayed with it details on separate page
3. Each doctor details can be modified (Multiple specialities and clinics can be assigned)
4. A dashboard where a list of all the tests undertaken by doctors can be verified


## Assumptions

1. A doctor can have multiple specialities
2. A doctor can be working at multiple clinics
3. Limited or defined number of medical tests can be taken
4. A single test can be undertaken by one doctor only

## Installation

Follow these steps to run the application:

1. Ensure PHP, Composer, and the SQLite extension are installed on your system.
2. Ensure vite is installed
2. Clone this repository. __Do not fork it!__
3. Run `composer install` to install required dependencies.
4. Run `php artisan serve` to start the Laravel development server.
5. Run `yarn dev` to run Vite and compile Tailwind resources.
6. Visit the application in your browser at http://127.0.0.1:8000/doctors or http://127.0.0.1:8000/tests.

