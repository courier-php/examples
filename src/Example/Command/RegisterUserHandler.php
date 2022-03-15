<?php
declare(strict_types = 1);

namespace Courier\Example\Command;

use Courier\Client\Producer;
use Courier\Example\Domain\User;
use Courier\Example\Event\RegistrationFailedEvent;
use Courier\Example\Event\UserRegisteredEvent;
use Courier\Message\CommandInterface;
use Courier\Processor\Handler\HandlerResultEnum;
use Courier\Processor\Handler\InvokeHandlerInterface;

/**
 * A handler that registers $user objects.
 */
final class RegisterUserHandler implements InvokeHandlerInterface {
  private Producer $producer;

  public function __construct(Producer $producer) {
    $this->producer = $producer;
  }

  public function __invoke(CommandInterface $command, array $attributes = []): HandlerResultEnum {
    $email = $command->getEmail();

    echo 'Registering user ', $email, PHP_EOL;

    $this->producer->sendEvent(
      new UserRegisteredEvent(
        new User(
          $email,
          mt_rand()
        )
      )
    );

    return HandlerResultEnum::ACCEPT;
  }
}
