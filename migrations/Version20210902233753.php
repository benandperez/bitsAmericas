<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210902233753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album_artists (album_id INT NOT NULL, artists_id INT NOT NULL, INDEX IDX_3D04DD0C1137ABCF (album_id), INDEX IDX_3D04DD0C54A05007 (artists_id), PRIMARY KEY(album_id, artists_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE album_artists ADD CONSTRAINT FK_3D04DD0C1137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE album_artists ADD CONSTRAINT FK_3D04DD0C54A05007 FOREIGN KEY (artists_id) REFERENCES artists (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE album ADD name VARCHAR(255) NOT NULL, ADD release_date DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE album_artists');
        $this->addSql('ALTER TABLE album DROP name, DROP release_date');
    }
}
