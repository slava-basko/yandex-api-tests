# yandex-api-tests

Create "phpunit.xml"
``` xml
<phpunit bootstrap="vendor/slava-basko/yandex-api-tests/tests/bootstrap.php" colors="true">
    <testsuites>
        <testsuite name="core">
            <directory>vendor/slava-basko/yandex-api-tests/tests/Core</directory>
        </testsuite>
        <testsuite name="webmaster">
            <directory>vendor/slava-basko/yandex-api-tests/tests/Webmaster</directory>
        </testsuite>
    </testsuites>

    <filter>
        <whitelist>
            <directory>vendor/slava-basko/yandex-api-core/src</directory>
            <directory>vendor/slava-basko/yandex-api-webmaster/src</directory>
            <exclude>
                <file>vendor/slava-basko/yandex-api-core/src/Http/Curl.php</file>
            </exclude>
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