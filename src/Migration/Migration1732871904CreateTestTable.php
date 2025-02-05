<?php declare(strict_types=1);

namespace Docs\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1732871904CreateTestTable extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1732871904;
    }

    public function update(Connection $connection): void
    {
        $sql = <<<SQL
CREATE TABLE IF NOT EXISTS `docs_product_extension` (
    `id` BINARY(16) NOT NULL,
    `product_id` BINARY(16) NULL,
    `product_version_id` BINARY(16) NULL,
    `custom_string` VARCHAR(255) NULL,
    `created_at` DATETIME(3) NOT NULL,
    `updated_at` DATETIME(3) NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `unique.docs_product_extension.product` UNIQUE (`product_id`, `product_version_id`),
    CONSTRAINT `fk.docs_product_extension.product_id` FOREIGN KEY (`product_id`, `product_version_id`) REFERENCES `product` (`id`, `version_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
SQL;
        $connection->executeStatement($sql);
    }

    public function updateDestructive(Connection $connection): void
    {
    }
}
