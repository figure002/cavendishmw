Change notes from older releases.

# Cavendish-MW 0.3.0

Updated for MediaWiki 1.21.0.

* The skin was rewritten from scratch by following this tutorial:
  <https://www.mediawiki.org/wiki/Manual:Skinning/Tutorial>

  The `CavendishMWTemplate` class of CavendishMW.skin.php is based on the
  `MonoBookTemplate` class of the Monobook skin. The original stylesheets for
  Cavendish-MW were reused and updated.

  The Cavendish-MW skin now works as an extension and one needs to put
  `require_once("$IP/skins/cavendishmw/cavendishmw.php");` in their
  LocalSettings.php file.

* (bug 2) The ampersand symbol is now displayed correctly in page titles.
