# HRM
Ever wondered why HR's do not get back with feedback on time? Out of many circumstances, one of the reasons can be - HR lose the track of some candidates while performing a high volume recruitment cycle. We believe that solution lays in the digitalization of recruitment processes and therefore created a short brief designed for creating a software that helps HRs' see status updates on every candidate in one place.

We should be able to create new candidates with fields: *first name, *last name, *position, min-max salary range, skills(as tags), LinkedIn URL, cv(upload pdf file). After creating a candidate, its hiring status should be initial, the user should be able to change its statuses between Initial, First Contact, Interview, Tech Assignment, Rejected, Hired. We should also be able to attach comments to each change of status. For example, if rejected, what was the reason for rejection? Every action should be recorded with its comments just like a timeline for each candidate. So when requesting information about a candidate we should be able to retrieve data about its status changes and comments attached to it.

### Features && used tools
-  Support for multiple file storages with `FileManager.php` interface
-  Custom Exceptions
-  API resources
-  Route Model Binding
-  Dependency Injection
-  Form Request Validation
-  Seeders && Factories
-  API testing with `Laravel Telescope`
-  Feature tests with `phpunit` for `Candidate.php` model
-  `GitHub Actions` for CI/CD
-  API Documentation with `Postman`

### Setup
```
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```
### API Documentation is [here](https://www.postman.com/interstellar-space-24432/workspace/public/collection/12411946-294795af-be50-43d2-b785-2b6a3600617a?action=share&creator=12411946)

### Database Design is [here](https://dbdiagram.io/d/62a1c4d292b33b4f512fa35a)
