<?php

declare(strict_types=1);

namespace Zanzara\Test\Listener;

use PHPUnit\Framework\TestCase;
use Zanzara\Config;
use Zanzara\Context;
use Zanzara\Telegram\Type\MessageEntity;
use Zanzara\Zanzara;

/**
 *
 */
class CommandTest extends TestCase
{

    /**
     *
     */
    public function testCommand()
    {
        $config = new Config();
        $config->setUpdateMode(Config::WEBHOOK_MODE);
        $config->setSafeMode(true);
        $config->setUpdateStream(__DIR__ . '/../update_types/command.json');
        $bot = new Zanzara("test", $config);

        $bot->onCommand('start', function (Context $ctx) {
            $update = $ctx->getUpdate();
            $message = $update->getMessage();
            $this->assertSame(52259544, $update->getUpdateId());
            $this->assertSame(23756, $message->getMessageId());
            $this->assertSame(222222222, $message->getFrom()->getId());
            $this->assertSame(false, $message->getFrom()->isBot());
            $this->assertSame('Michael', $message->getFrom()->getFirstName());
            $this->assertSame('mscott', $message->getFrom()->getUsername());
            $this->assertSame('it', $message->getFrom()->getLanguageCode());
            $this->assertSame(222222222, $message->getChat()->getId());
            $this->assertSame('Michael', $message->getChat()->getFirstName());
            $this->assertSame('mscott', $message->getChat()->getUsername());
            $this->assertSame('private', $message->getChat()->getType());
            $this->assertSame(1584984664, $message->getDate());
            $this->assertSame('/start', $message->getText());
            $this->assertCount(1, $message->getEntities());
            $entity = $message->getEntities()[0];
            $this->assertInstanceOf(MessageEntity::class, $entity);
            $this->assertEquals(0, $entity->getOffset());
            $this->assertEquals(6, $entity->getLength());
            $this->assertEquals('bot_command', $entity->getType());
        });

        $bot->run();
    }

    /**
     *
     */
    public function testText()
    {
        $config = new Config();
        $config->setUpdateMode(Config::WEBHOOK_MODE);
        $config->setSafeMode(true);
        $config->setUpdateStream(__DIR__ . '/../update_types/message.json');
        $bot = new Zanzara("test", $config);

        $bot->onText('Hello', function (Context $ctx) {
            $message = $ctx->getMessage();
            $this->assertSame(52259544, $ctx->getUpdateId());
            $this->assertSame(23756, $message->getMessageId());
            $this->assertSame(222222222, $message->getFrom()->getId());
            $this->assertSame(false, $message->getFrom()->isBot());
            $this->assertSame('Michael', $message->getFrom()->getFirstName());
            $this->assertSame('mscott', $message->getFrom()->getUsername());
            $this->assertSame('it', $message->getFrom()->getLanguageCode());
            $this->assertSame(222222222, $message->getChat()->getId());
            $this->assertSame('Michael', $message->getChat()->getFirstName());
            $this->assertSame('mscott', $message->getChat()->getUsername());
            $this->assertSame('private', $message->getChat()->getType());
            $this->assertSame(1584984664, $message->getDate());
            $this->assertSame('Hello', $message->getText());
        });

        $bot->run();
    }

    public function testCommandWithParameters()
    {
        $config = new Config();
        $config->setUpdateMode(Config::WEBHOOK_MODE);
        $config->setSafeMode(true);
        $config->setUpdateStream(__DIR__ . '/../update_types/command_parameters.json');
        $bot = new Zanzara("test", $config);

        $bot->onCommand('start {param} {otherParam}', function (Context $ctx, $param, $otherParam) {
            $update = $ctx->getUpdate();
            $message = $update->getMessage();
            $this->assertSame(52259544, $update->getUpdateId());
            $this->assertSame(23756, $message->getMessageId());
            $this->assertSame(222222222, $message->getFrom()->getId());
            $this->assertSame(false, $message->getFrom()->isBot());
            $this->assertSame('Michael', $message->getFrom()->getFirstName());
            $this->assertSame('mscott', $message->getFrom()->getUsername());
            $this->assertSame('it', $message->getFrom()->getLanguageCode());
            $this->assertSame(222222222, $message->getChat()->getId());
            $this->assertSame('Michael', $message->getChat()->getFirstName());
            $this->assertSame('mscott', $message->getChat()->getUsername());
            $this->assertSame('private', $message->getChat()->getType());
            $this->assertSame(1584984664, $message->getDate());
            $this->assertSame('/start ciao hello', $message->getText());
            $this->assertSame('ciao', $param);
            $this->assertSame('hello', $otherParam);
            $this->assertCount(1, $message->getEntities());
            $entity = $message->getEntities()[0];
            $this->assertInstanceOf(MessageEntity::class, $entity);
            $this->assertEquals(0, $entity->getOffset());
            $this->assertEquals(6, $entity->getLength());
            $this->assertEquals('bot_command', $entity->getType());
        });

        $bot->run();
    }

}
