<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210607203005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customers (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customers_address (customers_id INT NOT NULL, address_id INT NOT NULL, INDEX IDX_3106BC64C3568B40 (customers_id), INDEX IDX_3106BC64F5B7AF75 (address_id), PRIMARY KEY(customers_id, address_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE customers_address ADD CONSTRAINT FK_3106BC64C3568B40 FOREIGN KEY (customers_id) REFERENCES customers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customers_address ADD CONSTRAINT FK_3106BC64F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE order_status');
        $this->addSql('ALTER TABLE ordered_product DROP FOREIGN KEY FK_E6F097B6DE18E50B');
        $this->addSql('ALTER TABLE ordered_product DROP FOREIGN KEY FK_E6F097B6FCDAEAAA');
        $this->addSql('DROP INDEX IDX_E6F097B6DE18E50B ON ordered_product');
        $this->addSql('DROP INDEX IDX_E6F097B6FCDAEAAA ON ordered_product');
        $this->addSql('ALTER TABLE ordered_product ADD product_id INT NOT NULL, ADD price DOUBLE PRECISION NOT NULL, DROP order_id_id, DROP product_id_id, CHANGE ordered_prod_price ordered_prod_order_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ordered_product ADD CONSTRAINT FK_E6F097B68C5FF972 FOREIGN KEY (ordered_prod_order_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE ordered_product ADD CONSTRAINT FK_E6F097B64584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('CREATE INDEX IDX_E6F097B68C5FF972 ON ordered_product (ordered_prod_order_id)');
        $this->addSql('CREATE INDEX IDX_E6F097B64584665A ON ordered_product (product_id)');
        $this->addSql('ALTER TABLE orders ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE9395C3F3 FOREIGN KEY (customer_id) REFERENCES customers (id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEE9395C3F3 ON orders (customer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers_address DROP FOREIGN KEY FK_3106BC64C3568B40');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE9395C3F3');
        $this->addSql('CREATE TABLE order_status (id INT AUTO_INCREMENT NOT NULL, stat_description VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE customers_address');
        $this->addSql('ALTER TABLE ordered_product DROP FOREIGN KEY FK_E6F097B68C5FF972');
        $this->addSql('ALTER TABLE ordered_product DROP FOREIGN KEY FK_E6F097B64584665A');
        $this->addSql('DROP INDEX IDX_E6F097B68C5FF972 ON ordered_product');
        $this->addSql('DROP INDEX IDX_E6F097B64584665A ON ordered_product');
        $this->addSql('ALTER TABLE ordered_product ADD product_id_id INT NOT NULL, DROP price, CHANGE product_id order_id_id INT NOT NULL, CHANGE ordered_prod_order_id ordered_prod_price INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ordered_product ADD CONSTRAINT FK_E6F097B6DE18E50B FOREIGN KEY (product_id_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE ordered_product ADD CONSTRAINT FK_E6F097B6FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES orders (id)');
        $this->addSql('CREATE INDEX IDX_E6F097B6DE18E50B ON ordered_product (product_id_id)');
        $this->addSql('CREATE INDEX IDX_E6F097B6FCDAEAAA ON ordered_product (order_id_id)');
        $this->addSql('DROP INDEX IDX_E52FFDEE9395C3F3 ON orders');
        $this->addSql('ALTER TABLE orders DROP customer_id');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
