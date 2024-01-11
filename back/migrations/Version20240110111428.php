<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110111428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE DATABASE IF NOT EXISTS bigmap');
        $this->addSql('CREATE TABLE customer (id INT NOT NULL, address VARCHAR(255) NOT NULL, complement VARCHAR(255) DEFAULT NULL, city VARCHAR(255) NOT NULL, zipcode SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery (id INT AUTO_INCREMENT NOT NULL, deliveryman_id INT NOT NULL, date DATE NOT NULL, INDEX IDX_3781EC10793075C6 (deliveryman_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery_comment (id INT AUTO_INCREMENT NOT NULL, delivery_id INT NOT NULL, km_start INT NOT NULL, km_end INT DEFAULT NULL, toll_rate DOUBLE PRECISION DEFAULT NULL, fuel_bill DOUBLE PRECISION DEFAULT NULL, comment LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_9E6AEDB212136921 (delivery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deliveryman (id INT NOT NULL, vehicle_id INT DEFAULT NULL, salary DOUBLE PRECISION NOT NULL, average_mark DOUBLE PRECISION DEFAULT NULL, nb_marks INT NOT NULL, UNIQUE INDEX UNIQ_1DF03BC9545317D1 (vehicle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feedback (id INT AUTO_INCREMENT NOT NULL, order__id INT NOT NULL, mark SMALLINT NOT NULL, broken_items INT NOT NULL, fullfilled TINYINT(1) NOT NULL, deliveryman_mark SMALLINT NOT NULL, late TINYINT(1) NOT NULL, comment LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_D2294458251A8A50 (order__id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notif (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, order__id INT NOT NULL, type VARCHAR(255) NOT NULL, value LONGTEXT NOT NULL, INDEX IDX_C0730D6B9395C3F3 (customer_id), INDEX IDX_C0730D6B251A8A50 (order__id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, delivery_id INT DEFAULT NULL, customer_id INT NOT NULL, quantity INT NOT NULL, state VARCHAR(255) NOT NULL, comment LONGTEXT DEFAULT NULL, expected_time DATETIME NOT NULL, start_time DATETIME DEFAULT NULL, end_time DATETIME DEFAULT NULL, INDEX IDX_F529939812136921 (delivery_id), INDEX IDX_F52993989395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, phone VARCHAR(20) DEFAULT NULL, discriminator VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, brand VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10793075C6 FOREIGN KEY (deliveryman_id) REFERENCES deliveryman (id)');
        $this->addSql('ALTER TABLE delivery_comment ADD CONSTRAINT FK_9E6AEDB212136921 FOREIGN KEY (delivery_id) REFERENCES delivery (id)');
        $this->addSql('ALTER TABLE deliveryman ADD CONSTRAINT FK_1DF03BC9545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE deliveryman ADD CONSTRAINT FK_1DF03BC9BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458251A8A50 FOREIGN KEY (order__id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE notif ADD CONSTRAINT FK_C0730D6B9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE notif ADD CONSTRAINT FK_C0730D6B251A8A50 FOREIGN KEY (order__id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939812136921 FOREIGN KEY (delivery_id) REFERENCES delivery (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993989395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09BF396750');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10793075C6');
        $this->addSql('ALTER TABLE delivery_comment DROP FOREIGN KEY FK_9E6AEDB212136921');
        $this->addSql('ALTER TABLE deliveryman DROP FOREIGN KEY FK_1DF03BC9545317D1');
        $this->addSql('ALTER TABLE deliveryman DROP FOREIGN KEY FK_1DF03BC9BF396750');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458251A8A50');
        $this->addSql('ALTER TABLE notif DROP FOREIGN KEY FK_C0730D6B9395C3F3');
        $this->addSql('ALTER TABLE notif DROP FOREIGN KEY FK_C0730D6B251A8A50');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939812136921');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993989395C3F3');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE delivery');
        $this->addSql('DROP TABLE delivery_comment');
        $this->addSql('DROP TABLE deliveryman');
        $this->addSql('DROP TABLE feedback');
        $this->addSql('DROP TABLE notif');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vehicle');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('DROP DATABASE bigmap');
    }
}
