<?php
declare(strict_types=1);

namespace App\Sellers\Domain\Model\Seller;

final class Seller implements \JsonSerializable
{
    private string $id;
    private string $name;
    private string $description;

    private function __construct(string $id, string $name, string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    public static function from(string $id, string $name, string $description): self
    {
        return new self($id, $name, $description);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
