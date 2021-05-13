<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210513153705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE addresses (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, country_id INT NOT NULL, street VARCHAR(255) NOT NULL, housenr INT NOT NULL, INDEX IDX_6FCA75168BAC62AF (city_id), INDEX IDX_6FCA7516F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attachments (id INT AUTO_INCREMENT NOT NULL, plant_id INT DEFAULT NULL, product_id INT DEFAULT NULL, image VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_47C4FAD61D935652 (plant_id), INDEX IDX_47C4FAD64584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cities (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, postalcode INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE countries (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE families (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_status (id INT AUTO_INCREMENT NOT NULL, stat_description VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordered_product (id INT AUTO_INCREMENT NOT NULL, order_id_id INT NOT NULL, product_id_id INT NOT NULL, ordered_prod_price INT DEFAULT NULL, INDEX IDX_E6F097B6FCDAEAAA (order_id_id), INDEX IDX_E6F097B6DE18E50B (product_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, order_stat_id INT NOT NULL, deliver_address_id INT NOT NULL, order_date DATETIME NOT NULL, order_total_price INT DEFAULT NULL, order_total_prod INT DEFAULT NULL, INDEX IDX_E52FFDEEFF2A8640 (order_stat_id), INDEX IDX_E52FFDEE9267076E (deliver_address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plants (id INT AUTO_INCREMENT NOT NULL, family_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, latin_name VARCHAR(100) DEFAULT NULL, symbolism LONGTEXT DEFAULT NULL, INDEX IDX_A5AEDC16C35E566A (family_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plant_qualities (plants_id INT NOT NULL, qualities_id INT NOT NULL, INDEX IDX_D4252A1862091EAB (plants_id), INDEX IDX_D4252A18861D12EC (qualities_id), PRIMARY KEY(plants_id, qualities_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(150) NOT NULL, description VARCHAR(255) DEFAULT NULL, img VARCHAR(255) DEFAULT NULL, price INT NOT NULL, INDEX IDX_B3BA5A5A12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_plant (products_id INT NOT NULL, plants_id INT NOT NULL, INDEX IDX_A5F762E6C8A81A9 (products_id), INDEX IDX_A5F762E62091EAB (plants_id), PRIMARY KEY(products_id, plants_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE qualities (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_addresses (user_id INT NOT NULL, addresses_id INT NOT NULL, INDEX IDX_6F2AF8F2A76ED395 (user_id), INDEX IDX_6F2AF8F25713BC80 (addresses_id), PRIMARY KEY(user_id, addresses_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE addresses ADD CONSTRAINT FK_6FCA75168BAC62AF FOREIGN KEY (city_id) REFERENCES cities (id)');
        $this->addSql('ALTER TABLE addresses ADD CONSTRAINT FK_6FCA7516F92F3E70 FOREIGN KEY (country_id) REFERENCES countries (id)');
        $this->addSql('ALTER TABLE attachments ADD CONSTRAINT FK_47C4FAD61D935652 FOREIGN KEY (plant_id) REFERENCES plants (id)');
        $this->addSql('ALTER TABLE attachments ADD CONSTRAINT FK_47C4FAD64584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE ordered_product ADD CONSTRAINT FK_E6F097B6FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE ordered_product ADD CONSTRAINT FK_E6F097B6DE18E50B FOREIGN KEY (product_id_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEFF2A8640 FOREIGN KEY (order_stat_id) REFERENCES order_status (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE9267076E FOREIGN KEY (deliver_address_id) REFERENCES addresses (id)');
        $this->addSql('ALTER TABLE plants ADD CONSTRAINT FK_A5AEDC16C35E566A FOREIGN KEY (family_id) REFERENCES families (id)');
        $this->addSql('ALTER TABLE plant_qualities ADD CONSTRAINT FK_D4252A1862091EAB FOREIGN KEY (plants_id) REFERENCES plants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plant_qualities ADD CONSTRAINT FK_D4252A18861D12EC FOREIGN KEY (qualities_id) REFERENCES qualities (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE product_plant ADD CONSTRAINT FK_A5F762E6C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_plant ADD CONSTRAINT FK_A5F762E62091EAB FOREIGN KEY (plants_id) REFERENCES plants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_addresses ADD CONSTRAINT FK_6F2AF8F2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_addresses ADD CONSTRAINT FK_6F2AF8F25713BC80 FOREIGN KEY (addresses_id) REFERENCES addresses (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE9267076E');
        $this->addSql('ALTER TABLE user_addresses DROP FOREIGN KEY FK_6F2AF8F25713BC80');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A12469DE2');
        $this->addSql('ALTER TABLE addresses DROP FOREIGN KEY FK_6FCA75168BAC62AF');
        $this->addSql('ALTER TABLE addresses DROP FOREIGN KEY FK_6FCA7516F92F3E70');
        $this->addSql('ALTER TABLE plants DROP FOREIGN KEY FK_A5AEDC16C35E566A');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEFF2A8640');
        $this->addSql('ALTER TABLE ordered_product DROP FOREIGN KEY FK_E6F097B6FCDAEAAA');
        $this->addSql('ALTER TABLE attachments DROP FOREIGN KEY FK_47C4FAD61D935652');
        $this->addSql('ALTER TABLE plant_qualities DROP FOREIGN KEY FK_D4252A1862091EAB');
        $this->addSql('ALTER TABLE product_plant DROP FOREIGN KEY FK_A5F762E62091EAB');
        $this->addSql('ALTER TABLE attachments DROP FOREIGN KEY FK_47C4FAD64584665A');
        $this->addSql('ALTER TABLE ordered_product DROP FOREIGN KEY FK_E6F097B6DE18E50B');
        $this->addSql('ALTER TABLE product_plant DROP FOREIGN KEY FK_A5F762E6C8A81A9');
        $this->addSql('ALTER TABLE plant_qualities DROP FOREIGN KEY FK_D4252A18861D12EC');
        $this->addSql('ALTER TABLE user_addresses DROP FOREIGN KEY FK_6F2AF8F2A76ED395');
        $this->addSql('DROP TABLE addresses');
        $this->addSql('DROP TABLE attachments');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE cities');
        $this->addSql('DROP TABLE countries');
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
        $this->addSql('DROP TABLE user_addresses');
    }
}
