# yandex-api-tests

Create "phpunit.xml"
``` xml
<phpunit bootstrap="vendor/slava-basko/yandex-api-tests/tests/bootstrap.php" colors="true">
    <testsuites>
        <testsuite name="core">
            <directory>vendor/slava-basko/yandex-api-tests/tests/core</directory>
        </testsuite>
    </testsuites>

    <filter>
        <whitelist>
            <directory>vendor/slava-basko/yandex-api-core/src</directory>
        </whitelist>
    </filter>

    <logging>
        <log type="coverage-clover" target="coverage.xml"/>
    </logging>
</phpunit>
```

```
wget https://phar.phpunit.de/phpunit.phar

php phpunit.phar
```