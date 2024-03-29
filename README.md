# Senior Laravel API Developer Code Challenge

## Introduction

1. A dashboard where a list of all the doctors and their associated clinics and specialities can be verified.
2. Each doctor can be displayed with it details on separate page
3. Each doctor details can be modified (Multiple specialities and clinics can be assigned)
4. A dashboard where a list of all the tests undertaken by doctors can be verified


## Assumptions

1. A doctor can have multiple specialities
2. A doctor can be working at multiple clinics
3. Limited or defined number of medical tests (test names) are available
4. A single test can be undertaken by one doctor at one clinic only
5. Forms will be filled properly

## ERD
![Image Alt Text](DB_diagram.png)

## Available operations

* **Doctors**
  * List of doctors with name, specialty, clinic name and clinic address seperated by `-`
  * Paginated list with 100 a page
  * View individual doctor, clinics, specialities with related tests done by him/her details
  * Add a doctor
  * Edit a doctor
    * Can select multiple specialities
    * Can select multiple clinics
    * Update the name

* **Tests**
  * Paginated list with 100 a page
  * List of tests with test name, description, referring doctor and clinic
  * Add a test

* **Merge duplicate clinics**
  * Lists name, house and duplicate having the same name and house with comma separated ids
  * _Merge_ button refers all the doctors to first clinic id in the clinics_doctor(pivot) table and remove rest of the duplicate clinics from the database

* **Merge duplicate doctors**
    * Lists name, duplicate count having the same name with comma separated ids
    * _Merge_ button refers all the clinics to first doctor id in the clinics_doctor(pivot) table and remove rest of the duplicate doctors from the database

* **Unit tests**
  * ![Image Alt Text](Unit_tests_ss.png)


## Installation

Follow these steps to run the application:

1. Ensure PHP, Composer, and the SQLite extension are installed on your system.
2. Ensure vite is installed
3. Clone this repository.
4. Run `composer install` to install required dependencies.
5. Run `php artisan serve` to start the Laravel development server.
6. Run `yarn dev` to run Vite and compile Tailwind resources.

## Routes

1. http://127.0.0.1:8000/doctors
1. http://127.0.0.1:8000/tests
1. http://127.0.0.1:8000/duplicates/doctors
2. http://127.0.0.1:8000/duplicates/clinics
