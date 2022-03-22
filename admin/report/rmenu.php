<?php
namespace PHPReportMaker12\project2;
?>
<?php
namespace PHPReportMaker12\project2;

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
$sideMenu->addMenuItem(8, "mi_product_master", $ReportLanguage->phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->menuPhrase("8", "MenuText") . $ReportLanguage->phrase("SimpleReportMenuItemSuffix"), "product_masterrpt.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(10, "mi_purchase_order_detail", $ReportLanguage->phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->menuPhrase("10", "MenuText") . $ReportLanguage->phrase("SimpleReportMenuItemSuffix"), "purchase_order_detailrpt.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(23, "mi_sales_report", $ReportLanguage->phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->menuPhrase("23", "MenuText") . $ReportLanguage->phrase("SimpleReportMenuItemSuffix"), "sales_reportrpt.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(24, "mi_pruchase_report", $ReportLanguage->phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->menuPhrase("24", "MenuText") . $ReportLanguage->phrase("SimpleReportMenuItemSuffix"), "pruchase_reportrpt.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>