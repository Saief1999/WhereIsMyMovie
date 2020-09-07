<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200829203015 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movie_genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE registered_user (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_8B903F56A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE registered_user_movie_genre (registered_user_id INT NOT NULL, movie_genre_id INT NOT NULL, INDEX IDX_EED0CDD7A6A12EC1 (registered_user_id), INDEX IDX_EED0CDD79E604892 (movie_genre_id), PRIMARY KEY(registered_user_id, movie_genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE registered_user ADD CONSTRAINT FK_8B903F56A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE registered_user_movie_genre ADD CONSTRAINT FK_EED0CDD7A6A12EC1 FOREIGN KEY (registered_user_id) REFERENCES registered_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE registered_user_movie_genre ADD CONSTRAINT FK_EED0CDD79E604892 FOREIGN KEY (movie_genre_id) REFERENCES movie_genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(255) NOT NULL, ADD first_name VARCHAR(255) NOT NULL, ADD last_name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE registered_user_movie_genre DROP FOREIGN KEY FK_EED0CDD79E604892');
        $this->addSql('ALTER TABLE registered_user_movie_genre DROP FOREIGN KEY FK_EED0CDD7A6A12EC1');
        $this->addSql('DROP TABLE movie_genre');
        $this->addSql('DROP TABLE registered_user');
        $this->addSql('DROP TABLE registered_user_movie_genre');
        $this->addSql('ALTER TABLE user DROP username, DROP first_name, DROP last_name');
    }
}
