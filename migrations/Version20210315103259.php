<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210315103259 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comparison_player_to_compare (comparison_id INT NOT NULL, player_to_compare_id INT NOT NULL, INDEX IDX_31652F18E4EC5411 (comparison_id), INDEX IDX_31652F18DA9716BB (player_to_compare_id), PRIMARY KEY(comparison_id, player_to_compare_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player_to_compare (id INT AUTO_INCREMENT NOT NULL, id_player INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comparison_player_to_compare ADD CONSTRAINT FK_31652F18E4EC5411 FOREIGN KEY (comparison_id) REFERENCES comparison (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comparison_player_to_compare ADD CONSTRAINT FK_31652F18DA9716BB FOREIGN KEY (player_to_compare_id) REFERENCES player_to_compare (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE comparison_player');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comparison_player_to_compare DROP FOREIGN KEY FK_31652F18DA9716BB');
        $this->addSql('CREATE TABLE comparison_player (comparison_id INT NOT NULL, player_id INT NOT NULL, INDEX IDX_9D6AA7D2E4EC5411 (comparison_id), INDEX IDX_9D6AA7D299E6F5DF (player_id), PRIMARY KEY(comparison_id, player_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE comparison_player ADD CONSTRAINT FK_9D6AA7D299E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comparison_player ADD CONSTRAINT FK_9D6AA7D2E4EC5411 FOREIGN KEY (comparison_id) REFERENCES comparison (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE comparison_player_to_compare');
        $this->addSql('DROP TABLE player_to_compare');
    }
}
