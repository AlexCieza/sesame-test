<?php
declare(strict_types=1);

namespace App\Sellers\Domain\Model\Seller;

interface SellerRepository
{
    public function findById(string $id): ?Seller;

    public function add(Seller $seller): void;
}
