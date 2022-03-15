<?php
declare(strict_types = 1);

namespace Courier\Example\Command;

use Courier\Example\Domain\User;
use Courier\Message\CommandInterface;

/**
 * A command that carries a user $email that must be registered.
 */
final class RegisterUserCommand implements CommandInterface {
  private string $email;

  public function __construct(string $email) {
    $this->email = $email;
  }

  public function getEmail(): string {
    return $this->email;
  }

  public function toArray(): array {
    return [
      'email' => $this->email
    ];
  }
}
