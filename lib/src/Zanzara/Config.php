<?php

declare(strict_types=1);

namespace Zanzara;

use DI\Container;
use Psr\Log\LoggerInterface;
use React\Cache\CacheInterface;
use React\EventLoop\LoopInterface;
use React\Http\Browser;
use React\Socket\Connector;
use Zanzara\UpdateMode\Polling;
use Zanzara\UpdateMode\ReactPHPWebhook;
use Zanzara\UpdateMode\UpdateModeInterface;
use Zanzara\UpdateMode\Webhook;

/**
 *
 */
class Config
{

    public const WEBHOOK_MODE = Webhook::class;
    public const POLLING_MODE = Polling::class;
    public const REACTPHP_WEBHOOK_MODE = ReactPHPWebhook::class;

    public const PARSE_MODE_HTML = "HTML";
    public const PARSE_MODE_MARKDOWN = "MarkdownV2";
    public const PARSE_MODE_MARKDOWN_LEGACY = "Markdown";

    /**
     * @var string
     */
    private $botToken;

    /**
     * @var LoopInterface|null
     */
    private $loop;

    /**
     * @var CacheInterface|null
     */
    private $cache;

    /**
     * @var boolean
     */
    private $useReactFileSystem = false;

    /**
     * @var Container|null
     */
    private $container;

    /**
     * @var string|UpdateModeInterface
     */
    private $updateMode = self::POLLING_MODE;

    /**
     * @var string|null
     */
    private $parseMode;

    /**
     * @var string
     */
    private $updateStream = 'php://input';

    /**
     * @var string
     */
    private $apiTelegramUrl = 'https://api.telegram.org';

    /**
     * @var string
     */
    private $serverUri = "0.0.0.0:8080";

    /**
     * @var array
     */
    private $serverContext = [];

    /**
     * @var float
     */
    private $bulkMessageInterval = 2.0;

    /**
     * @var bool
     */
    private $webhookTokenCheck = false;

    /**
     * Timeout in seconds for long polling. Defaults to 0, i.e. usual short polling. Should be positive, short polling
     * should be used for testing purposes only.
     *
     * @var int
     */
    private $pollingTimeout = 50;

    /**
     * Limits the number of updates to be retrieved. Values between 1-100 are accepted. Defaults to 100.
     *
     * @var int
     */
    private $pollingLimit = 100;

    /**
     * Defines when we have to retry after the processing of an update has given error.
     *
     * @var float
     */
    private $pollingRetry = 2.0;

    /**
     * A JSON-serialized list of the update types you want your bot to receive. For example, specify
     * [“message”, “edited_channel_post”, “callback_query”] to only receive updates of these types. See Update for a
     * complete list of available update types. Specify an empty list to receive all updates regardless of type
     * (default). If not specified, the previous setting will be used. Please note that this parameter doesn't affect
     * updates created before the call to the getUpdates, so unwanted updates may be received for a short period of time.
     *
     * @var array
     */
    private $pollingAllowedUpdates = [];

    /**
     * @var LoggerInterface|null
     */
    private $logger;

    /**
     * @var bool
     */
    private $disableZanzaraLogger = false;

    /**
     * @var callable|null
     */
    private $errorHandler;

    /**
     * Default ttl in seconds. Null means that item will stay in the cache
     * for as long as the underlying implementation supports.
     * Check reactphp cache implementation for more information
     * @var float|null
     */
    private $cacheTtl = 180;

    /**
     * @var float|null
     */
    private $conversationTtl = 60 * 60 * 24;

    /**
     * @var Connector|null
     */
    private $connector;

    /**
     *
     * @since 0.5.1
     * @var array
     */
    private $connectorOptions = [];

    /**
     *
     * @since 0.5.1
     * @var string|null
     */
    private $proxyUrl;

    /**
     *
     * @since 0.5.1
     * @var array
     */
    private $proxyHttpHeaders = [];

    /**
     * @var Browser|null
     */
    private $browser;

    /**
     * @var string
     */
    private $contextClass = Context::class;

    /**
     * @var bool
     */
    private bool $safeMode = false;

    /**
     * @var array
     */
    private array $telegramIpv4Ranges = [
        '149.154.160.0' => '149.154.175.255', // literally 149.154.160.0/20
        '91.108.4.0' => '91.108.7.255',    // literally 91.108.4.0/22
    ];

    /**
     * @return LoopInterface|null
     */
    public function getLoop(): ?LoopInterface
    {
        return $this->loop;
    }

