<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250214153308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game ADD league_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C8A97161 FOREIGN KEY (league_id_id) REFERENCES league (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_232B318C8A97161 ON game (league_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C8A97161');
        $this->addSql('DROP INDEX UNIQ_232B318C8A97161 ON game');
        $this->addSql('ALTER TABLE game DROP league_id_id');
    }
}
