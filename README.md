# CodeIgniter 4 Application Starter

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

You can read the [user guide](https://codeigniter.com/user_guide/)
corresponding to the latest version of the framework.

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Installation Steps

1. Clone the repository
```
git clone https://github.com/your-repo/student-management-system.git
cd student-management-system
```

2. Install dependencies
```
composer install
```

3. Configure environment
- Copy `.env` file from `.env.example`
- Update database configuration:
```
database.default.hostname = localhost
database.default.database = student_management
database.default.username = db_username
database.default.password = db_password
database.default.DBDriver = MySQLi
```

4. Database setup
- Create a MySQL database
- Run migrations:
```
php spark migrate
```
- Seed initial data (optional):
```
php spark db:seed AdminSeeder
php spark db:seed InitialDataSeeder
```

5. Set base URL
In `.env` file, set:
```
app.baseURL = 'http://localhost/student-management-system/'
```

6. Permissions
Make sure the following directories are writable:
- `writable/`

Default Login Credentials

Admin Account
- Username: admin123@ntc.edu.ph
- Password: admin123NTC

Teacher Account
- Username: teacher123@ntc.edu.ph
- Password: teacher123NTC

Student Account
- Username: james@ntc.edu.ph
- Password: james0918

Note: Replace these default credentials after the first login for security reasons.

Features and Modules

1. Authentication Module
- User login/logout
- Password reset
- Role-based access control (Admin, Teacher, Student)

2. Admin Dashboard
- System overview and statistics
- Quick access to important features
- Notifications and alerts

3. Student Management
- Add/edit/delete student records
- Student profile management
- Student ID card generation

4. Course Management
- Create and maintain courses
- Allocate courses to departments
- Assign course prerequisites
- Course scheduling

5. Class Management
- Generate class sections
- Allocate students to classes
- Class timetable management
- Class attendance tracking

6. Gradebook
- Track and maintain student grades
- Calculate grades based on user-defined criteria
- Generate grade reports
- Transcript generation

7. Attendance System
- Daily attendance tracking
- Attendance reports
- Low attendance notification

8. Reporting
- Student performance reports
- Attendance data
- Generation of custom reports

9. System Settings
- Configuration of academic year
- Setup of grade scale
- School information management
- Management of user role and permissions

Additional Features

- Mobile device responsiveness (works on mobile phones)
- Data export/import function
- Audit logs for significant actions
- Support for multiple languages (if set up)
- REST API for integration with other systems

