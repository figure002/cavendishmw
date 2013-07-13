<?php
/**
 * Cavendish-MW: Branch of the Mozilla Cavendish MediaWiki skin with some
 * improvements.
 *
 * Loosely based on the Cavendish style by Gabriel Wicke.
 *
 * This work is licensed under the Creative Commons Attribution-ShareAlike 3.0
 * Unported License. To view a copy of this license, visit
 * http://creativecommons.org/licenses/by-sa/3.0/ or send a letter to Creative
 * Commons, 171 Second Street, Suite 300, San Francisco, California, 94105, USA.
 *
 * @file
 * @ingroup Skins
 */

if( !defined( 'MEDIAWIKI' ) )
    die( -1 );

/**
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 * @ingroup Skins
 */
class SkinCavendishMW extends SkinTemplate {
    var $skinname = 'cavendishmw', $stylename = 'cavendishmw',
        $template = 'CavendishMWTemplate', $useHeadElement = true;

    /**
     * Load skin and user CSS files in the correct order
     * @param $out OutputPage object
     */
    function setupSkinUserCss( OutputPage $out ) {
        parent::setupSkinUserCss( $out );
        // Use the monobook styles as the basis.
        //$out->addModuleStyles( 'skins.monobook' );
        // Load the cavendish stylesheets.
        $out->addModuleStyles( 'skins.cavendishmw' );
    }
}

/**
 * BaseTemplate class for CavendishMW skin
 * @ingroup Skins
 */
class CavendishMWTemplate extends BaseTemplate {

