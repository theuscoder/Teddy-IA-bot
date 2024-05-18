<?php

declare(strict_types=1);

namespace Zanzara\Telegram\Type\Keyboard;

use Zanzara\Telegram\Type\WebApp\WebAppInfo;

/**
 * This object represents one button of the reply keyboard. For simple text buttons String can be used instead of this
 * object to specify text of the button. Optional fields request_contact, request_location, and request_poll are
 * mutually exclusive.
 *
 * More on https://core.telegram.org/bots/api#keyboardbutton
 */
class KeyboardButton
{

    /**
     * Text of the button. If none of the optional fields are used, it will be sent as a message when the button is pressed
     *
     * @var string
     */
    private $text;

    /**
     * Optional. If specified, pressing the button will open a list of suitable users.
     * Tapping on any user will send their identifier to the bot in a “user_shared” service message.
     * Available in private chats only.
     *
     * @var KeyboardButtonRequestUser|null
     */
    private $request_user;

    /**
     * Optional. If specified, pressing the button will open a list of suitable chats.
     * Tapping on a chat will send its identifier to the bot in a “chat_shared” service message.
     * Available in private chats only.
     *
     * @var KeyboardButtonRequestChat|null
     */
    private $request_chat;

    /**
     * Optional. If True, the user's phone number will be sent as a contact when the button is pressed. Available in private
     * chats only
     *
     * @var bool|null
     */
    private $request_contact;

    /**
     * Optional. If True, the user's current location will be sent when the button is pressed. Available in private chats only
     *
     * @var bool|null
     */
    private $request_location;

    /**
     * Optional. If specified, the user will be asked to create a poll and send it to the bot when the button is pressed.
     * Available in private chats only
     *
     * @var KeyboardButtonPollType|null
     */
    private $request_poll;

    /**
     * Optional. If specified, the described Web App will be launched when the button is pressed.
     * The Web App will be able to send a “web_app_data” service message.
     * Available in private chats only
     *
     * @var WebAppInfo|null
     */
    private $web_app;

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return KeyboardButtonRequestUser|null
     */
    public function getRequestUser(): ?KeyboardButtonRequestUser
    {
        return $this->request_user;
    }

    /**
     * @param KeyboardButtonRequestUser|null $request_user
     */
    public function setRequestUser(?KeyboardButtonRequestUser $request_user): void
    {
        $this->request_user = $request_user;
    }

    /**
     * @return KeyboardButtonRequestChat|null
     */
    public function getRequestChat(): ?KeyboardButtonRequestChat
    {
        return $this->request_chat;
    }

    /**
     * @param KeyboardButtonRequestChat|null $request_chat
     */
    public function setRequestChat(?KeyboardButtonRequestChat $request_chat): void
    {
        $this->request_chat = $request_chat;
    }

    /**
     * @return bool|null
     */
    public function getRequestContact(): ?bool
    {
        return $this->request_contact;
    }

    /**
     * @param bool|null $request_contact
     */
    public function setRequestContact(?bool $request_contact): void
    {
        $this->request_contact = $request_contact;
    }

    /**
     * @return bool|null
     */
    public function getRequestLocation(): ?bool
    {
        return $this->request_location;
    }

    /**
     * @param bool|null $request_location
     */
    public function setRequestLocation(?bool $request_location): void
    {
        $this->request_location = $request_location;
    }

    /**
     * @return KeyboardButtonPollType|null
     */
    public function getRequestPoll(): ?KeyboardButtonPollType
    {
        return $this->request_poll;
    }

    /**
     * @param KeyboardButtonPollType|null $request_poll
     */
    public function setRequestPoll(?KeyboardButtonPollType $request_poll): void
    {
        $this->request_poll = $request_poll;
    }

    /**
     * @return WebAppInfo|null
     */
    public function getWebApp(): ?WebAppInfo
    {
        return $this->web_app;
    }

    /**
     * @param WebAppInfo|null $web_app
     */
    public function setWebApp(?WebAppInfo $web_app): void
    {
        $this->web_app = $web_app;
    }

}