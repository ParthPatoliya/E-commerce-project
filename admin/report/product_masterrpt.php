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
if (!isset($product_master_rpt))
	$product_master_rpt = new product_master_rpt();
if (isset($Page))
	$OldPage = $Page;
$Page = &$product_master_rpt;

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
<div id="ew-center" class="<?php echo $product_master_rpt->CenterContentClass ?>">
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
<div id="gmp_product_master" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Page->idProduct_Master->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="idProduct_Master"><div class="product_master_idProduct_Master"><span class="ew-table-header-caption"><?php echo $Page->idProduct_Master->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="idProduct_Master">
<?php if ($Page->sortUrl($Page->idProduct_Master) == "") { ?>
		<div class="ew-table-header-btn product_master_idProduct_Master">
			<span class="ew-table-header-caption"><?php echo $Page->idProduct_Master->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_master_idProduct_Master" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->idProduct_Master) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->idProduct_Master->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->idProduct_Master->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->idProduct_Master->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Product_Name->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Product_Name"><div class="product_master_Product_Name"><span class="ew-table-header-caption"><?php echo $Page->Product_Name->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Product_Name">
<?php if ($Page->sortUrl($Page->Product_Name) == "") { ?>
		<div class="ew-table-header-btn product_master_Product_Name">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Name->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_master_Product_Name" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_Name) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Name->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Product_Name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Product_Name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Product_Details->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Product_Details"><div class="product_master_Product_Details"><span class="ew-table-header-caption"><?php echo $Page->Product_Details->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Product_Details">
<?php if ($Page->sortUrl($Page->Product_Details) == "") { ?>
		<div class="ew-table-header-btn product_master_Product_Details">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Details->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_master_Product_Details" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_Details) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Details->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Product_Details->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Product_Details->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Product_Price->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Product_Price"><div class="product_master_Product_Price"><span class="ew-table-header-caption"><?php echo $Page->Product_Price->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Product_Price">
<?php if ($Page->sortUrl($Page->Product_Price) == "") { ?>
		<div class="ew-table-header-btn product_master_Product_Price">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Price->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_master_Product_Price" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_Price) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Price->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Product_Price->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Product_Price->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Product_Size->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Product_Size"><div class="product_master_Product_Size"><span class="ew-table-header-caption"><?php echo $Page->Product_Size->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Product_Size">
<?php if ($Page->sortUrl($Page->Product_Size) == "") { ?>
		<div class="ew-table-header-btn product_master_Product_Size">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Size->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_master_Product_Size" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_Size) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Size->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Product_Size->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Product_Size->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Product_Qty->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Product_Qty"><div class="product_master_Product_Qty"><span class="ew-table-header-caption"><?php echo $Page->Product_Qty->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Product_Qty">
<?php if ($Page->sortUrl($Page->Product_Qty) == "") { ?>
		<div class="ew-table-header-btn product_master_Product_Qty">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Qty->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_master_Product_Qty" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_Qty) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Qty->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Product_Qty->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Product_Qty->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Product_colors->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Product_colors"><div class="product_master_Product_colors"><span class="ew-table-header-caption"><?php echo $Page->Product_colors->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Product_colors">
<?php if ($Page->sortUrl($Page->Product_colors) == "") { ?>
		<div class="ew-table-header-btn product_master_Product_colors">
			<span class="ew-table-header-caption"><?php echo $Page->Product_colors->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_master_Product_colors" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_colors) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Product_colors->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Product_colors->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Product_colors->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->image_url->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="image_url"><div class="product_master_image_url"><span class="ew-table-header-caption"><?php echo $Page->image_url->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="image_url">
<?php if ($Page->sortUrl($Page->image_url) == "") { ?>
		<div class="ew-table-header-btn product_master_image_url">
			<span class="ew-table-header-caption"><?php echo $Page->image_url->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_master_image_url" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->image_url) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->image_url->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->image_url->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->image_url->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->date->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="date"><div class="product_master_date"><span class="ew-table-header-caption"><?php echo $Page->date->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="date">
<?php if ($Page->sortUrl($Page->date) == "") { ?>
		<div class="ew-table-header-btn product_master_date">
			<span class="ew-table-header-caption"><?php echo $Page->date->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_master_date" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->date) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->date->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->Product_Category_idProduct_Category->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="Product_Category_idProduct_Category"><div class="product_master_Product_Category_idProduct_Category"><span class="ew-table-header-caption"><?php echo $Page->Product_Category_idProduct_Category->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="Product_Category_idProduct_Category">
<?php if ($Page->sortUrl($Page->Product_Category_idProduct_Category) == "") { ?>
		<div class="ew-table-header-btn product_master_Product_Category_idProduct_Category">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Category_idProduct_Category->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer product_master_Product_Category_idProduct_Category" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_Category_idProduct_Category) ?>',0);">
			<span class="ew-table-header-caption"><?php echo $Page->Product_Category_idProduct_Category->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->Product_Category_idProduct_Category->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Product_Category_idProduct_Category->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
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
<?php if ($Page->idProduct_Master->Visible) { ?>
		<td data-field="idProduct_Master"<?php echo $Page->idProduct_Master->cellAttributes() ?>>
<span<?php echo $Page->idProduct_Master->viewAttributes() ?>><?php echo $Page->idProduct_Master->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Product_Name->Visible) { ?>
		<td data-field="Product_Name"<?php echo $Page->Product_Name->cellAttributes() ?>>
<span<?php echo $Page->Product_Name->viewAttributes() ?>><?php echo $Page->Product_Name->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Product_Details->Visible) { ?>
		<td data-field="Product_Details"<?php echo $Page->Product_Details->cellAttributes() ?>>
<span<?php echo $Page->Product_Details->viewAttributes() ?>><?php echo $Page->Product_Details->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Product_Price->Visible) { ?>
		<td data-field="Product_Price"<?php echo $Page->Product_Price->cellAttributes() ?>>
<span<?php echo $Page->Product_Price->viewAttributes() ?>><?php echo $Page->Product_Price->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Product_Size->Visible) { ?>
		<td data-field="Product_Size"<?php echo $Page->Product_Size->cellAttributes() ?>>
<span<?php echo $Page->Product_Size->viewAttributes() ?>><?php echo $Page->Product_Size->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Product_Qty->Visible) { ?>
		<td data-field="Product_Qty"<?php echo $Page->Product_Qty->cellAttributes() ?>>
<span<?php echo $Page->Product_Qty->viewAttributes() ?>><?php echo $Page->Product_Qty->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Product_colors->Visible) { ?>
		<td data-field="Product_colors"<?php echo $Page->Product_colors->cellAttributes() ?>>
<span<?php echo $Page->Product_colors->viewAttributes() ?>><?php echo $Page->Product_colors->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->image_url->Visible) { ?>
		<td data-field="image_url"<?php echo $Page->image_url->cellAttributes() ?>>
<span<?php echo $Page->image_url->viewAttributes() ?>><?php echo $Page->image_url->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->date->Visible) { ?>
		<td data-field="date"<?php echo $Page->date->cellAttributes() ?>>
<span<?php echo $Page->date->viewAttributes() ?>><?php echo $Page->date->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->Product_Category_idProduct_Category->Visible) { ?>
		<td data-field="Product_Category_idProduct_Category"<?php echo $Page->Product_Category_idProduct_Category->cellAttributes() ?>>
<span<?php echo $Page->Product_Category_idProduct_Category->viewAttributes() ?>><?php echo $Page->Product_Category_idProduct_Category->getViewValue() ?></span></td>
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
<div id="gmp_product_master" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<table class="<?php echo $Page->ReportTableClass ?>">
<?php } ?>
<?php if ($Page->TotalGroups > 0 || FALSE) { // Show footer ?>
</table>
</div>
<?php if ($Page->Export == "" && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php include "product_master_pager.php" ?>
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