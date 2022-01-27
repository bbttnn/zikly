<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220114234814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie ADD user_id INT NOT NULL, ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD title VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user RENAME INDEX idx_8d93d64912469de2 TO IDX_8D93D649BCF5E72D');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP user_id, DROP firstname, DROP lastname, DROP title');
        $this->addSql('ALTER TABLE user RENAME INDEX idx_8d93d649bcf5e72d TO IDX_8D93D64912469DE2');
    }
}
