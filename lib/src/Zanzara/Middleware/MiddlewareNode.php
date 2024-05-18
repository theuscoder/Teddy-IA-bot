<?php

declare(strict_types=1);

namespace Zanzara\Middleware;

use Zanzara\Context;

/**
 * A node of the middleware stack.
 * The last node is the callback to be executed and does not have a next node.
 *
 */
class MiddlewareNode
{

    /**
     * @var MiddlewareInterface|callable
     */
    private $current;

    /**
     * @var MiddlewareNode|null
     */
    private $next;

    /**
     * @param MiddlewareInterface|callable $current
     * @param MiddlewareNode|null $next
     */
    public function __construct($current, ?MiddlewareNode $next = null)
    {
        $this->current = $current;
        $this->next = $next;
    }

    /**
     * @param Context $ctx
     */
    public function __invoke(Context $ctx)
    {
        if ($this->current instanceof MiddlewareInterface) {
            $this->current->handle($ctx, $this->next);
        } else {
            call_user_func($this->current, $ctx, $this->next);
        }
    }

}
