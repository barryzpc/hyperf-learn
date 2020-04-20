<?php
/**
 * Created by PhpStorm.
 * User: barry
 * Date: 2020/4/14
 * Time: 16:18
 */

namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\Guzzle\ClientFactory;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Utils\Context;
use Hyperf\Utils\WaitGroup;


/**
 * @AutoController() //自动配置路由
 * @property int $foo
 */
class CoController extends AbstractController
{
    /**
     * @Inject()
     * @var ClientFactory
     */
    private $clientFactory;

    public function get()
    {
        return $this->foo;
    }

    public function update(Requestinterface $request)
    {
        $this->foo = $request->input('foo');
        return $this->foo;
    }

    public function sleep(RequestInterface $request)
    {
        $second = $request->query('foo',1);
        var_dump($second);
        sleep($second);
        return $second;

    }

    /**
     * 协程
     */
    public function test()
    {
        $wg = new WaitGroup();
        $result = [];
        $wg->add(2);
        co(function () use ($wg, $result) {
            $client = $this->clientFactory->create();
            $response = $client->get('http://dl.cn/co/sleep?foo=1');
            var_dump($response->getBody()->getContents());
            $result[1] = 123;
            var_dump($result);
            $wg->done();
        });

        co(function () use ($wg, $result) {
            $client = $this->clientFactory->create();
            $response = $client->get('http://dl.cn/co/sleep?foo=2');
            var_dump($response->getBody()->getContents());
            $result[2] = 321;
            var_dump($result);
            $wg->done();
        });
        $wg->wait();
        return $result;

    }


    public function __get($name)
    {
        return Context::get(__CLASS__ . ':' . $name);
    }

    public function __set($name, $value)
    {
        return Context::set(__CLASS__ . ':' . $name, $value);
    }


}