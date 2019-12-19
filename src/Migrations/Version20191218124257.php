<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191218124257 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE users (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', picture_id INT DEFAULT NULL, address_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(40) NOT NULL, lastname VARCHAR(40) NOT NULL, screenname VARCHAR(50) NOT NULL, phone VARCHAR(20) DEFAULT NULL, birthday DATE NOT NULL, language CHAR(2) NOT NULL, is_active TINYINT(1) NOT NULL, activation_token VARCHAR(255) DEFAULT NULL, passwordtoken VARCHAR(255) DEFAULT NULL, password_token_expiration DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), INDEX IDX_1483A5E9EE45BDBF (picture_id), INDEX IDX_1483A5E9F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorites (users_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', ads_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_E46960F567B3B43D (users_id), INDEX IDX_E46960F5FE52BF81 (ads_id), PRIMARY KEY(users_id, ads_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9EE45BDBF FOREIGN KEY (picture_id) REFERENCES medias (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9F5B7AF75 FOREIGN KEY (address_id) REFERENCES addresses (id)');
        $this->addSql('ALTER TABLE favorites ADD CONSTRAINT FK_E46960F567B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorites ADD CONSTRAINT FK_E46960F5FE52BF81 FOREIGN KEY (ads_id) REFERENCES ads (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ads CHANGE state state enum(\'new\', \'used\', \'broken\')');
        $this->addSql('ALTER TABLE ads ADD CONSTRAINT FK_7EC9F620B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE ads ADD CONSTRAINT FK_7EC9F62012469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE ads ADD CONSTRAINT FK_7EC9F62064D218E FOREIGN KEY (location_id) REFERENCES addresses (id)');
        $this->addSql('ALTER TABLE attachments ADD CONSTRAINT FK_47C4FAD6EA9FDD75 FOREIGN KEY (media_id) REFERENCES medias (id)');
        $this->addSql('ALTER TABLE attachments ADD CONSTRAINT FK_47C4FAD64F34D596 FOREIGN KEY (ad_id) REFERENCES ads (id)');
        $this->addSql('ALTER TABLE medias ADD CONSTRAINT FK_12D2AF81B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA460427A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA4604274F34D596 FOREIGN KEY (ad_id) REFERENCES ads (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ads DROP FOREIGN KEY FK_7EC9F620B03A8386');
        $this->addSql('ALTER TABLE medias DROP FOREIGN KEY FK_12D2AF81B03A8386');
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA460427A76ED395');
        $this->addSql('ALTER TABLE favorites DROP FOREIGN KEY FK_E46960F567B3B43D');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE favorites');
        $this->addSql('ALTER TABLE ads DROP FOREIGN KEY FK_7EC9F62012469DE2');
        $this->addSql('ALTER TABLE ads DROP FOREIGN KEY FK_7EC9F62064D218E');
        $this->addSql('ALTER TABLE ads CHANGE state state VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE attachments DROP FOREIGN KEY FK_47C4FAD6EA9FDD75');
        $this->addSql('ALTER TABLE attachments DROP FOREIGN KEY FK_47C4FAD64F34D596');
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA4604274F34D596');
    }
}
