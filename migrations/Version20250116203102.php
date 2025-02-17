<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116203102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, short_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE league (id INT AUTO_INCREMENT NOT NULL, country_id_id INT DEFAULT NULL, sport_id_id INT DEFAULT NULL, assocation VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3EB4C318D8A48BBD (country_id_id), UNIQUE INDEX UNIQ_3EB4C318CB38FF4E (sport_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE match_has_referees (id INT AUTO_INCREMENT NOT NULL, id_match_id INT NOT NULL, id_referee_id INT DEFAULT NULL, INDEX IDX_A7EB2BBB7A654043 (id_match_id), INDEX IDX_A7EB2BBBEF82FC75 (id_referee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, team_id_id INT DEFAULT NULL, country_id_id INT DEFAULT NULL, birthdate DATETIME DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, INDEX IDX_98197A65B842D717 (team_id_id), UNIQUE INDEX UNIQ_98197A65D8A48BBD (country_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player_history (id INT AUTO_INCREMENT NOT NULL, player_id_id INT DEFAULT NULL, team_id_id INT DEFAULT NULL, date_of_transfer DATETIME NOT NULL, INDEX IDX_464E8F0EC036E511 (player_id_id), INDEX IDX_464E8F0EB842D717 (team_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player_stats (id INT AUTO_INCREMENT NOT NULL, player_id_id INT DEFAULT NULL, parametrs JSON DEFAULT NULL, UNIQUE INDEX UNIQ_E8351CECC036E511 (player_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE referee (id INT AUTO_INCREMENT NOT NULL, sport_id_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_D60FB342CB38FF4E (sport_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, league_id_id INT DEFAULT NULL, is_active TINYINT(1) NOT NULL, year_end DATETIME NOT NULL, year_start DATETIME NOT NULL, INDEX IDX_F0E45BA98A97161 (league_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season_has_teams (id INT AUTO_INCREMENT NOT NULL, season_id_id INT DEFAULT NULL, team_id_id INT DEFAULT NULL, points INT DEFAULT NULL, INDEX IDX_E6797C0968756988 (season_id_id), INDEX IDX_E6797C09B842D717 (team_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sport (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stadium (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, capacity INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE league ADD CONSTRAINT FK_3EB4C318D8A48BBD FOREIGN KEY (country_id_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE league ADD CONSTRAINT FK_3EB4C318CB38FF4E FOREIGN KEY (sport_id_id) REFERENCES sport (id)');
        $this->addSql('ALTER TABLE match_has_referees ADD CONSTRAINT FK_A7EB2BBB7A654043 FOREIGN KEY (id_match_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE match_has_referees ADD CONSTRAINT FK_A7EB2BBBEF82FC75 FOREIGN KEY (id_referee_id) REFERENCES referee (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65B842D717 FOREIGN KEY (team_id_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65D8A48BBD FOREIGN KEY (country_id_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE player_history ADD CONSTRAINT FK_464E8F0EC036E511 FOREIGN KEY (player_id_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE player_history ADD CONSTRAINT FK_464E8F0EB842D717 FOREIGN KEY (team_id_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE player_stats ADD CONSTRAINT FK_E8351CECC036E511 FOREIGN KEY (player_id_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE referee ADD CONSTRAINT FK_D60FB342CB38FF4E FOREIGN KEY (sport_id_id) REFERENCES sport (id)');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA98A97161 FOREIGN KEY (league_id_id) REFERENCES league (id)');
        $this->addSql('ALTER TABLE season_has_teams ADD CONSTRAINT FK_E6797C0968756988 FOREIGN KEY (season_id_id) REFERENCES season (id)');
        $this->addSql('ALTER TABLE season_has_teams ADD CONSTRAINT FK_E6797C09B842D717 FOREIGN KEY (team_id_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game ADD date_of_game DATETIME NOT NULL');
        $this->addSql('ALTER TABLE team CHANGE capacity_of_stadium stadium_id_id INT DEFAULT NULL, CHANGE name_of_stadium short_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FDCFF57F7 FOREIGN KEY (stadium_id_id) REFERENCES stadium (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C4E0A61FDCFF57F7 ON team (stadium_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FDCFF57F7');
        $this->addSql('ALTER TABLE league DROP FOREIGN KEY FK_3EB4C318D8A48BBD');
        $this->addSql('ALTER TABLE league DROP FOREIGN KEY FK_3EB4C318CB38FF4E');
        $this->addSql('ALTER TABLE match_has_referees DROP FOREIGN KEY FK_A7EB2BBB7A654043');
        $this->addSql('ALTER TABLE match_has_referees DROP FOREIGN KEY FK_A7EB2BBBEF82FC75');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65B842D717');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65D8A48BBD');
        $this->addSql('ALTER TABLE player_history DROP FOREIGN KEY FK_464E8F0EC036E511');
        $this->addSql('ALTER TABLE player_history DROP FOREIGN KEY FK_464E8F0EB842D717');
        $this->addSql('ALTER TABLE player_stats DROP FOREIGN KEY FK_E8351CECC036E511');
        $this->addSql('ALTER TABLE referee DROP FOREIGN KEY FK_D60FB342CB38FF4E');
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA98A97161');
        $this->addSql('ALTER TABLE season_has_teams DROP FOREIGN KEY FK_E6797C0968756988');
        $this->addSql('ALTER TABLE season_has_teams DROP FOREIGN KEY FK_E6797C09B842D717');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE league');
        $this->addSql('DROP TABLE match_has_referees');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE player_history');
        $this->addSql('DROP TABLE player_stats');
        $this->addSql('DROP TABLE referee');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP TABLE season_has_teams');
        $this->addSql('DROP TABLE sport');
        $this->addSql('DROP TABLE stadium');
        $this->addSql('ALTER TABLE game DROP date_of_game');
        $this->addSql('DROP INDEX UNIQ_C4E0A61FDCFF57F7 ON team');
        $this->addSql('ALTER TABLE team CHANGE short_name name_of_stadium VARCHAR(255) DEFAULT NULL, CHANGE stadium_id_id capacity_of_stadium INT DEFAULT NULL');
    }
}
