<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116203715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_has_favorite_team (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, team_id_id INT DEFAULT NULL, INDEX IDX_7000780C79F37AE5 (id_user_id), INDEX IDX_7000780CB842D717 (team_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_has_favorite_team ADD CONSTRAINT FK_7000780C79F37AE5 FOREIGN KEY (id_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_has_favorite_team ADD CONSTRAINT FK_7000780CB842D717 FOREIGN KEY (team_id_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game CHANGE supervisor_id superviser_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C4B051955 FOREIGN KEY (superviser_id_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_232B318C4B051955 ON game (superviser_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_has_favorite_team DROP FOREIGN KEY FK_7000780C79F37AE5');
        $this->addSql('ALTER TABLE user_has_favorite_team DROP FOREIGN KEY FK_7000780CB842D717');
        $this->addSql('DROP TABLE user_has_favorite_team');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C4B051955');
        $this->addSql('DROP INDEX IDX_232B318C4B051955 ON game');
        $this->addSql('ALTER TABLE game CHANGE superviser_id_id supervisor_id INT DEFAULT NULL');
    }
}
