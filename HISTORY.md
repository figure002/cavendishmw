Change notes from older releases.

## Cavendish-MW 0.3.2

* (merge 3) Small tweak for English as well as adding German translation.

  The English language tweak is to adhere the MediaWiki jargon as well as to
  i18n habits (no fullstop in description on "Special:Version"). Credits to
  Karsten Hoffmeyer.

## Cavendish-MW 0.3.1

* Fixed the display of the non-breaking space in the header link when the site
  name is hidden.

## Cavendish-MW 0.3.0

Updated for MediaWiki 1.21.0.

* Rewrite of the skin.

  The following tutorial was used:
  <https://www.mediawiki.org/wiki/Manual:Skinning/Tutorial>

  The `CavendishMWTemplate` class of CavendishMW.skin.php is based on the
  `MonoBookTemplate` class of the Monobook skin. The original stylesheets for
  Cavendish-MW were reused and updated.

  The Cavendish-MW skin now works as an extension and one needs to put
  `require_once("$IP/skins/cavendishmw/cavendishmw.php");` in their
  LocalSettings.php file.

* (bug 2) The ampersand symbol is now displayed correctly in page titles.
