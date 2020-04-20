<?php


namespace App\Aspect;


use App\Controller\IndexController;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\Di\Exception\Exception;

/**
 * @Aspect()
 */
class IndexAspect extends AbstractAspect
{

    public $classes = [
        IndexController::class.'::'.'index',
    ];


    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        try {

            var_dump('切面before');
            $result = $proceedingJoinPoint->process();
            var_dump('切面after');
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return 'before' . $result .'after';
    }
}