CREATE DATABASE `timelines`;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `description` longblob,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3BAE0AA712469DE2` (`category_id`),
  KEY `IDX_3BAE0AA7A76ED395` (`user_id`),
  CONSTRAINT `FK_3BAE0AA712469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_3BAE0AA7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `category` (`id`,`name`,`image_path`,`color`) VALUES (1,'Bike Trip','https://cdn.pixabay.com/photo/2017/02/24/18/13/vintage-bike-2095827_1280.jpg','#FFA852');
INSERT INTO `category` (`id`,`name`,`image_path`,`color`) VALUES (2,'Plane Trip','https://cdn.pixabay.com/photo/2018/03/19/20/57/aircraft-3241229_1280.jpg','#3DABFF');
INSERT INTO `category` (`id`,`name`,`image_path`,`color`) VALUES (3,'Car Trip','https://cdn.pixabay.com/photo/2020/05/16/09/56/car-5176821_1280.jpg','#FFFC36');
INSERT INTO `category` (`id`,`name`,`image_path`,`color`) VALUES (4,'Walking Trip','https://cdn.pixabay.com/photo/2014/01/22/19/38/boot-250012_1280.jpg','#9AA0A6');

INSERT INTO `user` (`id`,`email`,`roles`,`password`) VALUES (52,'admin@gmail.com','[\"ROLE_ADMIN\", \"ROLE_USER\"]','$2y$13$LdWiE2fZEWRm55kR/QINDOaOBKUXmJd720oI01n27wPGX/X.rDUia');
INSERT INTO `user` (`id`,`email`,`roles`,`password`) VALUES (53,'test1@gmail.com','[\"ROLE_USER\"]','$2y$13$OgtZpAGmNcESv38YYWk6BeCb8BPrxyUIA2uyN1BzYBWvkhg2ORk0.');

INSERT INTO `event` (`id`,`category_id`,`name`,`date`,`description`,`image_path`,`user_id`) VALUES (1,2,'Majorka','2020-05-01 19:30:35',"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",'https://cdn.pixabay.com/photo/2017/02/26/14/31/beach-2100369_1280.jpg',2);
INSERT INTO `event` (`id`,`category_id`,`name`,`date`,`description`,`image_path`,`user_id`) VALUES (2,3,'Rome','2021-07-21 19:30:35',"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",'https://cdn.pixabay.com/photo/2019/10/06/08/57/tiber-river-4529605_1280.jpg',2);
INSERT INTO `event` (`id`,`category_id`,`name`,`date`,`description`,`image_path`,`user_id`) VALUES (3,1,'Kabacki Forest','2022-03-15 19:30:35',"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.",'https://cdn.pixabay.com/photo/2017/11/25/22/26/moss-2977795_1280.jpg',2);
INSERT INTO `event` (`id`,`category_id`,`name`,`date`,`description`,`image_path`,`user_id`) VALUES (4,4,'Jastarnia Beach','2023-02-11 19:30:35',"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.",'https://cdn.pixabay.com/photo/2021/03/17/12/01/sea-6102171_1280.jpg',2);
INSERT INTO `event` (`id`,`category_id`,`name`,`date`,`description`,`image_path`,`user_id`) VALUES (5,2,'Florence','2019-01-01 19:30:35',"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).",'https://cdn.pixabay.com/photo/2020/05/23/08/23/florence-5208579_1280.jpg',1);
INSERT INTO `event` (`id`,`category_id`,`name`,`date`,`description`,`image_path`,`user_id`) VALUES (6,4,'Kazimierz Dolny','2018-01-01 19:30:35',"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",'https://cdn.pixabay.com/photo/2020/01/14/16/22/tree-4765461_1280.jpg',1);