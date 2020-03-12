/* 27/03/2018 aggiungo tabella video */
CREATE TABLE `video` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_veicolo` INTEGER(11) NOT NULL,
  `youtube_id` VARCHAR(250) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_veicolo` (`id_veicolo`),
  CONSTRAINT `video_cancella` FOREIGN KEY (`id_veicolo`) REFERENCES `veicoli` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=814744 CHARACTER SET 'utf8' COLLATE 'utf8_bin';