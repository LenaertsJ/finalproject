<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210605213506 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEFF2A8640');
        $this->addSql('DROP INDEX IDX_E52FFDEEFF2A8640 ON orders');
        $this->addSql('ALTER TABLE orders ADD total_price INT DEFAULT NULL, ADD total_quantity INT DEFAULT NULL, DROP order_total_price, DROP order_total_prod, CHANGE order_stat_id address_id INT NOT NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEEF5B7AF75 ON orders (address_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEF5B7AF75');
        $this->addSql('DROP INDEX IDX_E52FFDEEF5B7AF75 ON orders');
        $this->addSql('ALTER TABLE orders ADD order_total_price INT DEFAULT NULL, ADD order_total_prod INT DEFAULT NULL, DROP total_price, DROP total_quantity, CHANGE address_id order_stat_id INT NOT NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEFF2A8640 FOREIGN KEY (order_stat_id) REFERENCES order_status (id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEEFF2A8640 ON orders (order_stat_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