    /**
     * Outputs the entire contents of the page
     */
    public function execute() {
        global $cavendishShowSitename, $cavendishSitenameIndent,
            $cavendishLogoWidth, $cavendishLogoHeight;

        // Suppress warnings to prevent notices about missing indexes in $this->data
        wfSuppressWarnings();

        // Set CavendishMW specific variables.
        $cavendishShowSitename = isset($cavendishShowSitename) ? $cavendishShowSitename : true;
        $cavendishSitenameIndent = isset($cavendishSitenameIndent) ? $cavendishSitenameIndent : '2em';
        $cavendishLogoWidth = isset($cavendishLogoWidth) ? $cavendishLogoWidth : 'auto';
        $cavendishLogoHeight = isset($cavendishLogoHeight) ? $cavendishLogoHeight : 'auto';
        $this->set('sitenameindent', $cavendishSitenameIndent);
        $this->set('logowidth', $cavendishLogoWidth);
        $this->set('logoheight', $cavendishLogoHeight);

        // Print the HTML head
        $this->html( 'headelement' );
?>

<div id="container"> <!-- cavendishmw: s/globalWrapper/container/ -->

    <!-- <div id="mozilla-org"><a href="#">Mozilla Skin</a></div> -->
    <div id="header" class="noprint">
        <a name="top" id="contentTop"></a>

        <!-- Logo + site name -->
        <h1>
            <?php
            $contents = $cavendishShowSitename ? $this->data['sitename'] : "#nbsp";
            $link = Html::element( 'a', array(
                'href' => $this->data['nav_urls']['mainpage']['href'],
                'style' => "text-indent: {$this->data['sitenameindent']}; width: {$this->data['logowidth']}; height: {$this->data['logoheight']}; background: transparent url({$this->data['logopath']}) no-repeat scroll 5px -5px;"
            ) + Linker::tooltipAndAccesskeyAttribs('p-logo'), $contents );
            // Can't use &nbsp; in Html::element directly.
            echo str_replace("#nbsp", "&nbsp;", $link);
            ?>
        </h1>

        <!-- Content action buttons -->
        <?php $this->cactions(); ?>

        <!-- Search box -->
        <?php $this->searchBox(); ?>
    </div> <!-- End header div -->

    <div id="mBody">
        <div id="side" class="noprint" <?php $this->html('userlangattributes') ?>> <!-- cavendishmw: s/column-one/side/ -->
            <ul id="nav">
                <?php
                // Display Personal tools.
                $this->personalTools();
                // Display other Navigation blocks.
                $this->renderPortals( $this->data['sidebar'] );
                ?>
            </ul> <!-- /nav -->
        </div> <!-- /side -->

        <div id="mainContent"> <!-- cavendishmw: s/column-content/mainContent/ -->
            <?php if($this->data['sitenotice']) { ?><div id="siteNotice"><?php $this->html('sitenotice') ?></div><?php } ?>

            <h1 id="firstHeading" class="firstHeading" lang="<?php
                $this->data['pageLanguage'] = $this->getSkin()->getTitle()->getPageViewLanguage()->getCode();
                $this->html( 'pageLanguage' );
            ?>"><span dir="auto"><?php $this->html('title') ?></span></h1>
            <div id="bodyContent" class="mw-body">
                <div id="siteSub"><?php $this->msg('tagline') ?></div>
                <div id="contentSub"<?php $this->html('userlangattributes') ?>><?php $this->html('subtitle') ?></div>
            <?php if($this->data['undelete']) { ?>
                <div id="contentSub2"><?php $this->html('undelete') ?></div>
            <?php } ?><?php if($this->data['newtalk'] ) { ?>
                <div class="usermessage"><?php $this->html('newtalk')  ?></div>
            <?php } ?><?php if($this->data['showjumplinks']) { ?>
                <div id="jump-to-nav" class="mw-jump"><?php $this->msg('jumpto') ?> <a href="#column-one"><?php $this->msg('jumptonavigation') ?></a><?php $this->msg( 'comma-separator' ) ?><a href="#searchInput"><?php $this->msg('jumptosearch') ?></a></div>
            <?php } ?>

                <!-- start content -->
                <?php $this->html('bodytext') ?>
                <?php if($this->data['catlinks']) { $this->html('catlinks'); } ?>
                <!-- end content -->

                <?php if($this->data['dataAfterContent']) { $this->html ('dataAfterContent'); } ?>
                <div class="visualClear"></div>
            </div>
        </div> <!-- /mainContent -->
    </div> <!-- /mBody -->

    <div class="visualClear"></div>
    <?php
        $validFooterIcons = $this->getFooterIcons( "icononly" );
        $validFooterLinks = $this->getFooterLinks( "flat" ); // Additional footer links

        if ( count( $validFooterIcons ) + count( $validFooterLinks ) > 0 ) { ?>
    <div id="footer" role="contentinfo"<?php $this->html('userlangattributes') ?>>
    <?php
            $footerEnd = '</div>';
        } else {
            $footerEnd = '';
        }
        foreach ( $validFooterIcons as $blockName => $footerIcons ) { ?>
        <div id="f-<?php echo htmlspecialchars($blockName); ?>ico">
    <?php foreach ( $footerIcons as $icon ) { ?>
            <?php echo $this->getSkin()->makeFooterIcon( $icon ); ?>

    <?php }
    ?>
        </div>
    <?php }

            if ( count( $validFooterLinks ) > 0 ) {
    ?>    <ul id="f-list">
    <?php
                foreach( $validFooterLinks as $aLink ) { ?>
            <li id="<?php echo $aLink ?>"><?php $this->html($aLink) ?></li>
    <?php
                }
    ?>
        </ul>
    <?php    }
    echo $footerEnd;
    ?>

    </div>
<?php
        $this->printTrail();
        echo Html::closeElement( 'body' );
        echo Html::closeElement( 'html' );
        wfRestoreWarnings();
    } // end of execute() method

    /*************************************************************************************************/

