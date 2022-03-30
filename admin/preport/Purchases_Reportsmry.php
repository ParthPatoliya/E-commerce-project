<?php

namespace PHPReportMaker12\project3;

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
if (!isset($Purchases_Report_summary))
	$Purchases_Report_summary = new Purchases_Report_summary();
if (isset($Page))
	$OldPage = $Page;
$Page = &$Purchases_Report_summary;

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
		currentPageID = ew.PAGE_ID = "summary"; // Page ID
	</script>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
	<script>
		// Form object
		var fPurchases_Reportsummary = currentForm = new ew.Form("fPurchases_Reportsummary");

		// Validate method
		fPurchases_Reportsummary.validate = function() {
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
		fPurchases_Reportsummary.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

			// Your custom validation code here, return false if invalid.
			return true;
		}
		<?php if (CLIENT_VALIDATE) { ?>
			fPurchases_Reportsummary.validateRequired = true; // Uses JavaScript validation
		<?php } else { ?>
			fPurchases_Reportsummary.validateRequired = false; // No JavaScript validation
		<?php } ?>

		// Use Ajax
		fPurchases_Reportsummary.lists["x_Product_Name"] = <?php echo $Purchases_Report_summary->Product_Name->Lookup->toClientList() ?>;
		fPurchases_Reportsummary.lists["x_Product_Name"].options = <?php echo JsonEncode($Purchases_Report_summary->Product_Name->lookupOptions()) ?>;
		fPurchases_Reportsummary.lists["x_Category_Name"] = <?php echo $Purchases_Report_summary->Category_Name->Lookup->toClientList() ?>;
		fPurchases_Reportsummary.lists["x_Category_Name"].options = <?php echo JsonEncode($Purchases_Report_summary->Category_Name->lookupOptions()) ?>;
		fPurchases_Reportsummary.lists["x_date"] = <?php echo $Purchases_Report_summary->date->Lookup->toClientList() ?>;
		fPurchases_Reportsummary.lists["x_date"].popupValues = <?php echo json_encode($Purchases_Report_summary->date->SelectionList) ?>;
		fPurchases_Reportsummary.lists["x_date"].popupOptions = <?php echo JsonEncode($Purchases_Report_summary->date->popupOptions()) ?>;
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
			<div id="ew-center" class="<?php echo $Purchases_Report_summary->CenterContentClass ?>">
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
					<form name="fPurchases_Reportsummary" id="fPurchases_Reportsummary" class="form-inline ew-form ew-ext-filter-form" action="<?php echo CurrentPageName() ?>">
						<?php $searchPanelClass = ($Page->Filter <> "") ? " show" : " show"; ?>
						<div id="fPurchases_Reportsummary-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
							<input type="hidden" name="cmd" value="search">
							<div id="r_1" class="ew-row d-sm-flex">
								<div id="c_Product_Name" class="ew-cell form-group">
									<label for="x_Product_Name" class="ew-search-caption ew-label"><?php echo $Page->Product_Name->caption() ?></label>
									<span class="ew-search-field">
										<div class="input-group">
											<select class="custom-select ew-custom-select" data-table="Purchases_Report" data-field="x_Product_Name" data-value-separator="<?php echo $Page->Product_Name->displayValueSeparatorAttribute() ?>" id="x_Product_Name" name="x_Product_Name" <?php echo $Page->Product_Name->editAttributes() ?>>
												<?php echo $Page->Product_Name->selectOptionListHtml("x_Product_Name") ?>
											</select>
										</div>
										<?php echo $Page->Product_Name->Lookup->getParamTag("p_x_Product_Name") ?>
									</span>
								</div>
							</div>
							<div id="r_2" class="ew-row d-sm-flex">
								<div id="c_Category_Name" class="ew-cell form-group">
									<label for="x_Category_Name" class="ew-search-caption ew-label"><?php echo $Page->Category_Name->caption() ?></label>
									<span class="ew-search-field">
										<div class="input-group">
											<select class="custom-select ew-custom-select" data-table="Purchases_Report" data-field="x_Category_Name" data-value-separator="<?php echo $Page->Category_Name->displayValueSeparatorAttribute() ?>" id="x_Category_Name" name="x_Category_Name" <?php echo $Page->Category_Name->editAttributes() ?>>
												<?php echo $Page->Category_Name->selectOptionListHtml("x_Category_Name") ?>
											</select>
										</div>
										<?php echo $Page->Category_Name->Lookup->getParamTag("p_x_Category_Name") ?>
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
						fPurchases_Reportsummary.filterList = <?php echo $Page->getFilterList() ?>;
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
								<div id="gmp_Purchases_Report" class="<?php if (IsResponsiveLayout()) {
																			echo "table-responsive ";
																		} ?>ew-grid-middle-panel">
									<table class="<?php echo $Page->ReportTableClass ?>">
										<thead>
											<!-- Table header -->
											<tr class="ew-table-header">
												<?php if ($Page->Product_Name->Visible) {
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
													<center><h2><u>Purchase Reports</u></h2></center>
													
													'; ?>
													<?php if ($Page->Export <> "" || $Page->DrillDown) {
													?>
														<td data-field="Product_Name">
															<div class="Purchases_Report_Product_Name"><span class="ew-table-header-caption"><?php echo $Page->Product_Name->caption() ?></span></div>
														</td>
													<?php } else { ?>
														<td data-field="Product_Name">
															<?php if ($Page->sortUrl($Page->Product_Name) == "") { ?>
																<div class="ew-table-header-btn Purchases_Report_Product_Name">
																	<span class="ew-table-header-caption"><?php echo $Page->Product_Name->caption() ?></span>
																</div>
															<?php } else { ?>
																<div class="ew-table-header-btn ew-pointer Purchases_Report_Product_Name" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_Name) ?>',0);">
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
															<div class="Purchases_Report_Product_Details"><span class="ew-table-header-caption"><?php echo $Page->Product_Details->caption() ?></span></div>
														</td>
													<?php } else { ?>
														<td data-field="Product_Details">
															<?php if ($Page->sortUrl($Page->Product_Details) == "") { ?>
																<div class="ew-table-header-btn Purchases_Report_Product_Details">
																	<span class="ew-table-header-caption"><?php echo $Page->Product_Details->caption() ?></span>
																</div>
															<?php } else { ?>
																<div class="ew-table-header-btn ew-pointer Purchases_Report_Product_Details" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_Details) ?>',0);">
																	<span class="ew-table-header-caption"><?php echo $Page->Product_Details->caption() ?></span>
																	<span class="ew-table-header-sort"><?php if ($Page->Product_Details->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Product_Details->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
																</div>
															<?php } ?>
														</td>
													<?php } ?>
												<?php } ?>
												<?php if ($Page->Product_Qty->Visible) { ?>
													<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
														<td data-field="Product_Qty">
															<div class="Purchases_Report_Product_Qty"><span class="ew-table-header-caption"><?php echo $Page->Product_Qty->caption() ?></span></div>
														</td>
													<?php } else { ?>
														<td data-field="Product_Qty">
															<?php if ($Page->sortUrl($Page->Product_Qty) == "") { ?>
																<div class="ew-table-header-btn Purchases_Report_Product_Qty">
																	<span class="ew-table-header-caption"><?php echo $Page->Product_Qty->caption() ?></span>
																</div>
															<?php } else { ?>
																<div class="ew-table-header-btn ew-pointer Purchases_Report_Product_Qty" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_Qty) ?>',0);">
																	<span class="ew-table-header-caption"><?php echo $Page->Product_Qty->caption() ?></span>
																	<span class="ew-table-header-sort"><?php if ($Page->Product_Qty->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Product_Qty->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
																</div>
															<?php } ?>
														</td>
													<?php } ?>
												<?php } ?>
												<?php if ($Page->Product_Price->Visible) { ?>
													<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
														<td data-field="Product_Price">
															<div class="Purchases_Report_Product_Price"><span class="ew-table-header-caption"><?php echo $Page->Product_Price->caption() ?></span></div>
														</td>
													<?php } else { ?>
														<td data-field="Product_Price">
															<?php if ($Page->sortUrl($Page->Product_Price) == "") { ?>
																<div class="ew-table-header-btn Purchases_Report_Product_Price">
																	<span class="ew-table-header-caption"><?php echo $Page->Product_Price->caption() ?></span>
																</div>
															<?php } else { ?>
																<div class="ew-table-header-btn ew-pointer Purchases_Report_Product_Price" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_Price) ?>',0);">
																	<span class="ew-table-header-caption"><?php echo $Page->Product_Price->caption() ?></span>
																	<span class="ew-table-header-sort"><?php if ($Page->Product_Price->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Product_Price->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
																</div>
															<?php } ?>
														</td>
													<?php } ?>
												<?php } ?>
												<?php if ($Page->Product_Size->Visible) { ?>
													<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
														<td data-field="Product_Size">
															<div class="Purchases_Report_Product_Size"><span class="ew-table-header-caption"><?php echo $Page->Product_Size->caption() ?></span></div>
														</td>
													<?php } else { ?>
														<td data-field="Product_Size">
															<?php if ($Page->sortUrl($Page->Product_Size) == "") { ?>
																<div class="ew-table-header-btn Purchases_Report_Product_Size">
																	<span class="ew-table-header-caption"><?php echo $Page->Product_Size->caption() ?></span>
																</div>
															<?php } else { ?>
																<div class="ew-table-header-btn ew-pointer Purchases_Report_Product_Size" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_Size) ?>',0);">
																	<span class="ew-table-header-caption"><?php echo $Page->Product_Size->caption() ?></span>
																	<span class="ew-table-header-sort"><?php if ($Page->Product_Size->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Product_Size->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
																</div>
															<?php } ?>
														</td>
													<?php } ?>
												<?php } ?>
												<?php if ($Page->Product_colors->Visible) { ?>
													<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
														<td data-field="Product_colors">
															<div class="Purchases_Report_Product_colors"><span class="ew-table-header-caption"><?php echo $Page->Product_colors->caption() ?></span></div>
														</td>
													<?php } else { ?>
														<td data-field="Product_colors">
															<?php if ($Page->sortUrl($Page->Product_colors) == "") { ?>
																<div class="ew-table-header-btn Purchases_Report_Product_colors">
																	<span class="ew-table-header-caption"><?php echo $Page->Product_colors->caption() ?></span>
																</div>
															<?php } else { ?>
																<div class="ew-table-header-btn ew-pointer Purchases_Report_Product_colors" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Product_colors) ?>',0);">
																	<span class="ew-table-header-caption"><?php echo $Page->Product_colors->caption() ?></span>
																	<span class="ew-table-header-sort"><?php if ($Page->Product_colors->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Product_colors->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
																</div>
															<?php } ?>
														</td>
													<?php } ?>
												<?php } ?>
												<?php if ($Page->Category_Name->Visible) { ?>
													<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
														<td data-field="Category_Name">
															<div class="Purchases_Report_Category_Name"><span class="ew-table-header-caption"><?php echo $Page->Category_Name->caption() ?></span></div>
														</td>
													<?php } else { ?>
														<td data-field="Category_Name">
															<?php if ($Page->sortUrl($Page->Category_Name) == "") { ?>
																<div class="ew-table-header-btn Purchases_Report_Category_Name">
																	<span class="ew-table-header-caption"><?php echo $Page->Category_Name->caption() ?></span>
																</div>
															<?php } else { ?>
																<div class="ew-table-header-btn ew-pointer Purchases_Report_Category_Name" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->Category_Name) ?>',0);">
																	<span class="ew-table-header-caption"><?php echo $Page->Category_Name->caption() ?></span>
																	<span class="ew-table-header-sort"><?php if ($Page->Category_Name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->Category_Name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
																</div>
															<?php } ?>
														</td>
													<?php } ?>
												<?php } ?>
												<?php if ($Page->date->Visible) { ?>
													<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
														<td data-field="date">
															<div class="Purchases_Report_date"><span class="ew-table-header-caption"><?php echo $Page->date->caption() ?></span></div>
														</td>
													<?php } else { ?>
														<td data-field="date">
															<?php if ($Page->sortUrl($Page->date) == "") { ?>
																<div class="ew-table-header-btn Purchases_Report_date">
																	<span class="ew-table-header-caption"><?php echo $Page->date->caption() ?></span>
																	<?php if (!$DashboardReport) { ?>
																		<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_date', form: 'fPurchases_Reportsummary', name: 'Purchases_Report_date', range: false, from: '<?php echo $Page->date->RangeFrom; ?>', to: '<?php echo $Page->date->RangeTo; ?>' });" id="x_date<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
																	<?php } ?>
																</div>
															<?php } else { ?>
																<div class="ew-table-header-btn ew-pointer Purchases_Report_date" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->date) ?>',0);">
																	<span class="ew-table-header-caption"><?php echo $Page->date->caption() ?></span>
																	<span class="ew-table-header-sort"><?php if ($Page->date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
																	<?php if (!$DashboardReport) { ?>
																		<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_date', form: 'fPurchases_Reportsummary', name: 'Purchases_Report_date', range: false, from: '<?php echo $Page->date->RangeFrom; ?>', to: '<?php echo $Page->date->RangeTo; ?>' });" id="x_date<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
																	<?php } ?>
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
											<?php if ($Page->Product_Qty->Visible) { ?>
												<td data-field="Product_Qty" <?php echo $Page->Product_Qty->cellAttributes() ?>>
													<span<?php echo $Page->Product_Qty->viewAttributes() ?>><?php echo $Page->Product_Qty->getViewValue() ?></span>
												</td>
											<?php } ?>
											<?php if ($Page->Product_Price->Visible) { ?>
												<td data-field="Product_Price" <?php echo $Page->Product_Price->cellAttributes() ?>>
													<span<?php echo $Page->Product_Price->viewAttributes() ?>><?php echo $Page->Product_Price->getViewValue() ?></span>
												</td>
											<?php } ?>
											<?php if ($Page->Product_Size->Visible) { ?>
												<td data-field="Product_Size" <?php echo $Page->Product_Size->cellAttributes() ?>>
													<span<?php echo $Page->Product_Size->viewAttributes() ?>><?php echo $Page->Product_Size->getViewValue() ?></span>
												</td>
											<?php } ?>
											<?php if ($Page->Product_colors->Visible) { ?>
												<td data-field="Product_colors" <?php echo $Page->Product_colors->cellAttributes() ?>>
													<span<?php echo $Page->Product_colors->viewAttributes() ?>><?php echo $Page->Product_colors->getViewValue() ?></span>
												</td>
											<?php } ?>
											<?php if ($Page->Category_Name->Visible) { ?>
												<td data-field="Category_Name" <?php echo $Page->Category_Name->cellAttributes() ?>>
													<span<?php echo $Page->Category_Name->viewAttributes() ?>><?php echo $Page->Category_Name->getViewValue() ?></span>
												</td>
											<?php } ?>
											<?php if ($Page->date->Visible) { ?>
												<td data-field="date" <?php echo $Page->date->cellAttributes() ?>>
													<span<?php echo $Page->date->viewAttributes() ?>><?php echo $Page->date->getViewValue() ?></span>
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
											<?php
											$Page->resetAttributes();
											$Page->RowType = ROWTYPE_TOTAL;
											$Page->RowTotalType = ROWTOTAL_GRAND;
											$Page->RowTotalSubType = ROWTOTAL_FOOTER;
											$Page->RowAttrs["class"] = "ew-rpt-grand-summary";
											$Page->renderRow();
											?>
											<?php if ($Page->ShowCompactSummaryFooter) { ?>
												<tr<?php echo $Page->rowAttributes() ?>>
													<td colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?php echo $ReportLanguage->Phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $ReportLanguage->phrase("RptCnt") ?></span><?php echo $ReportLanguage->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Page->TotalCount, 0, -2, -2, -2) ?></span>)</span></td>
													</tr>
												<?php } else { ?>
													<tr<?php echo $Page->rowAttributes() ?>>
														<td colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount) ?>"><?php echo $ReportLanguage->Phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Page->TotalCount, 0, -2, -2, -2); ?><?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</span></td>
														</tr>
													<?php } ?>
										</tfoot>
									<?php } elseif (!$Page->ShowHeader && TRUE) { // No header displayed 
									?>
										<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
											<div class="ew-grid" <?php echo $Page->ReportTableStyle ?>>
											<?php } else { ?>
												<div class="card ew-card ew-grid" <?php echo $Page->ReportTableStyle ?>>
												<?php } ?>
												<!-- Report grid (begin) -->
												<div id="gmp_Purchases_Report" class="<?php if (IsResponsiveLayout()) {
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
														<?php include "Purchases_Report_pager.php" ?>
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