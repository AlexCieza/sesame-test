<?php
declare(strict_types=1);

namespace App\Sellers\Infrastructure\Domain\Model\Seller;

use App\Sellers\Domain\Model\Seller\Seller;
use App\Sellers\Domain\Model\Seller\SellerRepository;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\ParameterType;

final class DbalSellerRepository implements SellerRepository
{
    private const TABLE_NAME = 'promofarma.sellers';

    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findById(string $id): ?Seller
    {
        $sql = "
            SELECT 
                s.id AS id,
                s.name AS name,
                s.description AS description
            FROM promofarma.sellers s
            WHERE s.id = :id
        ";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('id', $id, ParameterType::STRING);
        $stmt->execute();

        if (0 === $stmt->rowCount()) {
            return null;
        }

        return $this->mapSeller($stmt->fetch(FetchMode::ASSOCIATIVE));
    }

    public function add(Seller $seller): void
    {
        $this->connection->insert(
            self::TABLE_NAME,
            [
                'id' => $seller->id(),
                'name' => $seller->name(),
                'description' => $seller->description(),
            ],
        );
    }

    private function mapSeller(array $seller): Seller
    {
        return Seller::from(
            $seller['id'],
            $seller['name'],
            $seller['description'],
        );
    }
}
