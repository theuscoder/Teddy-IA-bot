<?php

use Zanzara\Config;
use Zanzara\Zanzara;

require __DIR__ . '/../bootstrap.php';

$config = new Config();
$config->setUpdateMode(Config::REACTPHP_WEBHOOK_MODE);
//$config->setWebhookTokenCheck(true);
$bot = new Zanzara($_ENV['BOT_TOKEN'], $config);

$bot->onUpdate(function (\Zanzara\Context $ctx) {
    $ctx->sendMessage('Hello');
});

$bot->run();