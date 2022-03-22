<?php
namespace PHPReportMaker12\project2;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "rautoload.php";
?>
<?php

// Create page object
if (!isset($sales_report_rpt))
	$sales_report_rpt = new sales_report_rpt();
if (isset($Page))
	$OldPage = $Page;
$Page = &$sales_report_rpt;

// Run the page
$Page->run();

// Setup login status
SetClientVar("login", LoginStatus());
if (!$DashboardReport)
	WriteHeader(FALSE);

// Global Page Rendering event (in rusrfn*.php)
Page_Rendering();

// Page Rendering event
$Page->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "rheader.php" ?>
<?php } ?>
<?php if ($Page->Export == "" || $Page->Export == "print") { ?>
<script>
currentPageID = ew.PAGE_ID = "rpt"; // Page ID
</script>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
<script>

// Form object
var fsales_reportrpt = currentForm = new ew.Form("fsales_reportrpt");

// Use Ajax
fsales_reportrpt.lists["x_cancel_date"] = <?php echo $sales_report_rpt->cancel_date->Lookup->toClientList() ?>;
fsales_reportrpt.lists["x_cancel_date"].popupValues = <?php echo json_encode($sales_report_rpt->cancel_date->SelectionList) ?>;
fsales_reportrpt.lists["x_cancel_date"].popupOptions = <?php echo JsonEncode($sales_report_rpt->cancel_date->popupOptions()) ?>;
</script>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<a id="top"></a>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-container" class="container-fluid ew-container">
<?php } ?>
<?php if (ReportParam("showfilter") === TRUE) { ?>
<?php $Page->showFilterList(TRUE) ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Page->DrillDownInPanel) {
	$Page->ExportOptions->render("body");
	$Page->SearchOptions->render("body");
	$Page->FilterOptions->render("body");
	$Page->GenerateOptions->render("body");
}
?>
</div>
<?php $Page->showPageHeader(); ?>
<?php $Page->showMessage(); ?>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
<!-- Center Container - Report -->
<div id="ew-center" class="<?php echo $sales_report_rpt->CenterContentClass ?>">
<?php } ?>
<!-- Summary Report begins -->
<div id="report_summary">
<?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
<!-- Search form (begin) -->
<?php

	// Render search row
	$Page->resetAttributes();
	$Page->RowType = ROWTYPE_SEARCH;
	$Page->renderRow();
?>
<form name="fsales_reportrpt" id="fsales_reportrpt" class="form-inline ew-form ew-ext-filter-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($Page->Filter <> "") ? " show" : " show"; ?>
</form>
<script>
fsales_reportrpt.filterList = <?php echo $Page->getFilterList() ?>;
</script>
<!-- Search form (end) -->
<?php } ?>
<?php if ($Page->ShowCurrentFilter) { ?>
<?php $Page->showFilterList() ?>
<?php } ?>
<?php

// Set the last group to display if not export all
if ($Page->ExportAll && $Page->Export <> "") {
	$Page->StopGroup = $Page->TotalGroups;
} else {
	$Page->StopGroup = $Page->StartGroup + $Page->DisplayGroups - 1;
}

// Stop group <= total number of groups
if (intval($Page->StopGroup) > intval($Page->TotalGroups))
	$Page->StopGroup = $Page->TotalGroups;
$Page->RecordCount = 0;
$Page->RecordIndex = 0;