    /**
     * @param LoopInterface|null $loop
     */
    public function setLoop(?LoopInterface $loop): void
    {
        $this->loop = $loop;
    }

    /**
     * @return string|UpdateModeInterface
     */
    public function getUpdateMode()
    {
        return $this->updateMode;
    }

    /**
     * @param string $updateMode
     */
    public function setUpdateMode(string $updateMode): void
    {
        $this->updateMode = $updateMode;
    }

    /**
     * @return string|null
     */
    public function getParseMode(): ?string
    {
        return $this->parseMode;
    }

    /**
     * @param string|null $parseMode
     */
    public function setParseMode(?string $parseMode): void
    {
        $this->parseMode = $parseMode;
    }

    /**
     * @return string
     */
    public function getUpdateStream(): string
    {
        return $this->updateStream;
    }

    /**
     * @param string $updateStream
     */
    public function setUpdateStream(string $updateStream): void
    {
        $this->updateStream = $updateStream;
    }

    /**
     * @return string
     */
    public function getApiTelegramUrl(): string
    {
        return $this->apiTelegramUrl;
    }

    /**
     * @param string $apiTelegramUrl
     */
    public function setApiTelegramUrl(string $apiTelegramUrl): void
    {
        $this->apiTelegramUrl = $apiTelegramUrl;
    }

    /**
     * @return string
     */
    public function getServerUri(): string
    {
        return $this->serverUri;
    }

    /**
     * @param string $serverUri
     */
    public function setServerUri(string $serverUri): void
    {
        $this->serverUri = $serverUri;
    }

    /**
     * @return array
     */
    public function getServerContext(): array
    {
        return $this->serverContext;
    }

    /**
     * @param array $serverContext
     */
    public function setServerContext(array $serverContext): void
    {
        $this->serverContext = $serverContext;
    }

    /**
     * @return float
     */
    public function getBulkMessageInterval(): float
    {
        return $this->bulkMessageInterval;
    }

    /**
     * @param float $bulkMessageInterval
     */
    public function setBulkMessageInterval(float $bulkMessageInterval): void
    {
        $this->bulkMessageInterval = $bulkMessageInterval;
    }

    /**
     * @return bool
     */
    public function isWebhookTokenCheckEnabled(): bool
    {
        return $this->webhookTokenCheck;
    }

    /**
     * @param bool $webhookTokenCheck
     */
    public function enableWebhookTokenCheck(bool $webhookTokenCheck): void
    {
        $this->webhookTokenCheck = $webhookTokenCheck;
    }

    /**
     * @return int
     */
    public function getPollingTimeout(): int
    {
        return $this->pollingTimeout;
    }

    /**
     * @param int $pollingTimeout
     */
    public function setPollingTimeout(int $pollingTimeout): void
    {
        $this->pollingTimeout = $pollingTimeout;
    }

    /**
     * @return int
     */
    public function getPollingLimit(): int
    {
        return $this->pollingLimit;
    }

    /**
     * @param int $pollingLimit
     */
    public function setPollingLimit(int $pollingLimit): void
    {
        $this->pollingLimit = $pollingLimit;
    }

    /**
     * @return array
     */
    public function getPollingAllowedUpdates(): array
    {
        return $this->pollingAllowedUpdates;
    }

    /**
     * @param array $pollingAllowedUpdates
     */
    public function setPollingAllowedUpdates(array $pollingAllowedUpdates): void
    {
        $this->pollingAllowedUpdates = $pollingAllowedUpdates;
    }

    /**
     * @return LoggerInterface|null
     */
    public function getLogger(): ?LoggerInterface
    {
        return $this->logger;
    }

    /**
     * @param LoggerInterface|null $logger
     * @param bool $disableZanzaraLogger
     */
    public function setLogger(?LoggerInterface $logger, bool $disableZanzaraLogger = false): void
    {
        $this->logger = $logger;
        $this->disableZanzaraLogger = $disableZanzaraLogger;
    }

    /**
     * @return bool
     */
    public function getDisableZanzaraLogger(): bool
    {
        return $this->disableZanzaraLogger;
    }

    /**
     * @param bool $bool
     */
    public function setDisableZanzaraLogger(bool $bool): void
    {
        $this->disableZanzaraLogger = $bool;
    }

    /**
     * @return CacheInterface|null
     */
    public function getCache(): ?CacheInterface
    {
        return $this->cache;
    }

    /**
     * @param CacheInterface|null $cache
     */
    public function setCache(?CacheInterface $cache): void
    {
        $this->cache = $cache;
    }

