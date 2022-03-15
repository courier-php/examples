<?php
declare(strict_types = 1);

namespace Courier\Example\Event;

use Courier\Message\EventInterface;
use Courier\Processor\Listener\InvokeListenerInterface;

/**
 * A listener that logs $user objects that have been registered.
 */
final class UserRegisteredListener implements InvokeListenerInterface {
  public function __invoke(EventInterface $event, array $attributes = []): void {
    $user = $event->getUser();

    echo 'User ', $user->getEmail(), ' got registered with id ', $user->getId(), PHP_EOL;
  }
}
