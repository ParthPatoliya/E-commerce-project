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
if (!isset($purchase_order_detail_rpt))
	$purchase_order_detail_rpt = new purchase_order_detail_rpt();
if (isset($Page))
	$OldPage = $Page;
$Page = &$purchase_order_detail_rpt;

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
<div id="ew-center" class="<?php echo $purchase_order_detail_rpt->CenterContentClass ?>">
<?php } ?>
<!-- Summary Report begins -->
<div id="report_summary">
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
<div id="gmp_purchase_order_detail" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Page->idPurchase_Order->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="idPurchase_Order"><div class="purchase_order_detail_idPurchase_Order"><span class="ew-table-header-caption"><?php echo $Page->idPurchase_Order->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="idPurchase_Order">
<?php if ($Page->sortUrl($Page->idPurchase_Order) == "") { ?>
		<div class="ew-table-header-btn purchase_order_detail_idPurchase_Order">
			<span class="ew-table-header-caption"><?php echo $Page->idPurchase_Order->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer purchase_order_detail_idPurchase_Order" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->idPurchase_Order) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->idPurchase_Order->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->idPurchase_Order->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->idPurchase_Order->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->pro_id->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="pro_id"><div class="purchase_order_detail_pro_id"><span class="ew-table-header-caption"><?php echo $Page->pro_id->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="pro_id">
<?php if ($Page->sortUrl($Page->pro_id) == "") { ?>
		<div class="ew-table-header-btn purchase_order_detail_pro_id">
			<span class="ew-table-header-caption"><?php echo $Page->pro_id->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer purchase_order_detail_pro_id" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->pro_id) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->pro_id->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->pro_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->pro_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Product_Qty->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Product_Qty"><div class="purchase_order_detail_Product_Qty"><span class="ew-table-header-caption"><?php echo $Page->Product_Qty->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Product_Qty">
<?php if ($Page->sortUrl($Page->Product_Qty) == "") { ?>
		<div class="ew-table-header-btn purchase_order_detail_Product_Qty">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Qty->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer purchase_order_detail_Product_Qty" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_Qty) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Qty->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Product_Qty->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Product_Qty->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Product_Master_idProduct_Master->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Product_Master_idProduct_Master"><div class="purchase_order_detail_Product_Master_idProduct_Master"><span class="ew-table-header-caption"><?php echo $Page->Product_Master_idProduct_Master->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Product_Master_idProduct_Master">
<?php if ($Page->sortUrl($Page->Product_Master_idProduct_Master) == "") { ?>
		<div class="ew-table-header-btn purchase_order_detail_Product_Master_idProduct_Master">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Master_idProduct_Master->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer purchase_order_detail_Product_Master_idProduct_Master" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_Master_idProduct_Master) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Master_idProduct_Master->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Product_Master_idProduct_Master->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Product_Master_idProduct_Master->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
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
<?php if ($Page->idPurchase_Order->Visible) { ?>
		<td data-field="idPurchase_Order"<?php echo $Page->idPurchase_Order->cellAttributes() ?>>
<span<?php echo $Page->idPurchase_Order->viewAttributes() ?>><?php echo $Page->idPurchase_Order->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->pro_id->Visible) { ?>
		<td data-field="pro_id"<?php echo $Page->pro_id->cellAttributes() ?>>
<span<?php echo $Page->pro_id->viewAttributes() ?>><?php echo $Page->pro_id->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Product_Qty->Visible) { ?>
		<td data-field="Product_Qty"<?php echo $Page->Product_Qty->cellAttributes() ?>>
<span<?php echo $Page->Product_Qty->viewAttributes() ?>><?php echo $Page->Product_Qty->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Product_Master_idProduct_Master->Visible) { ?>
		<td data-field="Product_Master_idProduct_Master"<?php echo $Page->Product_Master_idProduct_Master->cellAttributes() ?>>
<span<?php echo $Page->Product_Master_idProduct_Master->viewAttributes() ?>><?php echo $Page->Product_Master_idProduct_Master->getViewValue() ?></span></td>
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
<?php } elseif (!$Page->ShowHeader && FALSE) { // No header displayed ?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="card ew-card ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_purchase_order_detail" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<table class="<?php echo $Page->ReportTableClass ?>">
<?php } ?>
<?php if ($Page->TotalGroups > 0 || FALSE) { // Show footer ?>
</table>
</div>
<?php if ($Page->Export == "" && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php include "purchase_order_detail_pager.php" ?>
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