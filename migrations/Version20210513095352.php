<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210513095352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE addresses (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, country_id INT NOT NULL, street VARCHAR(255) NOT NULL, housenr INT NOT NULL, INDEX IDX_6FCA75168BAC62AF (city_id), INDEX IDX_6FCA7516F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cities (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, postalcode INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE countries (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_status (id INT AUTO_INCREMENT NOT NULL, stat_description VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordered_product (id INT AUTO_INCREMENT NOT NULL, order_id_id INT NOT NULL, product_id_id INT NOT NULL, ordered_prod_price INT DEFAULT NULL, INDEX IDX_E6F097B6FCDAEAAA (order_id_id), INDEX IDX_E6F097B6DE18E50B (product_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, order_stat_id INT NOT NULL, order_date DATETIME NOT NULL, order_total_price INT DEFAULT NULL, order_total_prod INT DEFAULT NULL, INDEX IDX_E52FFDEEFF2A8640 (order_stat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE addresses ADD CONSTRAINT FK_6FCA75168BAC62AF FOREIGN KEY (city_id) REFERENCES cities (id)');
        $this->addSql('ALTER TABLE addresses ADD CONSTRAINT FK_6FCA7516F92F3E70 FOREIGN KEY (country_id) REFERENCES countries (id)');
        $this->addSql('ALTER TABLE ordered_product ADD CONSTRAINT FK_E6F097B6FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE ordered_product ADD CONSTRAINT FK_E6F097B6DE18E50B FOREIGN KEY (product_id_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEFF2A8640 FOREIGN KEY (order_stat_id) REFERENCES order_status (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE addresses DROP FOREIGN KEY FK_6FCA75168BAC62AF');
        $this->addSql('ALTER TABLE addresses DROP FOREIGN KEY FK_6FCA7516F92F3E70');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEFF2A8640');
        $this->addSql('ALTER TABLE ordered_product DROP FOREIGN KEY FK_E6F097B6FCDAEAAA');
        $this->addSql('DROP TABLE addresses');
        $this->addSql('DROP TABLE cities');
        $this->addSql('DROP TABLE countries');
        $this->addSql('DROP TABLE order_status');
        $this->addSql('DROP TABLE ordered_product');
        $this->addSql('DROP TABLE orders');
    }
}