// Get first row
if ($Page->TotalGroups > 0) {
	$Page->loadRowValues(TRUE);
	$Page->GroupCount = 1;
}
$Page->GroupIndexes = InitArray(2, -1);
$Page->GroupIndexes[0] = -1;
$Page->GroupIndexes[1] = $Page->StopGroup - $Page->StartGroup + 1;
while ($Page->Recordset && !$Page->Recordset->EOF && $Page->GroupCount <= $Page->DisplayGroups || $Page->ShowHeader) {

	// Show dummy header for custom template
	// Show header

	if ($Page->ShowHeader) {
?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="card ew-card ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_sales_report" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Page->idSales_Order->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="idSales_Order"><div class="sales_report_idSales_Order"><span class="ew-table-header-caption"><?php echo $Page->idSales_Order->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="idSales_Order">
<?php if ($Page->sortUrl($Page->idSales_Order) == "") { ?>
		<div class="ew-table-header-btn sales_report_idSales_Order">
			<span class="ew-table-header-caption"><?php echo $Page->idSales_Order->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_report_idSales_Order" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->idSales_Order) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->idSales_Order->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->idSales_Order->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->idSales_Order->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Sales_Order_Date->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Sales_Order_Date"><div class="sales_report_Sales_Order_Date"><span class="ew-table-header-caption"><?php echo $Page->Sales_Order_Date->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Sales_Order_Date">
<?php if ($Page->sortUrl($Page->Sales_Order_Date) == "") { ?>
		<div class="ew-table-header-btn sales_report_Sales_Order_Date">
			<span class="ew-table-header-caption"><?php echo $Page->Sales_Order_Date->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_report_Sales_Order_Date" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Sales_Order_Date) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Sales_Order_Date->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Sales_Order_Date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Sales_Order_Date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->taxable_amount->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="taxable_amount"><div class="sales_report_taxable_amount"><span class="ew-table-header-caption"><?php echo $Page->taxable_amount->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="taxable_amount">
<?php if ($Page->sortUrl($Page->taxable_amount) == "") { ?>
		<div class="ew-table-header-btn sales_report_taxable_amount">
			<span class="ew-table-header-caption"><?php echo $Page->taxable_amount->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_report_taxable_amount" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->taxable_amount) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->taxable_amount->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->taxable_amount->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->taxable_amount->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->tax_amount->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="tax_amount"><div class="sales_report_tax_amount"><span class="ew-table-header-caption"><?php echo $Page->tax_amount->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="tax_amount">
<?php if ($Page->sortUrl($Page->tax_amount) == "") { ?>
		<div class="ew-table-header-btn sales_report_tax_amount">
			<span class="ew-table-header-caption"><?php echo $Page->tax_amount->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_report_tax_amount" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->tax_amount) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->tax_amount->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->tax_amount->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->tax_amount->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Total_Amount->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Total_Amount"><div class="sales_report_Total_Amount"><span class="ew-table-header-caption"><?php echo $Page->Total_Amount->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Total_Amount">
<?php if ($Page->sortUrl($Page->Total_Amount) == "") { ?>
		<div class="ew-table-header-btn sales_report_Total_Amount">
			<span class="ew-table-header-caption"><?php echo $Page->Total_Amount->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_report_Total_Amount" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Total_Amount) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Total_Amount->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Total_Amount->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Total_Amount->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Credit_Due_date->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Credit_Due_date"><div class="sales_report_Credit_Due_date"><span class="ew-table-header-caption"><?php echo $Page->Credit_Due_date->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Credit_Due_date">
<?php if ($Page->sortUrl($Page->Credit_Due_date) == "") { ?>
		<div class="ew-table-header-btn sales_report_Credit_Due_date">
			<span class="ew-table-header-caption"><?php echo $Page->Credit_Due_date->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_report_Credit_Due_date" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Credit_Due_date) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Credit_Due_date->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Credit_Due_date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Credit_Due_date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Net_Qty->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Net_Qty"><div class="sales_report_Net_Qty"><span class="ew-table-header-caption"><?php echo $Page->Net_Qty->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Net_Qty">
<?php if ($Page->sortUrl($Page->Net_Qty) == "") { ?>
		<div class="ew-table-header-btn sales_report_Net_Qty">
			<span class="ew-table-header-caption"><?php echo $Page->Net_Qty->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_report_Net_Qty" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Net_Qty) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Net_Qty->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Net_Qty->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Net_Qty->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->cancel_date->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="cancel_date"><div class="sales_report_cancel_date"><span class="ew-table-header-caption"><?php echo $Page->cancel_date->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="cancel_date">
<?php if ($Page->sortUrl($Page->cancel_date) == "") { ?>
		<div class="ew-table-header-btn sales_report_cancel_date">
			<span class="ew-table-header-caption"><?php echo $Page->cancel_date->caption() ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_cancel_date', form: 'fsales_reportrpt', name: 'sales_report_cancel_date', range: false, from: '<?php echo $Page->cancel_date->RangeFrom; ?>', to: '<?php echo $Page->cancel_date->RangeTo; ?>' });" id="x_cancel_date<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_report_cancel_date" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->cancel_date) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->cancel_date->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->cancel_date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->cancel_date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_cancel_date', form: 'fsales_reportrpt', name: 'sales_report_cancel_date', range: false, from: '<?php echo $Page->cancel_date->RangeFrom; ?>', to: '<?php echo $Page->cancel_date->RangeTo; ?>' });" id="x_cancel_date<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->cancel_reason->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="cancel_reason"><div class="sales_report_cancel_reason"><span class="ew-table-header-caption"><?php echo $Page->cancel_reason->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="cancel_reason">
<?php if ($Page->sortUrl($Page->cancel_reason) == "") { ?>
		<div class="ew-table-header-btn sales_report_cancel_reason">
			<span class="ew-table-header-caption"><?php echo $Page->cancel_reason->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_report_cancel_reason" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->cancel_reason) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->cancel_reason->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->cancel_reason->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->cancel_reason->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Retailer_idRetailer->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Retailer_idRetailer"><div class="sales_report_Retailer_idRetailer"><span class="ew-table-header-caption"><?php echo $Page->Retailer_idRetailer->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Retailer_idRetailer">
<?php if ($Page->sortUrl($Page->Retailer_idRetailer) == "") { ?>
		<div class="ew-table-header-btn sales_report_Retailer_idRetailer">
			<span class="ew-table-header-caption"><?php echo $Page->Retailer_idRetailer->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer sales_report_Retailer_idRetailer" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Retailer_idRetailer) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Retailer_idRetailer->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Retailer_idRetailer->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Retailer_idRetailer->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Page->TotalGroups == 0) break; // Show header only
		$Page->ShowHeader = FALSE;
	}
	$Page->RecordCount++;
	$Page->RecordIndex++;
?>
<?php

		// Render detail row
		$Page->resetAttributes();
		$Page->RowType = ROWTYPE_DETAIL;
		$Page->renderRow();
?>
	<tr<?php echo $Page->rowAttributes(); ?>>
<?php if ($Page->idSales_Order->Visible) { ?>
		<td data-field="idSales_Order"<?php echo $Page->idSales_Order->cellAttributes() ?>>
<span<?php echo $Page->idSales_Order->viewAttributes() ?>><?php echo $Page->idSales_Order->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Sales_Order_Date->Visible) { ?>
		<td data-field="Sales_Order_Date"<?php echo $Page->Sales_Order_Date->cellAttributes() ?>>
<span<?php echo $Page->Sales_Order_Date->viewAttributes() ?>><?php echo $Page->Sales_Order_Date->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->taxable_amount->Visible) { ?>
		<td data-field="taxable_amount"<?php echo $Page->taxable_amount->cellAttributes() ?>>
<span<?php echo $Page->taxable_amount->viewAttributes() ?>><?php echo $Page->taxable_amount->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->tax_amount->Visible) { ?>
		<td data-field="tax_amount"<?php echo $Page->tax_amount->cellAttributes() ?>>
<span<?php echo $Page->tax_amount->viewAttributes() ?>><?php echo $Page->tax_amount->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Total_Amount->Visible) { ?>
		<td data-field="Total_Amount"<?php echo $Page->Total_Amount->cellAttributes() ?>>
<span<?php echo $Page->Total_Amount->viewAttributes() ?>><?php echo $Page->Total_Amount->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Credit_Due_date->Visible) { ?>
		<td data-field="Credit_Due_date"<?php echo $Page->Credit_Due_date->cellAttributes() ?>>
<span<?php echo $Page->Credit_Due_date->viewAttributes() ?>><?php echo $Page->Credit_Due_date->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Net_Qty->Visible) { ?>
		<td data-field="Net_Qty"<?php echo $Page->Net_Qty->cellAttributes() ?>>
<span<?php echo $Page->Net_Qty->viewAttributes() ?>><?php echo $Page->Net_Qty->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->cancel_date->Visible) { ?>
		<td data-field="cancel_date"<?php echo $Page->cancel_date->cellAttributes() ?>>
<span<?php echo $Page->cancel_date->viewAttributes() ?>><?php echo $Page->cancel_date->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->cancel_reason->Visible) { ?>
		<td data-field="cancel_reason"<?php echo $Page->cancel_reason->cellAttributes() ?>>
<span<?php echo $Page->cancel_reason->viewAttributes() ?>><?php echo $Page->cancel_reason->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Retailer_idRetailer->Visible) { ?>
		<td data-field="Retailer_idRetailer"<?php echo $Page->Retailer_idRetailer->cellAttributes() ?>>
<span<?php echo $Page->Retailer_idRetailer->viewAttributes() ?>><?php echo $Page->Retailer_idRetailer->getViewValue() ?></span></td>
<?php } ?>
	</tr>
<?php

		// Accumulate page summary
		$Page->accumulateSummary();

		// Get next record
		$Page->loadRowValues();
	$Page->GroupCount++;
} // End while
?>
<?php if ($Page->TotalGroups > 0) { ?>
</tbody>
<tfoot>
	</tfoot>
<?php } elseif (!$Page->ShowHeader && TRUE) { // No header displayed ?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="card ew-card ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_sales_report" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<table class="<?php echo $Page->ReportTableClass ?>">
<?php } ?>
<?php if ($Page->TotalGroups > 0 || TRUE) { // Show footer ?>
</table>
</div>
<?php if ($Page->Export == "" && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php include "sales_report_pager.php" ?>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
</div>
<!-- Summary Report Ends -->
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
</div>
<!-- /.ew-container -->
<?php } ?>
<?php
$Page->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php

// Close recordsets
if ($Page->GroupRecordset)
	$Page->GroupRecordset->Close();
if ($Page->Recordset)
	$Page->Recordset->Close();
?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
<script>

// Write your table-specific startup script here
// console.log("page loaded");

</script>
<?php } ?>
<?php if (!$DashboardReport) { ?>
<?php include_once "rfooter.php" ?>
<?php } ?>
<?php
$Page->terminate();
if (isset($OldPage))
	$Page = $OldPage;
?>