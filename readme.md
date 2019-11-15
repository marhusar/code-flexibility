
How to generate test coverage with phpunit:
````
vendor/bin/phpunit --configuration phpunit.xml --coverage-html coverage
````

How to generate test coverage needed for Infection
````
vendor/bin/phpunit --configuration phpunit.xml --log-junit coverage/phpunit.junit.xml --coverage-xml coverage/coverage-xml
````

How to run mutation tests with Infection (from package - infection.json)
````
vendor/bin/infection --coverage=coverage
````

How to run unit tests for package:
````
vendor/bin/phpunit --configuration phpunit.xml