    /**
     * @return Container|null
     */
    public function getContainer(): ?Container
    {
        return $this->container;
    }

    /**
     * @param Container|null $container
     */
    public function setContainer(?Container $container): void
    {
        $this->container = $container;
    }

    /**
     * @return string
     */
    public function getBotToken(): string
    {
        return $this->botToken;
    }

    /**
     * @param string $botToken
     */
    public function setBotToken(string $botToken): void
    {
        $this->botToken = $botToken;
    }

    /**
     * @param bool $bool
     */
    public function useReactFileSystem(bool $bool)
    {
        $this->useReactFileSystem = $bool;
    }

    /**
     * @return bool
     */
    public function isReactFileSystem()
    {
        return $this->useReactFileSystem;
    }

    /**
     * @return callable|null
     * @deprecated
     * @see Zanzara::callOnException()
     */
    public function getErrorHandler(): ?callable
    {
        return $this->errorHandler;
    }

    /**
     * @param callable|null $errorHandler
     * @deprecated use Zanzara::onException() instead.
     * @see Zanzara::onException()
     */
    public function setErrorHandler(?callable $errorHandler): void
    {
        $this->errorHandler = $errorHandler;
    }

    /**
     * @return float|null
     */
    public function getCacheTtl(): ?float
    {
        return $this->cacheTtl;
    }

    /**
     * @param float|null $cacheTtl
     */
    public function setCacheTtl(?float $cacheTtl): void
    {
        $this->cacheTtl = $cacheTtl;
    }

    /**
     * @return Connector|null
     */
    public function getConnector(): ?Connector
    {
        return $this->connector;
    }

    /**
     * @param Connector|null $connector
     */
    public function setConnector(?Connector $connector): void
    {
        $this->connector = $connector;
    }

    /**
     * @return array
     */
    public function getConnectorOptions(): array
    {
        return $this->connectorOptions;
    }

    /**
     * @param array $connectorOptions
     */
    public function setConnectorOptions(array $connectorOptions): void
    {
        $this->connectorOptions = $connectorOptions;
    }

    /**
     * @return string|null
     */
    public function getProxyUrl(): ?string
    {
        return $this->proxyUrl;
    }

    /**
     * @param string|null $proxyUrl
     */
    public function setProxyUrl(?string $proxyUrl): void
    {
        $this->proxyUrl = $proxyUrl;
    }

    /**
     * @return array
     */
    public function getProxyHttpHeaders(): array
    {
        return $this->proxyHttpHeaders;
    }

    /**
     * @param array $proxyHttpHeaders
     */
    public function setProxyHttpHeaders(array $proxyHttpHeaders): void
    {
        $this->proxyHttpHeaders = $proxyHttpHeaders;
    }

    /**
     * @return Browser|null
     */
    public function getBrowser(): ?Browser
    {
        return $this->browser;
    }

    /**
     * @param Browser|null $browser
     */
    public function setBrowser(?Browser $browser): void
    {
        $this->browser = $browser;
    }

    /**
     * @return float|null
     */
    public function getConversationTtl(): ?float
    {
        return $this->conversationTtl;
    }

    /**
     * @param float|null $conversationTtl
     */
    public function setConversationTtl(?float $conversationTtl): void
    {
        $this->conversationTtl = $conversationTtl;
    }

    /**
     * @return float
     */
    public function getPollingRetry(): float
    {
        return $this->pollingRetry;
    }

    /**
     * @param float $pollingRetry
     */
    public function setPollingRetry(float $pollingRetry): void
    {
        $this->pollingRetry = $pollingRetry;
    }

    /**
     * @return string
     */
    public function getContextClass(): string
    {
        return $this->contextClass;
    }

    /**
     * @param string $contextClass
     */
    public function setContextClass(string $contextClass): void
    {
        $this->contextClass = $contextClass;
    }

    /**
     * @param bool $mode
     * @return void
     */
    public function setSafeMode(bool $mode): void
    {
        $this->safeMode = $mode;
    }

    /**
     * @return bool
     */
    public function getSafeMode(): bool
    {
        return $this->safeMode;
    }

    /**
     * @return array
     */
    public function getTelegramIpv4Ranges(): array
    {
        return $this->telegramIpv4Ranges;
    }

    /**
     * @param array $telegramIpv4Ranges
     */
    public function setTelegramIpv4Ranges(array $telegramIpv4Ranges): void
    {
        $this->telegramIpv4Ranges = $telegramIpv4Ranges;
    }
}
