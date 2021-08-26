<?php
declare(strict_types=1);

namespace App\Sellers\Domain\Service\Seller;

use App\Sellers\Domain\Model\Seller\Exception\SellerNotFoundException;
use App\Sellers\Domain\Model\Seller\Seller;
use App\Sellers\Domain\Model\Seller\SellerRepository;

final class SellerExistsCheckerById
{
    private SellerRepository $sellerRepository;

    public function __construct(SellerRepository $sellerRepository)
    {
        $this->sellerRepository = $sellerRepository;
    }

    public function execute(string $id): void
    {
        $seller = $this->sellerRepository->findById($id);

        if (null === $seller) {
            return;
        }

        throw SellerNotFoundException::fromId($id);
    }
}
