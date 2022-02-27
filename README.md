# Laravel RESTful API with Sanctum authorization

RESTful API implemented on Laravel framework with Sanctum authorization.

## Requirements:
- PHP 7
- MySQL
- Composer
- Laravel


## Installation

```
git clone https://github.com/Im4Proger/LaravelRESTfulAPI_v1
fill in the database connection settings in the .env file
chmod -R 755 storage
composer install
php artisan key:generate
php artisan migrate
```


## Filling the database with test data

```
php artisan db:seed
```


## Test coverage

```
Written basic functional tests for the main api methods
vendor\bin\phpunit
```


## Token generation for Sanctum

```
php artisan tinker
create 1 test user
$user=User::first();
$user->createToken('dev');
copy token: "plainTextToken"
```


## API methods

|Http-method|Url|API-method|Request json|Response json|
|---|---|---|---|---|
|POST|api/category/create|Create new category|[<br>{ "name": string, "url": string },<br>{ "name": string, "url": string }<br>]|{<br>"success": true,<br>"message": "action completed successfully"<br>}|
|DELETE|api/category/delete|Delete category|[<br>{ "id": integer },<br>{ "id": integer}<br>]|{<br>"success": true,<br>"message": "action completed successfully"<br>}|
|POST|api/good/create|Create new good|[<br>{ "name": string, "text": string, "price": integer, "url": string, "is_public": 0..1, "categories": array of integer },<br>{ "name": string, "text": string, "price": integer, "url": string, "is_public": 0..1, "categories": array of integer }<br>]|{<br>"success": true,<br>"message": "action completed successfully"<br>}||
|PUT|api/good/edit|Edit good|[<br>{ "id": integer, "name": string, "text": string, "price": integer, "url": string, "is_public": 0..1 },<br>{ "id": integer, "name": string, "text": string, "price": integer, "url": string, "is_public": 0..1 }<br>]|{<br>"success": true,<br>"message": "action completed successfully"<br>}|
|DELETE|api/good/delete|Delete good|[<br>{ "id": integer },<br>{ "id": integer }<br>]|{<br>"success": true,<br>"message": "action completed successfully"<br>}|
|POST|api/good/index/good_name_like|Search goods by complete coincidence name|[<br>{ "value": string }<br>]|{<br>"success": true,<br>"message": "action completed successfully",<br>"results": [ --goods array--]<br>}|
|POST|api/good/index/good_name_like_partial|Search goods by partial coincidence name|[<br>{ "value": string }<br>]|{<br>"success": true,<br>"message": "action completed successfully",<br>"results": [ --goods array--]<br>}|
|POST|api/good/index/category_id|Search goods by category id|[<br>{ "value": integer }<br>]|{<br>"success": true,<br>"message": "action completed successfully",<br>"results": [ --goods array--]<br>}|
|POST|api/good/index/category_name_like|Search goods by complete coincidence category name|[<br>{ "value": string }<br>]|{<br>"success": true,<br>"message": "action completed successfully",<br>"results": [ --goods array--]<br>}|
|POST|api/good/index/category_name_like_partial|Search goods by partial coincidence category name|[<br>{ "value": string }<br>]|{<br>"success": true,<br>"message": "action completed successfully",<br>"results": [ --goods array--]<br>}|
|POST|api/good/index/price|Search goods by price|[<br>{ "value_min": integer, "value_max": integer }<br>]|{<br>"success": true,<br>"message": "action completed successfully",<br>"results": [ --goods array--]<br>}|
|POST|api/good/index/is_public|Search goods by is_public field|[<br>{ "value": integer }<br>]|{<br>"success": true,<br>"message": "action completed successfully",<br>"results": [ --goods array--]<br>}|
|POST|api/good/index/deleted|Search goods by non-deleted attribute|[<br>{ "value": "0" }<br>]|{<br>"success": true,<br>"message": "action completed successfully",<br>"results": [ --goods array--]<br>}|
