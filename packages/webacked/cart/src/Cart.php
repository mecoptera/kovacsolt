<?php
namespace Webacked\Cart;

use Closure;
use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Contracts\Events\Dispatcher;

class Cart {
    const DEFAULT_INSTANCE = 'default';

    private $session;
    private $events;
    private $instance;

    public function __construct(SessionManager $session, Dispatcher $events) {
        $this->session = $session;
        $this->events = $events;
        $this->instance(self::DEFAULT_INSTANCE);
    }

    public function instance($instance = null) {
        $instance = $instance ?: self::DEFAULT_INSTANCE;
        $this->instance = sprintf('%s.%s', 'cart', $instance);
        return $this;
    }

    public function add($item) {
        $this->session->put($this->instance, $item);
    }

    public function get() {
        return $this->session->get($this->instance);
    }
}
