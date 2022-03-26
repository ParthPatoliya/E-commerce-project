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

		// Validate method
		fsales_reportrpt.validate = function() {
			if (!this.validateRequired)
				return true; // Ignore validation
			var $ = jQuery,
				fobj = this.getForm(),
				$fobj = $(fobj),
				elm;

			// Call Form Custom Validate event
			if (!this.Form_CustomValidate(fobj))
				return false;
			return true;
		}

		// Form_CustomValidate method
		fsales_reportrpt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

			// Your custom validation code here, return false if invalid.
			return true;
		}
		<?php if (CLIENT_VALIDATE) { ?>
			fsales_reportrpt.validateRequired = true; // Uses JavaScript validation
		<?php } else { ?>
			fsales_reportrpt.validateRequired = false; // No JavaScript validation
		<?php } ?>

		// Use Ajax
		fsales_reportrpt.lists["x_Sales_Order_Date"] = <?php echo $sales_report_rpt->Sales_Order_Date->Lookup->toClientList() ?>;
		fsales_reportrpt.lists["x_Sales_Order_Date"].popupValues = <?php echo json_encode($sales_report_rpt->Sales_Order_Date->SelectionList) ?>;
		fsales_reportrpt.lists["x_Sales_Order_Date"].popupOptions = <?php echo JsonEncode($sales_report_rpt->Sales_Order_Date->popupOptions()) ?>;
		fsales_reportrpt.lists["x_Credit_Due_date"] = <?php echo $sales_report_rpt->Credit_Due_date->Lookup->toClientList() ?>;
		fsales_reportrpt.lists["x_Credit_Due_date"].popupValues = <?php echo json_encode($sales_report_rpt->Credit_Due_date->SelectionList) ?>;
		fsales_reportrpt.lists["x_Credit_Due_date"].popupOptions = <?php echo JsonEncode($sales_report_rpt->Credit_Due_date->popupOptions()) ?>;
		fsales_reportrpt.lists["x_Product_Name"] = <?php echo $sales_report_rpt->Product_Name->Lookup->toClientList() ?>;
		fsales_reportrpt.lists["x_Product_Name"].options = <?php echo JsonEncode($sales_report_rpt->Product_Name->lookupOptions()) ?>;
		fsales_reportrpt.lists["x_Company_Name"] = <?php echo $sales_report_rpt->Company_Name->Lookup->toClientList() ?>;
		fsales_reportrpt.lists["x_Company_Name"].options = <?php echo JsonEncode($sales_report_rpt->Company_Name->lookupOptions()) ?>;
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
						<div id="fsales_reportrpt-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
							<input type="hidden" name="cmd" value="search">
							<div id="r_1" class="ew-row d-sm-flex">
								<div id="c_Product_Name" class="ew-cell form-group">
									<label for="x_Product_Name" class="ew-search-caption ew-label"><?php echo $Page->Product_Name->caption() ?></label>
									<span class="ew-search-field">
										<div class="input-group">
											<select class="custom-select ew-custom-select" data-table="sales_report" data-field="x_Product_Name" data-value-separator="<?php echo $Page->Product_Name->displayValueSeparatorAttribute() ?>" id="x_Product_Name" name="x_Product_Name" <?php echo $Page->Product_Name->editAttributes() ?>>
												<?php echo $Page->Product_Name->selectOptionListHtml("x_Product_Name") ?>
											</select>
										</div>
										<?php echo $Page->Product_Name->Lookup->getParamTag("p_x_Product_Name") ?>
									</span>
								</div>
							</div>
							<div id="r_2" class="ew-row d-sm-flex">
								<div id="c_Company_Name" class="ew-cell form-group">
									<label for="x_Company_Name" class="ew-search-caption ew-label"><?php echo $Page->Company_Name->caption() ?></label>
									<span class="ew-search-field">
										<div class="input-group">
											<select class="custom-select ew-custom-select" data-table="sales_report" data-field="x_Company_Name" data-value-separator="<?php echo $Page->Company_Name->displayValueSeparatorAttribute() ?>" id="x_Company_Name" name="x_Company_Name" <?php echo $Page->Company_Name->editAttributes() ?>>
												<?php echo $Page->Company_Name->selectOptionListHtml("x_Company_Name") ?>
											</select>
										</div>
										<?php echo $Page->Company_Name->Lookup->getParamTag("p_x_Company_Name") ?>
									</span>
								</div>
							</div>
							<div class="ew-row d-sm-flex">
								<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><?php echo $ReportLanguage->phrase("Search") ?></button>
								<button type="reset" name="btn-reset" id="btn-reset" class="btn hide"><?php echo $ReportLanguage->phrase("Reset") ?></button>
							</div>
						</div>
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
							<div class="ew-grid" <?php echo $Page->ReportTableStyle ?>>
							<?php } else { ?>
								<div class="card ew-card ew-grid" <?php echo $Page->ReportTableStyle ?>>
								<?php } ?>
								<!-- Report grid (begin) -->
								<div id="gmp_sales_report" class="<?php if (IsResponsiveLayout()) {
																		echo "table-responsive ";
																	} ?>ew-grid-middle-panel">
									<table class="<?php echo $Page->ReportTableClass ?>">
										<thead>
											<!-- Table header -->
											<tr class="ew-table-header">
												<?php if ($Page->Sales_Order_Date->Visible) {
													echo '
													<div style="margin-top:-2rem;"></div>
													<img src="../assets/images/logo (1).png" alt="skumar" style="height: 100px;width: 180px;margin-bottom: -7rem;margin-left: 3rem;margin-top: 3rem;">
													<div style="margin-left: 20rem;">
													<p>
													<h2>SKumar</h2>
													
													Shop 51/2, Ramnagar Soc. Nikol Road Ahmedabad-382350<br>
													Email: skumar2911@gmail.com | Mo: +91  90164 85585
													</p>
													<p style="margin-left: 40rem;margin-right: 5px;margin-top: -2rem;">Date: ' . date('d-m-Y') . '</p>
													</div>
													<hr class="bg-dark">
													<center><h2><u>Sales Reports</u></h2></center>
													
													'; ?>
													<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
														<td data-field="Sales_Order_Date">
															<div class="sales_report_Sales_Order_Date"><span class="ew-table-header-caption"><?php echo $Page->Sales_Order_Date->caption() ?></span></div>
														</td>
													<?php } else { ?>
														<td data-field="Sales_Order_Date">
															<?php if ($Page->sortUrl($Page->Sales_Order_Date) == "") { ?>
																<div class="ew-table-header-btn sales_report_Sales_Order_Date">
																	<span class="ew-table-header-caption"><?php echo $Page->Sales_Order_Date->caption() ?></span>
																	<?php if (!$DashboardReport) { ?>
																		<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_Sales_Order_Date', form: 'fsales_reportrpt', name: 'sales_report_Sales_Order_Date', range: false, from: '<?php echo $Page->Sales_Order_Date->RangeFrom; ?>', to: '<?php echo $Page->Sales_Order_Date->RangeTo; ?>' });" id="x_Sales_Order_Date<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
																	<?php } ?>
																</div>
															<?php } else { ?>
																<div class="ew-table-header-btn ew-pointer sales_report_Sales_Order_Date" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Sales_Order_Date) ?>',0);">
																	<span class="ew-table-header-caption"><?php echo $Page->Sales_Order_Date->caption() ?></span>
																	<span class="ew-table-header-sort"><?php if ($Page->Sales_Order_Date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Sales_Order_Date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
																	<?php if (!$DashboardReport) { ?>
																		<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_Sales_Order_Date', form: 'fsales_reportrpt', name: 'sales_report_Sales_Order_Date', range: false, from: '<?php echo $Page->Sales_Order_Date->RangeFrom; ?>', to: '<?php echo $Page->Sales_Order_Date->RangeTo; ?>' });" id="x_Sales_Order_Date<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
																	<?php } ?>
																</div>
															<?php } ?>
														</td>
													<?php } ?>
												<?php } ?>
												<?php if ($Page->taxable_amount->Visible) { ?>
													<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
														<td data-field="taxable_amount">
															<div class="sales_report_taxable_amount"><span class="ew-table-header-caption"><?php echo $Page->taxable_amount->caption() ?></span></div>
														</td>
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
														<td data-field="tax_amount">
															<div class="sales_report_tax_amount"><span class="ew-table-header-caption"><?php echo $Page->tax_amount->caption() ?></span></div>
														</td>
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
														<td data-field="Total_Amount">
															<div class="sales_report_Total_Amount"><span class="ew-table-header-caption"><?php echo $Page->Total_Amount->caption() ?></span></div>
														</td>
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
														<td data-field="Credit_Due_date">
															<div class="sales_report_Credit_Due_date"><span class="ew-table-header-caption"><?php echo $Page->Credit_Due_date->caption() ?></span></div>
														</td>
													<?php } else { ?>
														<td data-field="Credit_Due_date">
															<?php if ($Page->sortUrl($Page->Credit_Due_date) == "") { ?>
																<div class="ew-table-header-btn sales_report_Credit_Due_date">
																	<span class="ew-table-header-caption"><?php echo $Page->Credit_Due_date->caption() ?></span>
																	<?php if (!$DashboardReport) { ?>
																		<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_Credit_Due_date', form: 'fsales_reportrpt', name: 'sales_report_Credit_Due_date', range: false, from: '<?php echo $Page->Credit_Due_date->RangeFrom; ?>', to: '<?php echo $Page->Credit_Due_date->RangeTo; ?>' });" id="x_Credit_Due_date<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
																	<?php } ?>
																</div>
															<?php } else { ?>
																<div class="ew-table-header-btn ew-pointer sales_report_Credit_Due_date" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Credit_Due_date) ?>',0);">
																	<span class="ew-table-header-caption"><?php echo $Page->Credit_Due_date->caption() ?></span>
																	<span class="ew-table-header-sort"><?php if ($Page->Credit_Due_date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Credit_Due_date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
																	<?php if (!$DashboardReport) { ?>
																		<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_Credit_Due_date', form: 'fsales_reportrpt', name: 'sales_report_Credit_Due_date', range: false, from: '<?php echo $Page->Credit_Due_date->RangeFrom; ?>', to: '<?php echo $Page->Credit_Due_date->RangeTo; ?>' });" id="x_Credit_Due_date<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
																	<?php } ?>
																</div>
															<?php } ?>
														</td>
													<?php } ?>
												<?php } ?>
												<?php if ($Page->Product_qty->Visible) { ?>
													<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
														<td data-field="Product_qty">
															<div class="sales_report_Product_qty"><span class="ew-table-header-caption"><?php echo $Page->Product_qty->caption() ?></span></div>
														</td>
													<?php } else { ?>
														<td data-field="Product_qty">
															<?php if ($Page->sortUrl($Page->Product_qty) == "") { ?>
																<div class="ew-table-header-btn sales_report_Product_qty">
																	<span class="ew-table-header-caption"><?php echo $Page->Product_qty->caption() ?></span>
																</div>
															<?php } else { ?>
																<div class="ew-table-header-btn ew-pointer sales_report_Product_qty" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_qty) ?>',0);">
																	<span class="ew-table-header-caption"><?php echo $Page->Product_qty->caption() ?></span>
																	<span class="ew-table-header-sort"><?php if ($Page->Product_qty->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Product_qty->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
																</div>
															<?php } ?>
														</td>
													<?php } ?>
												<?php } ?>
												<?php if ($Page->Product_Name->Visible) { ?>
													<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
														<td data-field="Product_Name">
															<div class="sales_report_Product_Name"><span class="ew-table-header-caption"><?php echo $Page->Product_Name->caption() ?></span></div>
														</td>
													<?php } else { ?>
														<td data-field="Product_Name">
															<?php if ($Page->sortUrl($Page->Product_Name) == "") { ?>
																<div class="ew-table-header-btn sales_report_Product_Name">
																	<span class="ew-table-header-caption"><?php echo $Page->Product_Name->caption() ?></span>
																</div>
															<?php } else { ?>
																<div class="ew-table-header-btn ew-pointer sales_report_Product_Name" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_Name) ?>',0);">
																	<span class="ew-table-header-caption"><?php echo $Page->Product_Name->caption() ?></span>
																	<span class="ew-table-header-sort"><?php if ($Page->Product_Name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Product_Name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
																</div>
															<?php } ?>
														</td>
													<?php } ?>
												<?php } ?>
												<?php if ($Page->Product_Details->Visible) { ?>
													<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
														<td data-field="Product_Details">
															<div class="sales_report_Product_Details"><span class="ew-table-header-caption"><?php echo $Page->Product_Details->caption() ?></span></div>
														</td>
													<?php } else { ?>
														<td data-field="Product_Details">
															<?php if ($Page->sortUrl($Page->Product_Details) == "") { ?>
																<div class="ew-table-header-btn sales_report_Product_Details">
																	<span class="ew-table-header-caption"><?php echo $Page->Product_Details->caption() ?></span>
																</div>
															<?php } else { ?>
																<div class="ew-table-header-btn ew-pointer sales_report_Product_Details" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_Details) ?>',0);">
																	<span class="ew-table-header-caption"><?php echo $Page->Product_Details->caption() ?></span>
																	<span class="ew-table-header-sort"><?php if ($Page->Product_Details->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Product_Details->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
																</div>
															<?php } ?>
														</td>
													<?php } ?>
												<?php } ?>
												<?php if ($Page->Company_Name->Visible) { ?>
													<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
														<td data-field="Company_Name">
															<div class="sales_report_Company_Name"><span class="ew-table-header-caption"><?php echo $Page->Company_Name->caption() ?></span></div>
														</td>
													<?php } else { ?>
														<td data-field="Company_Name">
															<?php if ($Page->sortUrl($Page->Company_Name) == "") { ?>
																<div class="ew-table-header-btn sales_report_Company_Name">
																	<span class="ew-table-header-caption"><?php echo $Page->Company_Name->caption() ?></span>
																</div>
															<?php } else { ?>
																<div class="ew-table-header-btn ew-pointer sales_report_Company_Name" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Company_Name) ?>',0);">
																	<span class="ew-table-header-caption"><?php echo $Page->Company_Name->caption() ?></span>
																	<span class="ew-table-header-sort"><?php if ($Page->Company_Name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Company_Name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
																</div>
															<?php } ?>
														</td>
													<?php } ?>
												<?php } ?>
												<?php if ($Page->GST->Visible) { ?>
													<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
														<td data-field="GST">
															<div class="sales_report_GST"><span class="ew-table-header-caption"><?php echo $Page->GST->caption() ?></span></div>
														</td>
													<?php } else { ?>
														<td data-field="GST">
															<?php if ($Page->sortUrl($Page->GST) == "") { ?>
																<div class="ew-table-header-btn sales_report_GST">
																	<span class="ew-table-header-caption"><?php echo $Page->GST->caption() ?></span>
																</div>
															<?php } else { ?>
																<div class="ew-table-header-btn ew-pointer sales_report_GST" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->GST) ?>',0);">
																	<span class="ew-table-header-caption"><?php echo $Page->GST->caption() ?></span>
																	<span class="ew-table-header-sort"><?php if ($Page->GST->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->GST->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
																</div>
															<?php } ?>
														</td>
													<?php } ?>
												<?php } ?>
												<?php if ($Page->Address->Visible) { ?>
													<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
														<td data-field="Address">
															<div class="sales_report_Address"><span class="ew-table-header-caption"><?php echo $Page->Address->caption() ?></span></div>
														</td>
													<?php } else { ?>
														<td data-field="Address">
															<?php if ($Page->sortUrl($Page->Address) == "") { ?>
																<div class="ew-table-header-btn sales_report_Address">
																	<span class="ew-table-header-caption"><?php echo $Page->Address->caption() ?></span>
																</div>
															<?php } else { ?>
																<div class="ew-table-header-btn ew-pointer sales_report_Address" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Address) ?>',0);">
																	<span class="ew-table-header-caption"><?php echo $Page->Address->caption() ?></span>
																	<span class="ew-table-header-sort"><?php if ($Page->Address->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Address->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
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
											<?php if ($Page->Sales_Order_Date->Visible) { ?>
												<td data-field="Sales_Order_Date" <?php echo $Page->Sales_Order_Date->cellAttributes() ?>>
													<span<?php echo $Page->Sales_Order_Date->viewAttributes() ?>><?php echo $Page->Sales_Order_Date->getViewValue() ?></span>
												</td>
											<?php } ?>
											<?php if ($Page->taxable_amount->Visible) { ?>
												<td data-field="taxable_amount" <?php echo $Page->taxable_amount->cellAttributes() ?>>
													<span<?php echo $Page->taxable_amount->viewAttributes() ?>><?php echo $Page->taxable_amount->getViewValue() ?></span>
												</td>
											<?php } ?>
											<?php if ($Page->tax_amount->Visible) { ?>
												<td data-field="tax_amount" <?php echo $Page->tax_amount->cellAttributes() ?>>
													<span<?php echo $Page->tax_amount->viewAttributes() ?>><?php echo $Page->tax_amount->getViewValue() ?></span>
												</td>
											<?php } ?>
											<?php if ($Page->Total_Amount->Visible) { ?>
												<td data-field="Total_Amount" <?php echo $Page->Total_Amount->cellAttributes() ?>>
													<span<?php echo $Page->Total_Amount->viewAttributes() ?>><?php echo $Page->Total_Amount->getViewValue() ?></span>
												</td>
											<?php } ?>
											<?php if ($Page->Credit_Due_date->Visible) { ?>
												<td data-field="Credit_Due_date" <?php echo $Page->Credit_Due_date->cellAttributes() ?>>
													<span<?php echo $Page->Credit_Due_date->viewAttributes() ?>><?php echo $Page->Credit_Due_date->getViewValue() ?></span>
												</td>
											<?php } ?>
											<?php if ($Page->Product_qty->Visible) { ?>
												<td data-field="Product_qty" <?php echo $Page->Product_qty->cellAttributes() ?>>
													<span<?php echo $Page->Product_qty->viewAttributes() ?>><?php echo $Page->Product_qty->getViewValue() ?></span>
												</td>
											<?php } ?>
											<?php if ($Page->Product_Name->Visible) { ?>
												<td data-field="Product_Name" <?php echo $Page->Product_Name->cellAttributes() ?>>
													<span<?php echo $Page->Product_Name->viewAttributes() ?>><?php echo $Page->Product_Name->getViewValue() ?></span>
												</td>
											<?php } ?>
											<?php if ($Page->Product_Details->Visible) { ?>
												<td data-field="Product_Details" <?php echo $Page->Product_Details->cellAttributes() ?>>
													<span<?php echo $Page->Product_Details->viewAttributes() ?>><?php echo $Page->Product_Details->getViewValue() ?></span>
												</td>
											<?php } ?>
											<?php if ($Page->Company_Name->Visible) { ?>
												<td data-field="Company_Name" <?php echo $Page->Company_Name->cellAttributes() ?>>
													<span<?php echo $Page->Company_Name->viewAttributes() ?>><?php echo $Page->Company_Name->getViewValue() ?></span>
												</td>
											<?php } ?>
											<?php if ($Page->GST->Visible) { ?>
												<td data-field="GST" <?php echo $Page->GST->cellAttributes() ?>>
													<span<?php echo $Page->GST->viewAttributes() ?>><?php echo $Page->GST->getViewValue() ?></span>
												</td>
											<?php } ?>
											<?php if ($Page->Address->Visible) { ?>
												<td data-field="Address" <?php echo $Page->Address->cellAttributes() ?>>
													<span<?php echo $Page->Address->viewAttributes() ?>><?php echo $Page->Address->getViewValue() ?></span>
												</td>
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
									<?php } elseif (!$Page->ShowHeader && TRUE) { // No header displayed 
									?>
										<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
											<div class="ew-grid" <?php echo $Page->ReportTableStyle ?>>
											<?php } else { ?>
												<div class="card ew-card ew-grid" <?php echo $Page->ReportTableStyle ?>>
												<?php } ?>
												<!-- Report grid (begin) -->
												<div id="gmp_sales_report" class="<?php if (IsResponsiveLayout()) {
																						echo "table-responsive ";
																					} ?>ew-grid-middle-panel">
													<table class="<?php echo $Page->ReportTableClass ?>">
													<?php } ?>
													<?php if ($Page->TotalGroups > 0 || TRUE) { // Show footer 
													?>
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