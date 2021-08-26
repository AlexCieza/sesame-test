<?php
declare(strict_types=1);

namespace App\Sellers\Application\Command\Seller\Add;

use App\Sellers\Domain\Model\Seller\Seller;
use App\Sellers\Domain\Service\Seller\SellerCreator;
use App\Sellers\Domain\Service\Seller\SellerExistsCheckerById;

final class AddSellerHandler
{
    private SellerExistsCheckerById $sellerExistsCheckerById;
    private SellerCreator $sellerCreator;

    public function __construct(SellerExistsCheckerById $sellerExistsCheckerById, SellerCreator $sellerCreator)
    {
        $this->sellerExistsCheckerById = $sellerExistsCheckerById;
        $this->sellerCreator = $sellerCreator;
    }

    public function handle(AddSellerCommand $command): void
    {
        $this->sellerExistsCheckerById->execute($command->sellerId());

        $seller = Seller::from(
            $command->sellerId(),
            $command->name(),
            $command->description(),
        );

        $this->sellerCreator->execute($seller);
    }
}
