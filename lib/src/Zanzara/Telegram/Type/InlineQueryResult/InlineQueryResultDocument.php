<?php

declare(strict_types=1);

namespace Zanzara\Telegram\Type\InlineQueryResult;

use Zanzara\Telegram\Type\Input\InputMessageContent;
use Zanzara\Telegram\Type\Keyboard\InlineKeyboardMarkup;

/**
 * Represents a link to a file. By default, this file will be sent by the user with an optional caption. Alternatively,
 * you can use input_message_content to send a message with the specified content instead of the file. Currently,
 * only .PDF and .ZIP files can be sent using this method.
 *
 * More on https://core.telegram.org/bots/api#inlinequeryresultdocument
 */
class InlineQueryResultDocument extends InlineQueryResult
{

    /**
     * Title for the result
     *
     * @var string
     */
    private $title;

    /**
     * Optional. Caption of the document to be sent, 0-1024 characters after entities parsing
     *
     * @var string|null
     */
    private $caption;

    /**
     * Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in
     * the media caption.
     *
     * @var string|null
     */
    private $parse_mode;

    /**
     * Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     *
     * @since zanzara 0.5.0, Telegram Bot Api 5.0
     *
     * @var \Zanzara\Telegram\Type\MessageEntity[]|null
     */
    private $caption_entities;

    /**
     * A valid URL for the file
     *
     * @var string
     */
    private $document_url;

    /**
     * Mime type of the content of the file, either "application/pdf" or "application/zip"
     *
     * @var string
     */
    private $mime_type;

    /**
     * Optional. Short description of the result
     *
     * @var string|null
     */
    private $description;

    /**
     * Optional. Inline keyboard attached to the message
     *
     * @var InlineKeyboardMarkup|null
     */
    private $reply_markup;

    /**
     * Optional. Content of the message to be sent instead of the file
     *
     * @var InputMessageContent|null
     */
    private $input_message_content;

    /**
     * Optional. URL of the thumbnail (jpeg only) for the file
     *
     * @var string|null
     */
    private $thumbnail_url;

    /**
     * Optional. Thumbnail width
     *
     * @var int|null
     */
    private $thumbnail_width;

    /**
     * Optional. Thumbnail height
     *
     * @var int|null
     */
    private $thumbnail_height;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getCaption(): ?string
    {
        return $this->caption;
    }

    /**
     * @param string|null $caption
     */
    public function setCaption(?string $caption): void
    {
        $this->caption = $caption;
    }

    /**
     * @return string|null
     */
    public function getParseMode(): ?string
    {
        return $this->parse_mode;
    }

    /**
     * @param string|null $parse_mode
     */
    public function setParseMode(?string $parse_mode): void
    {
        $this->parse_mode = $parse_mode;
    }

    /**
     * @return string
     */
    public function getDocumentUrl(): string
    {
        return $this->document_url;
    }

    /**
     * @param string $document_url
     */
    public function setDocumentUrl(string $document_url): void
    {
        $this->document_url = $document_url;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mime_type;
    }

    /**
     * @param string $mime_type
     */
    public function setMimeType(string $mime_type): void
    {
        $this->mime_type = $mime_type;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return InlineKeyboardMarkup|null
     */
    public function getReplyMarkup(): ?InlineKeyboardMarkup
    {
        return $this->reply_markup;
    }

    /**
     * @param InlineKeyboardMarkup|null $reply_markup
     */
    public function setReplyMarkup(?InlineKeyboardMarkup $reply_markup): void
    {
        $this->reply_markup = $reply_markup;
    }

    /**
     * @return InputMessageContent|null
     */
    public function getInputMessageContent(): ?InputMessageContent
    {
        return $this->input_message_content;
    }

    /**
     * @param InputMessageContent|null $input_message_content
     */
    public function setInputMessageContent(?InputMessageContent $input_message_content): void
    {
        $this->input_message_content = $input_message_content;
    }

    /**
     * @return string|null
     */
    public function getThumbUrl(): ?string
    {
        return $this->thumbnail_url;
    }

    /**
     * @param string|null $thumbnail_url
     */
    public function setThumbUrl(?string $thumbnail_url): void
    {
        $this->thumbnail_url = $thumbnail_url;
    }

    /**
     * @return int|null
     */
    public function getThumbWidth(): ?int
    {
        return $this->thumbnail_width;
    }

    /**
     * @param int|null $thumbnail_width
     */
    public function setThumbWidth(?int $thumbnail_width): void
    {
        $this->thumbnail_width = $thumbnail_width;
    }

    /**
     * @return int|null
     */
    public function getThumbHeight(): ?int
    {
        return $this->thumbnail_height;
    }

    /**
     * @param int|null $thumbnail_height
     */
    public function setThumbHeight(?int $thumbnail_height): void
    {
        $this->thumbnail_height = $thumbnail_height;
    }

    /**
     * @return \Zanzara\Telegram\Type\MessageEntity[]|null
     */
    public function getCaptionEntities(): ?array
    {
        return $this->caption_entities;
    }

    /**
     * @param \Zanzara\Telegram\Type\MessageEntity[]|null $caption_entities
     */
    public function setCaptionEntities(?array $caption_entities): void
    {
        $this->caption_entities = $caption_entities;
    }

}