<?php
declare(strict_types=1);

namespace App\Sellers\Domain\Model\Seller\Exception;

final class SellerNotFoundException extends \Exception
{
    private function __construct(string $id)
    {
        parent::__construct(
            \sprintf('Seller not found with id %s' , $id),
        );
    }

    public static function fromId(string $id): self
    {
        return new self($id);
    }
}
