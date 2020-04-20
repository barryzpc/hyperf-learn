<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Controller;


use Hyperf\View\RenderInterface;

class UrlController extends AbstractController
{

    /**
     * 短链生成页面
     */
    public function index()
    {

        $method = $this->request->getMethod();
        return $this->render->render('Url/index',['title' => '测试', 'name' => $method]);

    }

    /**
     * @param string $surl
     * @return array|\Psr\Http\Message\ResponseInterface
     */
    public function short(string $surl)
    {
        $method = $this->request->getMethod();
        if($surl == 'aa'){
            return  $this->response->redirect('https://www.hao123.com/',302,'https');
        }

        return [
            'method' => $method,
            'message' => "Hello {$surl}.",
        ];
    }

}
