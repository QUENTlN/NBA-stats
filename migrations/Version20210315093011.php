<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210315093011 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comparison (id INT AUTO_INCREMENT NOT NULL, season INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comparison_player (comparison_id INT NOT NULL, player_id INT NOT NULL, INDEX IDX_9D6AA7D2E4EC5411 (comparison_id), INDEX IDX_9D6AA7D299E6F5DF (player_id), PRIMARY KEY(comparison_id, player_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, home_team_id INT NOT NULL, visitor_team_id INT NOT NULL, date DATETIME NOT NULL, home_team_score SMALLINT NOT NULL, visitor_team_score SMALLINT NOT NULL, season SMALLINT NOT NULL, period SMALLINT NOT NULL, status VARCHAR(10) NOT NULL, time VARCHAR(30) NOT NULL, postseason TINYINT(1) NOT NULL, INDEX IDX_232B318C9C4C13F6 (home_team_id), INDEX IDX_232B318CEB7F4866 (visitor_team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, team_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, position VARCHAR(5) NOT NULL, height_feet SMALLINT DEFAULT NULL, height_inches SMALLINT DEFAULT NULL, weight_pounds SMALLINT DEFAULT NULL, INDEX IDX_98197A65296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season_average (id INT AUTO_INCREMENT NOT NULL, player_id INT NOT NULL, game_played SMALLINT NOT NULL, season SMALLINT NOT NULL, min VARCHAR(10) NOT NULL, fgm DOUBLE PRECISION NOT NULL, fga DOUBLE PRECISION NOT NULL, fg3m DOUBLE PRECISION NOT NULL, fg3a DOUBLE PRECISION NOT NULL, ftm DOUBLE PRECISION NOT NULL, fta DOUBLE PRECISION NOT NULL, oreb DOUBLE PRECISION NOT NULL, dreb DOUBLE PRECISION NOT NULL, reb DOUBLE PRECISION NOT NULL, ast DOUBLE PRECISION NOT NULL, stl DOUBLE PRECISION NOT NULL, blk DOUBLE PRECISION NOT NULL, turnover DOUBLE PRECISION NOT NULL, pf DOUBLE PRECISION NOT NULL, pts DOUBLE PRECISION NOT NULL, fg_pct DOUBLE PRECISION NOT NULL, fg3_pct DOUBLE PRECISION NOT NULL, ft_pct DOUBLE PRECISION NOT NULL, INDEX IDX_863A862799E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stat (id INT AUTO_INCREMENT NOT NULL, ast SMALLINT NOT NULL, blk SMALLINT NOT NULL, dreb SMALLINT NOT NULL, fg3_pct SMALLINT NOT NULL, fg3a SMALLINT NOT NULL, fg3m SMALLINT NOT NULL, fg_pct DOUBLE PRECISION NOT NULL, fga SMALLINT NOT NULL, fgm SMALLINT NOT NULL, ft_pct DOUBLE PRECISION NOT NULL, fta SMALLINT NOT NULL, ftm SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, abbreviation VARCHAR(3) NOT NULL, city VARCHAR(255) NOT NULL, conference VARCHAR(255) NOT NULL, division VARCHAR(255) NOT NULL, full_name VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comparison_player ADD CONSTRAINT FK_9D6AA7D2E4EC5411 FOREIGN KEY (comparison_id) REFERENCES comparison (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comparison_player ADD CONSTRAINT FK_9D6AA7D299E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C9C4C13F6 FOREIGN KEY (home_team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CEB7F4866 FOREIGN KEY (visitor_team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE season_average ADD CONSTRAINT FK_863A862799E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comparison_player DROP FOREIGN KEY FK_9D6AA7D2E4EC5411');
        $this->addSql('ALTER TABLE comparison_player DROP FOREIGN KEY FK_9D6AA7D299E6F5DF');
        $this->addSql('ALTER TABLE season_average DROP FOREIGN KEY FK_863A862799E6F5DF');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C9C4C13F6');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CEB7F4866');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65296CD8AE');
        $this->addSql('DROP TABLE comparison');
        $this->addSql('DROP TABLE comparison_player');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE season_average');
        $this->addSql('DROP TABLE stat');
        $this->addSql('DROP TABLE team');
    }
}
