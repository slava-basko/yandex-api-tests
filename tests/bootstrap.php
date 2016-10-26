<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/27/16
 */
require __DIR__ . '/../../../../vendor/autoload.php';

use Yandex\ActionHandler\ActionHandlerInterface;
use Yandex\Http\Response;

class MockHandler implements ActionHandlerInterface
{
    public function handle(Response $response)
    {
        return 1;
    }
}

$GLOBALS['webmaster_user'] = new \YandexWebmaster\Auth\User(123, new \Yandex\Auth\Token('qwe'));