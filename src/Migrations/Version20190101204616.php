<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190101204616 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE book (book_id INT AUTO_INCREMENT NOT NULL, author INT DEFAULT NULL, original_title VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, edition VARCHAR(45) DEFAULT NULL, year VARCHAR(45) DEFAULT NULL, INDEX fk_book_author_idx (author), PRIMARY KEY(book_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annotation (annotation_id INT AUTO_INCREMENT NOT NULL, book_id INT DEFAULT NULL, user_id INT DEFAULT NULL, page INT DEFAULT NULL, quote TEXT DEFAULT NULL, note TEXT DEFAULT NULL, INDEX IDX_2E443EF2A76ED395 (user_id), INDEX fk_book_idx (book_id), PRIMARY KEY(annotation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE author (author_id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(45) DEFAULT NULL, last_name VARCHAR(45) DEFAULT NULL, PRIMARY KEY(author_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331BDAFD8C8 FOREIGN KEY (author) REFERENCES author (author_id)');
        $this->addSql('ALTER TABLE annotation ADD CONSTRAINT FK_2E443EF216A2B381 FOREIGN KEY (book_id) REFERENCES book (book_id)');
        $this->addSql('ALTER TABLE annotation ADD CONSTRAINT FK_2E443EF2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE annotation DROP FOREIGN KEY FK_2E443EF216A2B381');
        $this->addSql('ALTER TABLE annotation DROP FOREIGN KEY FK_2E443EF2A76ED395');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331BDAFD8C8');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE annotation');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE author');
    }
}
