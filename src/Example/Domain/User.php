<?php
declare(strict_types = 1);

namespace Courier\Example\Domain;

use JsonSerializable;
use ReturnTypeWillChange;

final class User implements JsonSerializable {
  private ?int $id;
  private string $email;

  public function __construct(
    string $email,
    ?int $id = null
  ) {
    $this->email = $email;
    $this->id    = $id;
  }

  public function getId(): ?int {
    return $this->id;
  }

  public function withId(?int $id): self {
    $clone = clone $this;
    $clone->id = $id;

    return $clone;
  }

  public function getEmail(): string {
    return $this->email;
  }

  public function withEmail(string $email): self {
    $clone = clone $this;
    $clone->email = $email;

    return $clone;
  }

  #[ReturnTypeWillChange]
  public function jsonSerialize(): array {
    return [
      'id'    => $this->id,
      'email' => $this->email
    ];
  }
}
