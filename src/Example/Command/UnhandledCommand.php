<?php
declare(strict_types = 1);

namespace Courier\Example\Command;

use Courier\Message\CommandInterface;

/**
 * This is just an example command to show what happens with commands not bonded to a handler.
 */
final class UnhandledCommand implements CommandInterface {
  public function toArray(): array {
    return [];
  }
}
