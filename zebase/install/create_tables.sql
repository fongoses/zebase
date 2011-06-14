CREATE TABLE IF NOT EXISTS `fish` (
  `batch_ID` int(11) NOT NULL AUTO_INCREMENT,
  `gender` text,
  `name` text,
  `status` text,
  `birthday` text,
  `death_date` text,
  `mother_ID` text,
  `mother_other` text,
  `father_ID` text,
  `father_other` text,
  `tank_ID` text,
  `user_ID` text,
  `comments` text,
  `strain_ID` text,
  `mutant_ID` text,
  `other_mutant` text,
  `generation` text,
  `mutant_genotype_wildtype` varchar(15) DEFAULT NULL,
  `mutant_genotype_heterzygous` varchar(15) DEFAULT NULL,
  `mutant_genotype_homozygous` varchar(15) DEFAULT NULL,
  `current_nursery` text,
  `current_adults` text,
  `transgene_ID` text,
  `starting_adults` text,
  `starting_nursery` text NOT NULL,
  `transgene_genotype_wildtype` varchar(10) DEFAULT NULL,
  `transgene_genotype_heterzygous` varchar(10) DEFAULT NULL,
  `transgene_genotype_homozygous` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`batch_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=208 ;
^
CREATE TABLE IF NOT EXISTS `labs` (
  `lab` varchar(100) NOT NULL,
  PRIMARY KEY (`lab`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
^
CREATE TABLE IF NOT EXISTS `mutant` (
  `mutant_ID` int(11) NOT NULL AUTO_INCREMENT,
  `mutant` text NOT NULL,
  `allele` text NOT NULL,
  `reference` text NOT NULL,
  `strain` text NOT NULL,
  `cross_ref` text NOT NULL,
  `batch_name` text NOT NULL,
  `gene` text NOT NULL,
  PRIMARY KEY (`mutant_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;
^
CREATE TABLE IF NOT EXISTS `report_recipients` (
  `recipient_ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_ID` int(11) NOT NULL,
  `report_ID` int(11) NOT NULL,
  PRIMARY KEY (`recipient_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;
^
CREATE TABLE IF NOT EXISTS `saved_searches` (
  `search_ID` int(11) NOT NULL AUTO_INCREMENT,
  `search_name` text NOT NULL,
  `batch_ID` text,
  `mylab` text,
  `gender` text,
  `name` text,
  `status` text,
  `birthday` text,
  `mother_ID` text,
  `mother_other` text,
  `father_ID` text,
  `father_other` text,
  `tank_ID` text,
  `user_ID` text,
  `comments` text,
  `strain_ID` text,
  `mutant_ID` text,
  `other_mutant` text,
  `generation` text,
  `mutant_genotype_wildtype` varchar(15) DEFAULT NULL,
  `mutant_genotype_heterzygous` varchar(15) DEFAULT NULL,
  `mutant_genotype_homozygous` varchar(15) DEFAULT NULL,
  `transgene_ID` text,
  `transgene_genotype_wildtype` varchar(10) DEFAULT NULL,
  `transgene_genotype_heterzygous` varchar(10) DEFAULT NULL,
  `transgene_genotype_homozygous` varchar(10) DEFAULT NULL,
  `lab` text,
  `mutant_allele` text,
  `transgene_allele` text,
  PRIMARY KEY (`search_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;
^
CREATE TABLE IF NOT EXISTS `stat_survival_track` (
  `track_ID` int(11) NOT NULL AUTO_INCREMENT,
  `batch_ID` int(11) NOT NULL,
  `starting_adults` int(11) NOT NULL,
  `current_adults` int(11) NOT NULL,
  `status` text NOT NULL,
  `survival_precent` text NOT NULL,
  `birthday` text NOT NULL,
  `date_taken` text NOT NULL,
  `starting_nursery` int(11) NOT NULL,
  PRIMARY KEY (`track_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7473 ;
^
CREATE TABLE IF NOT EXISTS `strain` (
  `strain_ID` int(11) NOT NULL AUTO_INCREMENT,
  `strain` text NOT NULL,
  `source` text NOT NULL,
  `source_contact_info` text NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`strain_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;
^
CREATE TABLE IF NOT EXISTS `tank` (
  `tank_ID` int(11) NOT NULL AUTO_INCREMENT,
  `size` text,
  `location` text,
  `room` text NOT NULL,
  `comments` text,
  PRIMARY KEY (`tank_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1192 ;
^
CREATE TABLE IF NOT EXISTS `tank_assoc` (
  `batch_ID` int(11) NOT NULL,
  `tank_ID` varchar(30) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`batch_ID`,`tank_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
^
CREATE TABLE IF NOT EXISTS `transgene` (
  `transgene_ID` int(11) NOT NULL AUTO_INCREMENT,
  `transgene` text NOT NULL,
  `promoter` text NOT NULL,
  `gene` text NOT NULL,
  `reference` text NOT NULL,
  `strain` text NOT NULL,
  `comment` text NOT NULL,
  `allele` text,
  PRIMARY KEY (`transgene_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;
^
CREATE TABLE IF NOT EXISTS `users` (
  `user_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_pass` varchar(60) NOT NULL DEFAULT '',
  `user_date` varchar(100) NOT NULL,
  `user_modified` varchar(100) NOT NULL,
  `user_last_login` datetime DEFAULT NULL,
  `db_reference_name` varchar(100) NOT NULL,
  `lab` varchar(100) NOT NULL,
  `office_location` text NOT NULL,
  `lab_location` text NOT NULL,
  `lab_phone` varchar(80) NOT NULL,
  `emergency_phone` varchar(80) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `admin_access` varchar(100) DEFAULT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `middle_name` text NOT NULL,
  PRIMARY KEY (`user_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;
^
