<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210526092008 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, street VARCHAR(255) NOT NULL, house_nr INT NOT NULL, postcode INT NOT NULL, city VARCHAR(50) NOT NULL, country VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE families (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_status (id INT AUTO_INCREMENT NOT NULL, stat_description VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordered_product (id INT AUTO_INCREMENT NOT NULL, order_id_id INT NOT NULL, product_id_id INT NOT NULL, ordered_prod_price INT DEFAULT NULL, INDEX IDX_E6F097B6FCDAEAAA (order_id_id), INDEX IDX_E6F097B6DE18E50B (product_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, order_stat_id INT NOT NULL, order_date DATETIME NOT NULL, order_total_price INT DEFAULT NULL, order_total_prod INT DEFAULT NULL, INDEX IDX_E52FFDEEFF2A8640 (order_stat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plants (id INT AUTO_INCREMENT NOT NULL, family_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, latin_name VARCHAR(100) DEFAULT NULL, symbolism LONGTEXT DEFAULT NULL, image VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_A5AEDC16C35E566A (family_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plant_qualities (plants_id INT NOT NULL, qualities_id INT NOT NULL, INDEX IDX_D4252A1862091EAB (plants_id), INDEX IDX_D4252A18861D12EC (qualities_id), PRIMARY KEY(plants_id, qualities_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(150) NOT NULL, description VARCHAR(255) DEFAULT NULL, price INT NOT NULL, INDEX IDX_B3BA5A5A12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_plant (products_id INT NOT NULL, plants_id INT NOT NULL, INDEX IDX_A5F762E6C8A81A9 (products_id), INDEX IDX_A5F762E62091EAB (plants_id), PRIMARY KEY(products_id, plants_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE qualities (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(50) DEFAULT NULL, lastname VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ordered_product ADD CONSTRAINT FK_E6F097B6FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE ordered_product ADD CONSTRAINT FK_E6F097B6DE18E50B FOREIGN KEY (product_id_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEFF2A8640 FOREIGN KEY (order_stat_id) REFERENCES order_status (id)');
        $this->addSql('ALTER TABLE plants ADD CONSTRAINT FK_A5AEDC16C35E566A FOREIGN KEY (family_id) REFERENCES families (id)');
        $this->addSql('ALTER TABLE plant_qualities ADD CONSTRAINT FK_D4252A1862091EAB FOREIGN KEY (plants_id) REFERENCES plants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plant_qualities ADD CONSTRAINT FK_D4252A18861D12EC FOREIGN KEY (qualities_id) REFERENCES qualities (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE product_plant ADD CONSTRAINT FK_A5F762E6C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_plant ADD CONSTRAINT FK_A5F762E62091EAB FOREIGN KEY (plants_id) REFERENCES plants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F5B7AF75');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A12469DE2');
        $this->addSql('ALTER TABLE plants DROP FOREIGN KEY FK_A5AEDC16C35E566A');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEFF2A8640');
        $this->addSql('ALTER TABLE ordered_product DROP FOREIGN KEY FK_E6F097B6FCDAEAAA');
        $this->addSql('ALTER TABLE plant_qualities DROP FOREIGN KEY FK_D4252A1862091EAB');
        $this->addSql('ALTER TABLE product_plant DROP FOREIGN KEY FK_A5F762E62091EAB');
        $this->addSql('ALTER TABLE ordered_product DROP FOREIGN KEY FK_E6F097B6DE18E50B');
        $this->addSql('ALTER TABLE product_plant DROP FOREIGN KEY FK_A5F762E6C8A81A9');
        $this->addSql('ALTER TABLE plant_qualities DROP FOREIGN KEY FK_D4252A18861D12EC');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE families');
        $this->addSql('DROP TABLE order_status');
        $this->addSql('DROP TABLE ordered_product');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE plants');
        $this->addSql('DROP TABLE plant_qualities');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE product_plant');
        $this->addSql('DROP TABLE qualities');
        $this->addSql('DROP TABLE user');
    }
}
