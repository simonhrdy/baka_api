<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250122151614 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE match_has_referees DROP FOREIGN KEY FK_A7EB2BBB7A654043');
        $this->addSql('ALTER TABLE match_has_referees DROP FOREIGN KEY FK_A7EB2BBBEF82FC75');
        $this->addSql('DROP INDEX IDX_A7EB2BBB7A654043 ON match_has_referees');
        $this->addSql('DROP INDEX IDX_A7EB2BBBEF82FC75 ON match_has_referees');
        $this->addSql('ALTER TABLE match_has_referees ADD game_id INT NOT NULL, DROP id_referee_id, CHANGE id_match_id referee_id INT NOT NULL');
        $this->addSql('ALTER TABLE match_has_referees ADD CONSTRAINT FK_A7EB2BBB4A087CA2 FOREIGN KEY (referee_id) REFERENCES referee (id)');
        $this->addSql('ALTER TABLE match_has_referees ADD CONSTRAINT FK_A7EB2BBBE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('CREATE INDEX IDX_A7EB2BBB4A087CA2 ON match_has_referees (referee_id)');
        $this->addSql('CREATE INDEX IDX_A7EB2BBBE48FD905 ON match_has_referees (game_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE match_has_referees DROP FOREIGN KEY FK_A7EB2BBB4A087CA2');
        $this->addSql('ALTER TABLE match_has_referees DROP FOREIGN KEY FK_A7EB2BBBE48FD905');
        $this->addSql('DROP INDEX IDX_A7EB2BBB4A087CA2 ON match_has_referees');
        $this->addSql('DROP INDEX IDX_A7EB2BBBE48FD905 ON match_has_referees');
        $this->addSql('ALTER TABLE match_has_referees ADD id_match_id INT NOT NULL, ADD id_referee_id INT DEFAULT NULL, DROP referee_id, DROP game_id');
        $this->addSql('ALTER TABLE match_has_referees ADD CONSTRAINT FK_A7EB2BBB7A654043 FOREIGN KEY (id_match_id) REFERENCES game (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE match_has_referees ADD CONSTRAINT FK_A7EB2BBBEF82FC75 FOREIGN KEY (id_referee_id) REFERENCES referee (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_A7EB2BBB7A654043 ON match_has_referees (id_match_id)');
        $this->addSql('CREATE INDEX IDX_A7EB2BBBEF82FC75 ON match_has_referees (id_referee_id)');
    }
}
