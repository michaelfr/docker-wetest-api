<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171015195212 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE response (id VARCHAR(255) NOT NULL, operation_id VARCHAR(255) DEFAULT NULL, status_code INT NOT NULL, description VARCHAR(255) DEFAULT NULL, `schema` VARCHAR(255) DEFAULT NULL, INDEX IDX_3E7B0BFB44AC3583 (operation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id VARCHAR(255) NOT NULL, user_id VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_2FB3D0EEA76ED395 (user_id), UNIQUE INDEX user_title_unique (user_id, title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specification (id VARCHAR(255) NOT NULL, project_id VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, version VARCHAR(255) NOT NULL, base_uri VARCHAR(255) NOT NULL, INDEX IDX_E3F1A9A166D1F9C (project_id), UNIQUE INDEX project_title_version_unique (project_id, title, version), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE definition (id VARCHAR(255) NOT NULL, specification_id VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, `schema` LONGTEXT NOT NULL, INDEX IDX_68302FD8908E2FFE (specification_id), UNIQUE INDEX specification_name_unique (specification_id, name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id VARCHAR(255) NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', fullname VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), UNIQUE INDEX email_unique (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operation (id VARCHAR(255) NOT NULL, specification_id VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, method VARCHAR(255) NOT NULL, uri VARCHAR(255) NOT NULL, resource_name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, consume_formats TINYTEXT NOT NULL COMMENT \'(DC2Type:array)\', produce_formats TINYTEXT NOT NULL COMMENT \'(DC2Type:array)\', parameters TINYTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_1981A66D908E2FFE (specification_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFB44AC3583 FOREIGN KEY (operation_id) REFERENCES operation (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE specification ADD CONSTRAINT FK_E3F1A9A166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE definition ADD CONSTRAINT FK_68302FD8908E2FFE FOREIGN KEY (specification_id) REFERENCES specification (id)');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D908E2FFE FOREIGN KEY (specification_id) REFERENCES specification (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE specification DROP FOREIGN KEY FK_E3F1A9A166D1F9C');
        $this->addSql('ALTER TABLE definition DROP FOREIGN KEY FK_68302FD8908E2FFE');
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66D908E2FFE');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEA76ED395');
        $this->addSql('ALTER TABLE response DROP FOREIGN KEY FK_3E7B0BFB44AC3583');
        $this->addSql('DROP TABLE response');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE specification');
        $this->addSql('DROP TABLE definition');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE operation');
    }
}
