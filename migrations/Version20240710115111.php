<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240710115111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'migration for textposts and audio posts relation';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE posts ADD text_post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE posts ADD audio_post_id INT DEFAULT NULL');

        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_POSTS_TEXT_POST_ID FOREIGN KEY (text_post_id) REFERENCES text_posts (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_POSTS_TEXT_POST_ID ON posts (text_post_id)');

        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_POSTS_AUDIO_POST_ID FOREIGN KEY (audio_post_id) REFERENCES audio_posts (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_POSTS_AUDIO_POST_ID ON posts (audio_post_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_POSTS_TEXT_POST_ID');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_POSTS_AUDIO_POST_ID');
        $this->addSql('DROP INDEX UNIQ_POSTS_TEXT_POST_ID ON posts');
        $this->addSql('DROP INDEX UNIQ_POSTS_AUDIO_POST_ID ON posts');

        $this->addSql('ALTER TABLE posts DROP text_post_id');
        $this->addSql('ALTER TABLE posts DROP audio_post_id');
    }
}