    /**
     * @param $sidebar array
     */
    protected function renderPortals( $sidebar ) {
        if ( !isset( $sidebar['SEARCH'] ) ) $sidebar['SEARCH'] = true;
        if ( !isset( $sidebar['TOOLBOX'] ) ) $sidebar['TOOLBOX'] = true;
        if ( !isset( $sidebar['LANGUAGES'] ) ) $sidebar['LANGUAGES'] = true;

        foreach( $sidebar as $boxName => $content ) {
            if ( $content === false )
                continue;

            if ( $boxName == 'SEARCH' ) {
                // The searchbox is disabled, because we already have one in the header.
                // Uncomment the line below to enable it again.
                //$this->searchBox();
            } elseif ( $boxName == 'TOOLBOX' ) {
                $this->toolbox();
            } elseif ( $boxName == 'LANGUAGES' ) {
                $this->languageBox();
            } else {
                $this->customBox( $boxName, $content );
            }
        }
    }

    /**
     * Prints the search box.
     */
    function searchBox() {
        global $wgUseTwoButtonsSearchForm;
?>
    <form action="<?php $this->text('wgScript') ?>" id="searchform">
        <label for="searchInput"><?php $this->msg('search') ?></label>
        <input type='hidden' name="title" value="<?php $this->text('searchtitle') ?>"/>
        <?php echo $this->makeSearchInput(array( "id" => "searchInput" )); ?>

        <?php echo $this->makeSearchButton("go", array( "id" => "searchGoButton", "class" => "searchButton" ));
        if ($wgUseTwoButtonsSearchForm): ?>&#160;
        <?php echo $this->makeSearchButton("fulltext", array( "id" => "mw-searchButton", "class" => "searchButton" ));
        else: ?>

        <div><a href="<?php $this->text('searchaction') ?>" rel="search"><?php $this->msg('powersearch-legend') ?></a></div><?php
        endif; ?>
    </form>
<?php
    }

    /**
     * Prints the cactions bar.
     */
    function cactions() {
?>
        <ul><?php
            foreach($this->data['content_actions'] as $key => $tab) {
                echo '
            ' . $this->makeListItem( $key, $tab );
            } ?>

        </ul>
<?php
    }

    /**
     * Prints the personal tools.
     */
    function personalTools() {
?>
        <li><span><?php $this->msg('personaltools') ?></span>
            <ul<?php $this->html('userlangattributes') ?>>
            <?php foreach($this->getPersonalTools() as $key => $item) { ?>
                <?php echo $this->makeListItem($key, $item); ?>
            <?php } ?>
            </ul>
        </li>
<?php
    }
    /*************************************************************************************************/
    function toolbox() {
?>
    <li><span><?php $this->msg('toolbox') ?></span>
        <ul>
<?php
        foreach ( $this->getToolbox() as $key => $tbitem ) { ?>
                <?php echo $this->makeListItem($key, $tbitem); ?>

<?php
        }
        wfRunHooks( 'MonoBookTemplateToolboxEnd', array( &$this ) );
        wfRunHooks( 'SkinTemplateToolboxEnd', array( &$this, true ) );
?>
        </ul>
    </li>
<?php
    }

    /*************************************************************************************************/
    function languageBox() {
        if( $this->data['language_urls'] ) {
?>
    <li><span><?php $this->msg('otherlanguages') ?></span>
        <ul>
<?php        foreach($this->data['language_urls'] as $key => $langlink) { ?>
                <?php echo $this->makeListItem($key, $langlink); ?>

<?php        } ?>
        </ul>
    </li>
<?php
        }
    }

    /*************************************************************************************************/
    /**
     * @param $bar string
     * @param $cont array|string
     */
    function customBox( $bar, $cont ) {
?>
        <li><span><?php $msg = wfMessage( $bar ); echo htmlspecialchars( $msg->exists() ? $msg->text() : $bar ); ?></span>
<?php   if ( is_array( $cont ) ) { ?>
            <ul>
<?php             foreach($cont as $key => $val) { ?>
                <?php echo $this->makeListItem($key, $val); ?>

<?php            } ?>
            </ul>
<?php   } else {
            # allow raw HTML block to be defined by extensions
            print $cont;
        }
?>
        </li>
<?php
    }
} // end of class
