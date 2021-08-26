<?php
declare(strict_types=1);

namespace App\Sellers\Application\Command\Seller\Add;

use Ramsey\Uuid\Uuid;

final class AddSellerCommand
{
    private string $sellerId;
    private string $name;
    private string $description;

    private function __construct($sellerId, $name, $description)
    {
        $this->sellerId = Uuid::fromString($sellerId)->toString();
        $this->name = $name;
        $this->description = $description;
    }

    public static function create($sellerId, $name, $description): self
    {
        return new self($sellerId, $name, $description);
    }

    public function sellerId(): string
    {
        return $this->sellerId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }
}
