-- -----------------------------
-- Structure de la table user
-- -----------------------------
CREATE TABLE `jqm_user` (
  `numero` int(11) NOT NULL AUTO_INCREMENT,
  `login` char(20) NOT NULL,
  `passwd` char(50) NOT NULL,
  `email` char(64) NOT NULL,
  PRIMARY KEY (`numero`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- admin mdp : password
INSERT INTO jqm_user VALUES('1', 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'admin@gsb.fr');
