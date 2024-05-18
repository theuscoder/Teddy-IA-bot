<?php

declare(strict_types=1);

namespace Zanzara\Test\Middleware;

use PHPUnit\Framework\TestCase;
use Zanzara\Config;
use Zanzara\Context;
use Zanzara\Zanzara;

/**
 *
 */
class MiddlewareTest extends TestCase
{

    /**
     * Tests the middleware stack is executed in the correct order.
     *
     */
    public function testMiddleware()
    {
        $config = new Config();
        $config->setUpdateMode(Config::WEBHOOK_MODE);
        $config->setSafeMode(true);
        $config->setUpdateStream(__DIR__ . '/../update_types/command.json');
        $bot = new Zanzara("test", $config);

        $bot->middleware(new FirstMiddleware());
        $secondMiddleware = function (Context $ctx, $next) {
            if ($ctx->get('first') === 'executed') {
                $ctx->set('second', 'executed');
                $next($ctx);
            }
        };
        $bot->middleware($secondMiddleware);

        $bot->onUpdate(function (Context $ctx) {

            $this->assertSame('executed', $ctx->get('fourth'));

        })->middleware(new FourthMiddleware())->middleware(new ThirdMiddleware());

        $bot->run();
    }

    public function testMiddlewareOnFallback()
    {
        $config = new Config();
        $config->setUpdateMode(Config::WEBHOOK_MODE);
        $config->setSafeMode(true);
        $config->setUpdateStream(__DIR__ . '/../update_types/command.json');
        $bot = new Zanzara("test", $config);

        $bot->middleware(function (Context $ctx, $next) {
            $ctx->set('exec', true);
            $next($ctx);
        });

        $bot->fallback(function (Context $ctx) {
            $this->assertNotNull($ctx->get('exec'));
        });

        $bot->run();
    }

}
