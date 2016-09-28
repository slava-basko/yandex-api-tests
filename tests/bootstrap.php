<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/27/16
 */
require __DIR__ . '/../../../../vendor/autoload.php';

$GLOBALS['webmaster_user'] = new \YandexWebmaster\Auth\User(123, new \Yandex\Auth\Token('qwe'));