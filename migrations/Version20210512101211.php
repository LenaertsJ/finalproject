<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210512101211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE families (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plants (id INT AUTO_INCREMENT NOT NULL, family_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, latin_name VARCHAR(100) DEFAULT NULL, symbolism LONGTEXT DEFAULT NULL, INDEX IDX_A5AEDC16C35E566A (family_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE plants ADD CONSTRAINT FK_A5AEDC16C35E566A FOREIGN KEY (family_id) REFERENCES families (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plants DROP FOREIGN KEY FK_A5AEDC16C35E566A');
        $this->addSql('DROP TABLE families');
        $this->addSql('DROP TABLE plants');
    }
}
