-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************


-- --------------------------------------------------------

--
-- Table `tl_metamodels_openimmo`
--

CREATE TABLE `tl_metamodels_openimmo` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `sorting` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `name` varchar(64) NOT NULL default '',
  `metamodel` int(10) unsigned NOT NULL default '0',
  `exportPath` blob NULL,
  `filesPath` blob NULL,
  `oiVersion` varchar(32) NOT NULL default '1.2.1',
  `uniqueIDField` varchar(1024) NOT NULL default '',
  `deleteFilesOlderThen` int(10) unsigned NOT NULL default '0',
  `autoSync` varchar(16) NOT NULL default 'never',
  `lastSync` int(32) NOT NULL default '0'

  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table `tl_metamodels_openimmo_fields`
--

CREATE TABLE `tl_metamodels_openimmo_fields` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `sorting` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `name` varchar(64) NOT NULL default '',
  `metamodelAttribute` int(10) unsigned NOT NULL default '0',
  `oiFieldGroup` varchar(1024) NOT NULL default '',
  `oiField` varchar(1024) NOT NULL default '',
  `oiCustomField` varchar(1024) NOT NULL default '',
  `oiCallback` varchar(1024) NOT NULL default '',
  `oiDefaultValue` varchar(1024) NOT NULL default '',
  `oiConditionField` varchar(1024) NOT NULL default '',
  `oiConditionValue` varchar(1024) NOT NULL default ''

  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table `tl_metamodels_openimmo_history`
--

CREATE TABLE `tl_metamodels_openimmo_history` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `file` varchar(1024) NOT NULL default '',
  `synctime` int(10) unsigned NOT NULL default '0',
  `filetime` int(10) unsigned NOT NULL default '0',
  `user` varchar(64) NOT NULL default '',
  `status` int(1) unsigned NOT NULL default '0',

  PRIMARY KEY  (`id`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
