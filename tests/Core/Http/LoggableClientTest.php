<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/27/16
 */

use Psr\Log\NullLogger;
use Yandex\Action\ActionInterface;
use Yandex\ActionHandler\ActionHandlerInterface;
use Yandex\Auth\Token;
use Yandex\Exception\UnsupportedActionException;
use Yandex\Http\Client;
use Yandex\Http\Curl;
use Yandex\Http\CurlInterface;
use Yandex\Http\LoggableClient;

class LoggableClientTest extends \PHPUnit_Framework_TestCase
{
    public function test_create_instance_with_invalid_url()
    {
        $this->setExpectedException('\InvalidArgumentException');
        new LoggableClient('asd', 'qwe', 'zxc', new Curl(), new NullLogger());
    }

    public function test_client_with_unsupported_action()
    {
        $action = $this->getMock(ActionInterface::class);
        $client = new LoggableClient('http://example/com', 'qwe', 'zxc', new Curl(), new NullLogger());
        $this->setExpectedException(UnsupportedActionException::class);
        $client->call($action);
    }

    public function test_client_with_invalid_response()
    {
        $token = new Token('qwe-asd');

        $action = $this->getMock(ActionInterface::class);
        $action->expects($this->once())
            ->method('getHttpMethod')
            ->willReturn('get');
        $action->expects($this->exactly(2))
            ->method('getUrl')
            ->willReturn('/');
        $action->expects($this->once())
            ->method('getToken')
            ->willReturn($token);

        $actionHandler = $this->getMock(ActionHandlerInterface::class);

        $curl = $this->getMock(CurlInterface::class);
        $curl->expects($this->once())
            ->method('init')
            ->willReturn(null);
        $curl->expects($this->once())
            ->method('addHeader')
            ->willReturn(null);
        $curl->expects($this->once())
            ->method('setOptions')
            ->willReturn(null);
        $curl->expects($this->once())
            ->method('exec')
            ->willReturn(false);

        $client = new LoggableClient('http://example.com', 'qwe', 'asd', $curl, new NullLogger());
        $client->addActionHandler(get_class($action), get_class($actionHandler));

        $this->setExpectedException(\Exception::class);
        $client->call($action);
    }

    public function test_client()
    {
        $token = new Token('qwe-asd');

        $action = $this->getMock(ActionInterface::class);
        $action->expects($this->once())
            ->method('getHttpMethod')
            ->willReturn('get');
        $action->expects($this->exactly(2))
            ->method('getUrl')
            ->willReturn('/');
        $action->expects($this->once())
            ->method('getToken')
            ->willReturn($token);

        $curl = $this->getMock(CurlInterface::class);
        $curl->expects($this->once())
            ->method('init')
            ->willReturn(null);
        $curl->expects($this->once())
            ->method('addHeader')
            ->willReturn(null);
        $curl->expects($this->once())
            ->method('setOptions')
            ->willReturn(null);
        $curl->expects($this->once())
            ->method('exec')
            ->willReturn(1);
        $curl->expects($this->once())
            ->method('close')
            ->willReturn(null);

        $client = new LoggableClient('http://example.com', 'qwe', 'asd', $curl, new NullLogger());
        $client->addActionHandler(get_class($action), \MockHandler::class);

        $this->assertEquals(1, $client->call($action));
    }
}