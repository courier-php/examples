<?php
declare(strict_types = 1);

namespace Courier\Example\Event;

use Courier\Example\Domain\User;
use Courier\Message\EventInterface;

/**
 * An event that carries a $user object that has been registered.
 */
final class UserRegisteredEvent implements EventInterface {
  private User $user;

  public function __construct(User $user) {
    $this->user = $user;
  }

  public function getUser(): User {
    return $this->user;
  }

  public function toArray(): array {
    return [
      'user' => $this->user
    ];
  }
}
