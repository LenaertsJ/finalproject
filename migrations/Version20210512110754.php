<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210512110754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE plant_qualities (plants_id INT NOT NULL, qualities_id INT NOT NULL, INDEX IDX_D4252A1862091EAB (plants_id), INDEX IDX_D4252A18861D12EC (qualities_id), PRIMARY KEY(plants_id, qualities_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE qualities (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE plant_qualities ADD CONSTRAINT FK_D4252A1862091EAB FOREIGN KEY (plants_id) REFERENCES plants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plant_qualities ADD CONSTRAINT FK_D4252A18861D12EC FOREIGN KEY (qualities_id) REFERENCES qualities (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plant_qualities DROP FOREIGN KEY FK_D4252A18861D12EC');
        $this->addSql('DROP TABLE plant_qualities');
        $this->addSql('DROP TABLE qualities');
    }
}
