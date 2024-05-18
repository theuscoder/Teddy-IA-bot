<?php

declare(strict_types=1);

namespace Zanzara\Telegram\Type\Passport;

/**
 * Represents an issue with the translated version of a document. The error is considered resolved when a file with the
 * document translation change.
 *
 * More on https://core.telegram.org/bots/api#passportelementerrortranslationfiles
 */
class PassportElementErrorTranslationFiles extends PassportElementError
{

    /**
     * @var string[]
     */
    private $file_hashes;

    /**
     * Error message
     *
     * @var string
     */
    private $message;

    /**
     * @return string[]
     */
    public function getFileHashes(): array
    {
        return $this->file_hashes;
    }

    /**
     * @param string[] $file_hashes
     */
    public function setFileHashes(array $file_hashes): void
    {
        $this->file_hashes = $file_hashes;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

}