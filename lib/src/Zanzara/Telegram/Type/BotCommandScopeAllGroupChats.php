<?php

declare(strict_types=1);

namespace Zanzara\Telegram\Type;

/**
 * Represents the scope of bot commands, covering all group and supergroup chats.
 *
 * More on https://core.telegram.org/bots/api#botcommandscopeallgroupchats
 *
 */
class BotCommandScopeAllGroupChats extends BotCommandScope
{

    /**
     * Scope type, must be all_group_chats
     *
     * @var string
     */
    private $type;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

}
