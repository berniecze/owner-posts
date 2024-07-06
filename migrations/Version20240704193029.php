<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240704193029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'migration for the user and posts schemas';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            email VARCHAR(100) NOT NULL UNIQUE
        )");

        $this->addSql("CREATE TABLE posts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            title VARCHAR(255) NOT NULL,
            publication_date DATETIME NOT NULL,
            type ENUM('text', 'audio') NOT NULL,
            perex TEXT,
            FOREIGN KEY (user_id) REFERENCES users(id),
            INDEX idx_user_id (user_id),
            INDEX idx_publication_date (publication_date)
        );");

        $this->addSql("CREATE TABLE text_posts (
            post_id INT PRIMARY KEY,
            text TEXT NOT NULL,
            FOREIGN KEY (post_id) REFERENCES posts(id)
        );");

        $this->addSql("CREATE TABLE audio_posts (
            post_id INT PRIMARY KEY,
            duration INT NOT NULL,
            file_url VARCHAR(255) NOT NULL,
            FOREIGN KEY (post_id) REFERENCES posts(id)
        );");
    }

    public function down(Schema $schema): void
    {

    }
}
