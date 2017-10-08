<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171008210718 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id VARCHAR(255) NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', fullname VARCHAR(255) DEFAULT NULL, postman_token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), UNIQUE INDEX email_postman_token_unique (email, postman_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE response (id VARCHAR(255) NOT NULL, item_id VARCHAR(255) DEFAULT NULL, INDEX IDX_3E7B0BFB126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE script (id VARCHAR(255) NOT NULL, event_id VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, exec LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collection (id VARCHAR(255) NOT NULL, user_id VARCHAR(255) DEFAULT NULL, postman_id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, schema_url VARCHAR(255) DEFAULT NULL, INDEX IDX_FC4D6532A76ED395 (user_id), UNIQUE INDEX postman_id_unique (postman_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id VARCHAR(255) NOT NULL, item_id VARCHAR(255) DEFAULT NULL, listen VARCHAR(255) NOT NULL, script_id VARCHAR(255) DEFAULT NULL, INDEX IDX_3BAE0AA7126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE request (id VARCHAR(255) NOT NULL, request_id VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, method VARCHAR(255) DEFAULT NULL, mode VARCHAR(255) DEFAULT NULL, body LONGTEXT DEFAULT NULL, headers LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', description LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_3B978F9F427EB8A5 (request_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE environment (id VARCHAR(255) NOT NULL, user_id VARCHAR(255) DEFAULT NULL, postman_id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_4626DE22A76ED395 (user_id), UNIQUE INDEX postman_id_unique (postman_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id VARCHAR(255) NOT NULL, collection_id VARCHAR(255) DEFAULT NULL, postman_id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, `group` VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, request_id VARCHAR(255) DEFAULT NULL, INDEX IDX_1F1B251E514956FD (collection_id), UNIQUE INDEX postman_id_unique (postman_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFB126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE collection ADD CONSTRAINT FK_FC4D6532A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9F427EB8A5 FOREIGN KEY (request_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE environment ADD CONSTRAINT FK_4626DE22A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E514956FD FOREIGN KEY (collection_id) REFERENCES collection (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE collection DROP FOREIGN KEY FK_FC4D6532A76ED395');
        $this->addSql('ALTER TABLE environment DROP FOREIGN KEY FK_4626DE22A76ED395');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E514956FD');
        $this->addSql('ALTER TABLE response DROP FOREIGN KEY FK_3E7B0BFB126F525E');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7126F525E');
        $this->addSql('ALTER TABLE request DROP FOREIGN KEY FK_3B978F9F427EB8A5');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE response');
        $this->addSql('DROP TABLE script');
        $this->addSql('DROP TABLE collection');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE request');
        $this->addSql('DROP TABLE environment');
        $this->addSql('DROP TABLE item');
    }
}
