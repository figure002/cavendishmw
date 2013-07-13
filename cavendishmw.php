<?php
/**
 * Cavendish-MW: Branch of the Mozilla Cavendish MediaWiki skin with some
 * improvements.
 *
 * @file
 * @ingroup Skins
 * @author Serrano Pereira (serrano.pereira@gmail.com)
 * @license http://creativecommons.org/licenses/by-sa/3.0/ Creative Commons Attribution-ShareAlike 3.0 Unported License
 */

if( !defined( 'MEDIAWIKI' ) ) die( "This is an extension to the MediaWiki package and cannot be run standalone." );

$wgExtensionCredits['skin'][] = array(
    'path' => __FILE__,
    'name' => 'Cavendish-MW',
    'version' => '0.3.1',
    'url' => "http://sourceforge.net/projects/cavendishmw/",
    'author' => array('Serrano Pereira'),
    'descriptionmsg' => 'cavendishmw-desc',
);

$wgValidSkinNames['cavendishmw'] = 'CavendishMW';
$wgAutoloadClasses['SkinCavendishMW'] = dirname(__FILE__).'/CavendishMW.skin.php';
$wgExtensionMessagesFiles['CavendishMW'] = dirname(__FILE__).'/CavendishMW.i18n.php';

$wgResourceModules['skins.cavendishmw'] = array(
    'styles' => array(
        'cavendishmw/styles/monobook.css' => array( 'media' => 'screen' ),
        'cavendishmw/styles/template.css' => array( 'media' => 'screen' ),
        'cavendishmw/styles/basetemplate.css' => array( 'media' => 'screen' ),
        'cavendishmw/styles/cavendish.css' => array( 'media' => 'screen' ),
        'cavendishmw/styles/fixes.css' => array( 'media' => 'screen' ),
    ),
    'remoteBasePath' => &$GLOBALS['wgStylePath'],
    'localBasePath' => &$GLOBALS['wgStyleDirectory'],
);
