CREATE TABLE article_index (keyword VARCHAR(200), field VARCHAR(50), position BIGINT, id BIGINT, PRIMARY KEY(keyword, field, position, id)) ENGINE = INNODB;
CREATE TABLE article (id BIGINT AUTO_INCREMENT, titre VARCHAR(200) NOT NULL, date datetime, chapeau LONGTEXT, contenu LONGTEXT NOT NULL, duree_redaction BIGINT, copyright VARCHAR(200), nb_lu BIGINT DEFAULT 0, categorie_id BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), UNIQUE INDEX article_sluggable_idx (slug), INDEX categorie_id_idx (categorie_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE articles_lies (article_src_id BIGINT, article_liee_id BIGINT, PRIMARY KEY(article_src_id, article_liee_id)) ENGINE = INNODB;
CREATE TABLE categorie (id BIGINT AUTO_INCREMENT, titre VARCHAR(200) NOT NULL, description LONGTEXT, logo VARCHAR(255), slug VARCHAR(255), UNIQUE INDEX categorie_sluggable_idx (slug), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE categorie_folio (id BIGINT AUTO_INCREMENT, titre VARCHAR(200) NOT NULL, slug VARCHAR(255), UNIQUE INDEX categorie_folio_sluggable_idx (slug), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE commentaire (id BIGINT AUTO_INCREMENT, message LONGTEXT NOT NULL, article_id BIGINT NOT NULL, pseudo VARCHAR(200) NOT NULL, email VARCHAR(200), site VARCHAR(200), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX article_id_idx (article_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE creation (id BIGINT AUTO_INCREMENT, titre VARCHAR(255) NOT NULL, sstitre VARCHAR(255), code VARCHAR(20) NOT NULL, description1 LONGTEXT, description2 LONGTEXT, mini_desc1 VARCHAR(255), mini_desc2 VARCHAR(255), url VARCHAR(255), miniature VARCHAR(255), bandeau VARCHAR(255), annee VARCHAR(4), date DATETIME, client VARCHAR(255), techno VARCHAR(255), duree VARCHAR(255), categorie_id BIGINT NOT NULL, use_alternatif TINYINT(1), slug VARCHAR(255), UNIQUE INDEX creation_sluggable_idx (slug), INDEX categorie_id_idx (categorie_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE image (id BIGINT AUTO_INCREMENT, chemin VARCHAR(255) NOT NULL, nom VARCHAR(255), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE rel_image_creation (creation_id BIGINT, image_id BIGINT, PRIMARY KEY(creation_id, image_id)) ENGINE = INNODB;
CREATE TABLE rel_techno_creation (techno_id BIGINT, creation_id BIGINT, PRIMARY KEY(techno_id, creation_id)) ENGINE = INNODB;
CREATE TABLE tag (id BIGINT AUTO_INCREMENT, name VARCHAR(100), is_triple TINYINT(1), triple_namespace VARCHAR(100), triple_key VARCHAR(100), triple_value VARCHAR(100), INDEX name_idx (name), INDEX triple1_idx (triple_namespace), INDEX triple2_idx (triple_key), INDEX triple3_idx (triple_value), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE tagging (id BIGINT AUTO_INCREMENT, tag_id BIGINT NOT NULL, taggable_model VARCHAR(30), taggable_id BIGINT, INDEX tag_idx (tag_id), INDEX taggable_idx (taggable_model, taggable_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE techno (id BIGINT AUTO_INCREMENT, nom VARCHAR(255) NOT NULL, logo VARCHAR(255), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_forgot_password (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, unique_key VARCHAR(255), expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id BIGINT AUTO_INCREMENT, user_id BIGINT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user (id BIGINT AUTO_INCREMENT, first_name VARCHAR(255), last_name VARCHAR(255), email_address VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id BIGINT, group_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id)) ENGINE = INNODB;
ALTER TABLE article_index ADD CONSTRAINT article_index_id_article_id FOREIGN KEY (id) REFERENCES article(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE article ADD CONSTRAINT article_categorie_id_categorie_id FOREIGN KEY (categorie_id) REFERENCES categorie(id);
ALTER TABLE articles_lies ADD CONSTRAINT articles_lies_article_src_id_article_id FOREIGN KEY (article_src_id) REFERENCES article(id);
ALTER TABLE commentaire ADD CONSTRAINT commentaire_article_id_article_id FOREIGN KEY (article_id) REFERENCES article(id);
ALTER TABLE creation ADD CONSTRAINT creation_categorie_id_categorie_folio_id FOREIGN KEY (categorie_id) REFERENCES categorie_folio(id);
ALTER TABLE rel_image_creation ADD CONSTRAINT rel_image_creation_image_id_image_id FOREIGN KEY (image_id) REFERENCES image(id);
ALTER TABLE rel_image_creation ADD CONSTRAINT rel_image_creation_creation_id_creation_id FOREIGN KEY (creation_id) REFERENCES creation(id);
ALTER TABLE rel_techno_creation ADD CONSTRAINT rel_techno_creation_techno_id_techno_id FOREIGN KEY (techno_id) REFERENCES techno(id) ON DELETE CASCADE;
ALTER TABLE rel_techno_creation ADD CONSTRAINT rel_techno_creation_creation_id_creation_id FOREIGN KEY (creation_id) REFERENCES creation(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_forgot_password ADD CONSTRAINT sf_guard_forgot_password_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
