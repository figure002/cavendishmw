# Cavendish-MW 0.3.0

This is the README file for Cavendish-MW 0.3.0, a skin for MediaWiki. This skin
is based on Mozilla's Cavendish skin for MediaWiki.

Cavendish-MW 0.3.0 has been tested with MediaWiki 1.21.0. It might not work
well with other versions of MediaWiki.

## Installation Instructions

To install the Cavendish-MW skin, extract the files from the archive to the
"skins" folder of your MediaWiki installation.

Alternatively, you can use Git to clone the entire repository (the advantage
is that you can easily update the skin by running the command `git pull`):

    cd skins/
    git clone https://github.com/figure002/cavendishmw.git

You should now have the directory `skins/cavendishmw/` in your MediaWiki
installation.

Now open LocalSettings.php and add the following line somewhere at the end of
the file:

    require_once("$IP/skins/cavendishmw/cavendishmw.php");

That's it.

On your MediaWiki Preferences page, click on the Appearance tab. Under "Skin"
there should be an option "Cavendish-MW". Select the skin you would like to use
for your account and click Save.

## Configuration

MediaWiki and the Cavendish-MW skin can be configured by editing the file
LocalSettings.php in the root folder of your MediaWiki installation. Open this
file with a text editor.

### Set as default

If you want to set the default skin for all users to Cavendish-MW, set the
variable `$wgDefaultSkin` to 'cavendishmw'. The value must be in lowercase,

    $wgDefaultSkin = 'cavendishmw';

### Change the header logo

To change the header logo, change the variable `$wgLogo`. Set it to the path
of the logo file.

### Cavendish-MW variables

You can use the following variables to further customize Cavendish-MW. The
values shown below are the default values.

    // Set to 'false' to hide the site name in the header.
    $cavendishShowSitename = true;

    // The indentation for the site name. You may alter the value depending on
    // the size of the logo you use.
    $cavendishSitenameIndent = '2em';

    // The width of the site name area. Set this to a fixed value if your logo
    // exeeds the width of the area.
    $cavendishLogoWidth = 'auto';

    // The height of the site name area. Set this to a fixed value if your logo
    // exeeds the height of the area.
    $cavendishLogoHeight = 'auto';

## License

This work is licensed under the [Creative Commons Attribution-ShareAlike 3.0 Unported License](http://creativecommons.org/licenses/by-sa/3.0/).
