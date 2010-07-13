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
-- Table `tl_catalog_openimmo`
-- 

CREATE TABLE `tl_catalog_openimmo` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `sorting` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `name` varchar(64) NOT NULL default '',
  `catalog` int(10) unsigned NOT NULL default '0',
  `exportPath` varchar(1024) NOT NULL default '',
  `filesPath` varchar(1024) NOT NULL default '',
  `oiVersion` varchar(32) NOT NULL default '1.2.1',
  `uniqueIDField` varchar(1024) NOT NULL default ''

  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

-- 
-- Table `tl_catalog_openimmo_fields`
-- 

CREATE TABLE `tl_catalog_openimmo_fields` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `sorting` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `name` varchar(64) NOT NULL default '',
  `catField` int(10) unsigned NOT NULL default '0',
  `oiFieldGroup` varchar(1024) NOT NULL default '',
  `oiField` varchar(1024) NOT NULL default ''

  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
