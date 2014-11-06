<?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace WhoopsPimple;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Whoops\Handler\PlainTextHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class WhoopsServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $this->registerErrorPageHandler($container);
        $this->registerExceptionHandler($container);
        $this->registerWhoops($container);

        if (set_exception_handler($container['whoops.exception_handler']) !== null) {
            restore_exception_handler();
        }

        $container['whoops']->register();
    }

    private function registerWhoops(Container $container)
    {
        $container['whoops'] = function (Container $container) {
            $run = new Run;
            $run->allowQuit(false);
            $run->pushHandler($container['whoops.error_page_handler']);
            return $run;
        };
    }

    private function registerErrorPageHandler(Container $container)
    {
        $container['whoops.error_page_handler'] = function () {
            if (PHP_SAPI === 'cli') {
                return new PlainTextHandler;
            } else {
                return new PrettyPageHandler;
            }
        };
    }

    private function registerExceptionHandler(Container $container)
    {
        $container['whoops.exception_handler'] = $container->protect(function ($e) use ($container) {
            $method = Run::EXCEPTION_HANDLER;
            ob_start();
            $container['whoops']->$method($e);
            $response = ob_get_clean();
            $code = $e instanceof HttpException ? $e->getStatusCode() : 500;
            return new Response($response, $code);
        });
    }
}
