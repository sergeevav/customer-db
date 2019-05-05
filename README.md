Installation
============

### Get sources

Run this command:

```
git clone https://github.com/sergeevav/customer-db
```

The command installs the application in a directory named `customer-db`.
Go to this directory in the terminal for the next steps.

### Run application localy

1. Install the application dependencies

```
composer install
```

2. Create a new database and adjust the configuration in `config/db-local.php` accordingly.

2. Create a new database for tests and adjust the configuration in `config/test_db-local.php` accordingly.

3. Apply migrations with commands:

```
./yii migrate

./tests/bin/yii migrate
```

4. Run built-in web server:

```
./yii serve
```

5. Access it in your browser by opening  http://127.0.0.1:8080

6. Build the test suite:

```
./vendor/bin/codecept build
```

7. Run tests:

```
./vendor/bin/codecept run
```

### Run application using Docker

1. Install the application dependencies:

```
docker-compose run --rm php composer install
```

2. Create databases:

```
docker-compose run --rm php docker-createdb.sh
```

3. Run the migrations:

```
docker-compose run --rm php yii migrate

docker-compose run --rm php tests/bin/yii migrate
```

4. The most important step, **nothing will work without it**:

```
docker-compose run --rm php docker-fix-permissions.sh
```

5. Start application:

```
docker-compose up
```

6. Access it in your browser by opening  http://127.0.0.1:8000

7. Build the test suite:

```
docker-compose run --rm php vendor/bin/codecept build
```

8. Run tests:

```
docker-compose run --rm php vendor/bin/codecept run
```
