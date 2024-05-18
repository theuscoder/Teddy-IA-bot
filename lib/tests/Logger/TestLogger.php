<?php

declare(strict_types=1);

namespace Zanzara\Test\Logger;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Zanzara\Config;
use Zanzara\Zanzara;

/**
 * These tests actually call the Telegram Bot Api, so they are meant to be executed when needed, not on each test suite
 * execution. To skip them "Test" is used as prefix instead of suffix.
 *
 */
class TestLogger extends TestCase
{

    public function testLog()
    {
        $logFile = __DIR__ . '/app.log';
        if (file_exists($logFile)) {
            unlink($logFile);
        }
        // note: production logger should by async. See https://github.com/WyriHaximus/reactphp-psr-3-loggly
        $logger = new Logger('zanzara');
        $logger->pushHandler(new StreamHandler($logFile, Logger::WARNING));
        $config = new Config();
        $config->setLogger($logger);
        $bot = new Zanzara($_ENV['BOT_TOKEN'], $config);
        $telegram = $bot->getTelegram();
        $telegram->sendMessage('Hello', ['chat_id' => 12345678]);
        $bot->getLoop()->run();
        $this->assertFileExists($logFile);
        $content = file_get_contents($logFile);
        $regex = "/\[.*\] zanzara.ERROR: Failed to call Telegram Bot Api, .*/";
        $this->assertMatchesRegularExpression($regex, $content);
        unlink($logFile);
    }

}
