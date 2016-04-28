# table for addon install information

CREATE TABLE IF NOT EXISTS `tiki_addon_info` (
  `installed` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `addon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `install_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`addon`,`version`,`install_date`)
) ENGINE=MyISAM;
