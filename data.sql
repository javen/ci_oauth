DROP DATABASE IF EXISTS `oauth`;
CREATE DATABASE IF NOT EXISTS `oauth` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `oauth`;
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` char(11)  NOT NULL, 
    `password` varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;