INSERT INTO `users_permissions` (`permName`, `permDesc`, `level`, `type`, `admin`, `feature_check`) VALUES('tiki_p_wiki_view_latest', 'Can view unapproved revisions of pages', 'registered', 'wiki', NULL, 'flaggedrev_approval');
INSERT INTO `users_permissions` (`permName`, `permDesc`, `level`, `type`, `admin`, `feature_check`) VALUES('tiki_p_wiki_approve', 'Can approve revisions of pages', 'editor', 'wiki', NULL, 'flaggedrev_approval');
