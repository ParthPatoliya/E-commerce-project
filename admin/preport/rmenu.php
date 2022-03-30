<?php
namespace PHPReportMaker12\project3;
?>
<?php
namespace PHPReportMaker12\project3;

// Menu Language
if ($Language && $Language->LanguageFolder == $LANGUAGE_FOLDER)
	$MenuLanguage = &$Language;
else
	$MenuLanguage = new Language();

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(26, "mi_Purchases_Report", $ReportLanguage->phrase("DetailSummaryReportMenuItemPrefix") . $ReportLanguage->menuPhrase("26", "MenuText") . $ReportLanguage->phrase("DetailSummaryReportMenuItemSuffix"), "Purchases_Reportsmry.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>