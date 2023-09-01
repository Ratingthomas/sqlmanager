# SQLManager
SQLManager is a small script that lets you easily interact with your mysql database.

## Installation
1. Download the latest release [here](https://github.com/Ratingthomas/sqlmanager/releases/latest) or from the [releases](https://github.com/Ratingthomas/sqlmanager/releases) page.
2. Put the script somewhere in your project.
3. Add the following code:
```php
<?php
  include 'path/to/SQLManager.php';
  use Ratingthomas\SQL;
  $sql = new SQL\SQL();
?>
```

## How to use
Here i will explain how you can use the script.

### Connect to Database
```php
$sql->connect("db_name", "db_username", "db_password", "db_name");
```
| Parrameter  | Details                  | Example     |
|-------------|--------------------------|-------------|
| db_host     | The database host.       | `localhost` |
| db_username | Username                 | `root`      |
| db_password | Password                 | `admin`     |
| db_name     | The name of the database | `test`      |

### Get data from the dabatase
Example 1
```php
$result = $sql->query("SELECT * FROM users WHERE userid = ? AND user_type = ?", ['1', 'superadmin'], true);
print_r($result);
```
Example 2
```php
$result = $sql->query("SELECT * FROM users", []);
print_r($result);
```
| Parrameter | Details                                              | Example               | Type    | Required | Can be empty |
|------------|------------------------------------------------------|-----------------------|---------|----------|--------------|
| query      | The sql query                                        | `SELECT * FROM test;` | String  | true     | False        |
| options    | If you have a where statement                        | `[$param1, $param2]`  | Array   | true     | true         |
| array_push | Make the array Multidimensional                      | `true`                | boolean | false    | true         |
| no_result | Set this to true if the sql query has no return falue | `true`                | boolean | false    | true         |

### Get the connection info.
```php
$sql->displayconnection()
```
