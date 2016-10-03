<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/27/16
 */

namespace {
    use Yandex\ActionHandler\ActionHandlerInterface;
    use Yandex\Http\Response;

    class MockHandler implements ActionHandlerInterface
    {
        public function handle(Response $response)
        {
            return 1;
        }
    }
}

namespace Yandex\Tests\Core\Http {
    use Yandex\Action\ActionInterface;
    use Yandex\ActionHandler\ActionHandlerInterface;
    use Yandex\Auth\Token;
    use Yandex\Exception\UnsupportedActionException;
    use Yandex\Http\Client;
    use Yandex\Http\Curl;
    use Yandex\Http\CurlInterface;

    class ClientTest extends \PHPUnit_Framework_TestCase
    {
        public function test_create_instance_with_invalid_url()
        {
            $this->setExpectedException('\InvalidArgumentException');
            new Client('asd', 'qwe', 'zxc', new Curl());
        }

        public function test_client_with_unsupported_action()
        {
            $action = $this->getMock(ActionInterface::class);
            $client = new Client('http://example/com', 'qwe', 'zxc', new Curl());
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
            $action->expects($this->once())
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

            $client = new Client('http://example.com', 'qwe', 'asd', $curl);
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
            $action->expects($this->once())
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

            $client = new Client('http://example.com', 'qwe', 'asd', $curl);
            $client->addActionHandler(get_class($action), \MockHandler::class);

            $this->assertEquals(1, $client->call($action));
        }
    }
}