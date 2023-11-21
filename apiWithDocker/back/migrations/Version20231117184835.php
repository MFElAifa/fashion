<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231117184835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE look (id INT AUTO_INCREMENT NOT NULL, brand_id INT NOT NULL, season_id INT NOT NULL, picture VARCHAR(255) NOT NULL, tags VARCHAR(255) NOT NULL, INDEX IDX_2B3AD40244F5D008 (brand_id), INDEX IDX_2B3AD4024EC001D1 (season_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE look ADD CONSTRAINT FK_2B3AD40244F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE look ADD CONSTRAINT FK_2B3AD4024EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE look DROP FOREIGN KEY FK_2B3AD40244F5D008');
        $this->addSql('ALTER TABLE look DROP FOREIGN KEY FK_2B3AD4024EC001D1');
        $this->addSql('DROP TABLE look');
    }
}
