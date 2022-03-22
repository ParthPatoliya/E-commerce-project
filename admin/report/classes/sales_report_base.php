<?php
namespace PHPReportMaker12\project2;

/**
 * Table class for sales report
 */
class sales_report_base extends ReportTable
{
	public $ShowGroupHeaderAsRow = FALSE;
	public $ShowCompactSummaryFooter = TRUE;
	public $idSales_Order;
	public $Sales_Order_Date;
	public $taxable_amount;
	public $tax_amount;
	public $Total_Amount;
	public $Credit_Due_date;
	public $Net_Qty;
	public $is_cancel;
	public $cancel_date;
	public $cancel_reason;
	public $Retailer_idRetailer;

	// Constructor
	public function __construct()
	{
		global $ReportLanguage, $CurrentLanguage;

		// Language object
		if (!isset($ReportLanguage))
			$ReportLanguage = new ReportLanguage();
		$this->TableVar = 'sales_report_base';
		$this->TableName = 'sales report';
		$this->TableType = 'VIEW';
		$this->TableReportType = 'rpt';
		$this->SourceTableIsCustomView = FALSE;
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0;

		// idSales_Order
		$this->idSales_Order = new ReportField('sales_report_base', 'sales report', 'x_idSales_Order', 'idSales_Order', '`idSales_Order`', 3, -1, FALSE, 'FORMATTED TEXT', 'NO');
		$this->idSales_Order->Sortable = TRUE; // Allow sort
		$this->idSales_Order->DefaultErrorMessage = $ReportLanguage->phrase("IncorrectInteger");
		$this->idSales_Order->DateFilter = "";
		$this->fields['idSales_Order'] = &$this->idSales_Order;

		// Sales_Order_Date
		$this->Sales_Order_Date = new ReportField('sales_report_base', 'sales report', 'x_Sales_Order_Date', 'Sales_Order_Date', '`Sales_Order_Date`', 135, 0, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Sales_Order_Date->Sortable = TRUE; // Allow sort
		$this->Sales_Order_Date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $ReportLanguage->phrase("IncorrectDate"));
		$this->Sales_Order_Date->DateFilter = "";
		$this->fields['Sales_Order_Date'] = &$this->Sales_Order_Date;

		// taxable_amount
		$this->taxable_amount = new ReportField('sales_report_base', 'sales report', 'x_taxable_amount', 'taxable_amount', '`taxable_amount`', 3, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->taxable_amount->Sortable = TRUE; // Allow sort
		$this->taxable_amount->DefaultErrorMessage = $ReportLanguage->phrase("IncorrectInteger");
		$this->taxable_amount->DateFilter = "";
		$this->fields['taxable_amount'] = &$this->taxable_amount;

		// tax_amount
		$this->tax_amount = new ReportField('sales_report_base', 'sales report', 'x_tax_amount', 'tax_amount', '`tax_amount`', 3, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tax_amount->Sortable = TRUE; // Allow sort
		$this->tax_amount->DefaultErrorMessage = $ReportLanguage->phrase("IncorrectInteger");
		$this->tax_amount->DateFilter = "";
		$this->fields['tax_amount'] = &$this->tax_amount;

		// Total_Amount
		$this->Total_Amount = new ReportField('sales_report_base', 'sales report', 'x_Total_Amount', 'Total_Amount', '`Total_Amount`', 131, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Total_Amount->Sortable = TRUE; // Allow sort
		$this->Total_Amount->DefaultErrorMessage = $ReportLanguage->phrase("IncorrectFloat");
		$this->Total_Amount->DateFilter = "";
		$this->fields['Total_Amount'] = &$this->Total_Amount;

		// Credit_Due_date
		$this->Credit_Due_date = new ReportField('sales_report_base', 'sales report', 'x_Credit_Due_date', 'Credit_Due_date', '`Credit_Due_date`', 135, 0, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Credit_Due_date->Sortable = TRUE; // Allow sort
		$this->Credit_Due_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $ReportLanguage->phrase("IncorrectDate"));
		$this->Credit_Due_date->DateFilter = "";
		$this->fields['Credit_Due_date'] = &$this->Credit_Due_date;

		// Net_Qty
		$this->Net_Qty = new ReportField('sales_report_base', 'sales report', 'x_Net_Qty', 'Net_Qty', '`Net_Qty`', 3, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Net_Qty->Sortable = TRUE; // Allow sort
		$this->Net_Qty->DefaultErrorMessage = $ReportLanguage->phrase("IncorrectInteger");
		$this->Net_Qty->DateFilter = "";
		$this->fields['Net_Qty'] = &$this->Net_Qty;

		// is_cancel
		$this->is_cancel = new ReportField('sales_report_base', 'sales report', 'x_is_cancel', 'is_cancel', '`is_cancel`', 16, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->is_cancel->Sortable = TRUE; // Allow sort
		$this->is_cancel->DefaultErrorMessage = $ReportLanguage->phrase("IncorrectInteger");
		$this->is_cancel->DateFilter = "";
		$this->fields['is_cancel'] = &$this->is_cancel;

		// cancel_date
		$this->cancel_date = new ReportField('sales_report_base', 'sales report', 'x_cancel_date', 'cancel_date', '`cancel_date`', 135, 0, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cancel_date->Sortable = TRUE; // Allow sort
		$this->cancel_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $ReportLanguage->phrase("IncorrectDate"));
		$this->cancel_date->DateFilter = "";
		$this->cancel_date->Lookup = new ReportLookup('cancel_date', 'sales_report_base', TRUE, 'cancel_date', ["cancel_date","","",""], [], [], [], [], [], [], '`cancel_date` ASC', '');
		$this->cancel_date->Lookup->RenderViewFunc = "renderLookup";
		$this->fields['cancel_date'] = &$this->cancel_date;

		// cancel_reason
		$this->cancel_reason = new ReportField('sales_report_base', 'sales report', 'x_cancel_reason', 'cancel_reason', '`cancel_reason`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cancel_reason->Sortable = TRUE; // Allow sort
		$this->cancel_reason->DateFilter = "";
		$this->fields['cancel_reason'] = &$this->cancel_reason;

		// Retailer_idRetailer
		$this->Retailer_idRetailer = new ReportField('sales_report_base', 'sales report', 'x_Retailer_idRetailer', 'Retailer_idRetailer', '`Retailer_idRetailer`', 3, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Retailer_idRetailer->Sortable = TRUE; // Allow sort
		$this->Retailer_idRetailer->DefaultErrorMessage = $ReportLanguage->phrase("IncorrectInteger");
		$this->Retailer_idRetailer->DateFilter = "";
		$this->fields['Retailer_idRetailer'] = &$this->Retailer_idRetailer;
	}

	// Render for popup
	public function renderPopup()
	{
		global $ReportLanguage;
		if ($this->cancel_date->CurrentValue === NULL) // Handle null value
			$this->cancel_date->ViewValue = $ReportLanguage->phrase("NullLabel");
		elseif ($this->cancel_date->CurrentValue == "") // Handle empty value
			$this->cancel_date->ViewValue = $ReportLanguage->phrase("EmptyLabel");
		else
			$this->cancel_date->ViewValue = $this->cancel_date->CurrentValue;
	}

	// Render for lookup
	public function renderLookup()
	{
	}

	// Get Field Visibility
	public function getFieldVisibility($fldparm)
	{
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Single column sort
	protected function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			if ($fld->GroupingFieldId == 0)
				$this->setDetailOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			if ($fld->GroupingFieldId == 0) $fld->setSort("");
		}
	}

	// Get Sort SQL
	protected function sortSql()
	{
		$dtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
		$argrps = [];
		foreach ($this->fields as $fld) {
			if ($fld->getSort() <> "") {
				$fldsql = $fld->Expression;
				if ($fld->GroupingFieldId > 0) {
					if ($fld->GroupSql <> "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->GroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
				}
			}
		}
		$sortSql = "";
		foreach ($argrps as $grp) {
			if ($sortSql <> "") $sortSql .= ", ";
			$sortSql .= $grp;
		}
		if ($dtlSortSql <> "") {
			if ($sortSql <> "") $sortSql .= ", ";
			$sortSql .= $dtlSortSql;
		}
		return $sortSql;
	}

	// Table level SQL
	private $_sqlFrom = "";
	private $_sqlSelect = "";
	private $_sqlWhere = "";
	private $_sqlGroupBy = "";
	private $_sqlHaving = "";
	private $_sqlOrderBy = "";

	// From
	public function getSqlFrom()
	{
		return ($this->_sqlFrom <> "") ? $this->_sqlFrom : "`sales report`";
	}
	public function setSqlFrom($v)
	{
		$this->_sqlFrom = $v;
	}

	// Select
	public function getSqlSelect()
	{
		return ($this->_sqlSelect <> "") ? $this->_sqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function setSqlSelect($v)
	{
		$this->_sqlSelect = $v;
	}

	// Where
	public function getSqlWhere()
	{
		$where = ($this->_sqlWhere <> "") ? $this->_sqlWhere : "";
		$filter = "";
		AddFilter($where, $filter);
		return $where;
	}
	public function setSqlWhere($v)
	{
		$this->_sqlWhere = $v;
	}

	// Group By
	public function getSqlGroupBy()
	{
		return ($this->_sqlGroupBy <> "") ? $this->_sqlGroupBy : "";
	}
	public function setSqlGroupBy($v)
	{
		$this->_sqlGroupBy = $v;
	}

	// Having
	public function getSqlHaving()
	{
		return ($this->_sqlHaving <> "") ? $this->_sqlHaving : "";
	}
	public function setSqlHaving($v)
	{
		$this->_sqlHaving = $v;
	}

	// Order By
	public function getSqlOrderBy()
	{
		return ($this->_sqlOrderBy <> "") ? $this->_sqlOrderBy : "";
	}
	public function setSqlOrderBy($v)
	{
		$this->_sqlOrderBy = $v;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Summary properties
	private $_sqlSelectAggregate = "";
	private $_sqlAggregatePrefix = "";
	private $_sqlAggregateSuffix = "";
	private $_sqlSelectCount = "";

	// Select Aggregate
	public function getSqlSelectAggregate()
	{
		return ($this->_sqlSelectAggregate <> "") ? $this->_sqlSelectAggregate : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectAggregate($v)
	{
		$this->_sqlSelectAggregate = $v;
	}

	// Aggregate Prefix
	public function getSqlAggregatePrefix()
	{
		return ($this->_sqlAggregatePrefix <> "") ? $this->_sqlAggregatePrefix : "";
	}
	public function setSqlAggregatePrefix($v)
	{
		$this->_sqlAggregatePrefix = $v;
	}

	// Aggregate Suffix
	public function getSqlAggregateSuffix()
	{
		return ($this->_sqlAggregateSuffix <> "") ? $this->_sqlAggregateSuffix : "";
	}
	public function setSqlAggregateSuffix($v)
	{
		$this->_sqlAggregateSuffix = $v;
	}

	// Select Count
	public function getSqlSelectCount()
	{
		return ($this->_sqlSelectCount <> "") ? $this->_sqlSelectCount : "SELECT COUNT(*) FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectCount($v)
	{
		$this->_sqlSelectCount = $v;
	}

	// Get record count
	public function getRecordCount($sql)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery and SELECT DISTINCT
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) && !preg_match('/^\s*select\s+distinct\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = &$this->getConnection();
		$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = '';
		return $rs;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		global $DashboardReport;
		return "";
	}

	// Lookup data from table
	public function lookup()
	{

		// Load lookup parameters
		$distinct = ConvertToBool(Post("distinct"));
		$linkField = Post("linkField");
		$displayFields = Post("displayFields");
		$parentFields = Post("parentFields");
		if (!is_array($parentFields))
			$parentFields = [];
		$childFields = Post("childFields");
		if (!is_array($childFields))
			$childFields = [];
		$filterFields = Post("filterFields");
		if (!is_array($filterFields))
			$filterFields = [];
		$filterFieldVars = Post("filterFieldVars");
		if (!is_array($filterFieldVars))
			$filterFieldVars = [];
		$filterOperators = Post("filterOperators");
		if (!is_array($filterOperators))
			$filterOperators = [];
		$autoFillSourceFields = Post("autoFillSourceFields");
		if (!is_array($autoFillSourceFields))
			$autoFillSourceFields = [];
		$formatAutoFill = FALSE;
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = AUTO_SUGGEST_MAX_ENTRIES;
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));

		// Create lookup object and output JSON
		$lookup = new ReportLookup($linkField, $this->TableVar, $distinct, $linkField, $displayFields, $parentFields, $childFields, $filterFields, $filterFieldVars, $autoFillSourceFields);
		foreach ($filterFields as $i => $filterField) { // Set up filter operators
			if (@$filterOperators[$i] <> "")
				$lookup->setFilterOperator($filterField, $filterOperators[$i]);
		}
		$lookup->LookupType = $lookupType; // Lookup type
		if (Post("keys") !== NULL) { // Selected records from modal
			$keys = Post("keys");
			if (is_array($keys))
				$keys = implode(LOOKUP_FILTER_VALUE_SEPARATOR, $keys);
			$lookup->FilterValues[] = $keys; // Lookup values
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($filterFields) ? count($filterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect <> "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter <> "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy <> "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson();
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = THUMBNAIL_DEFAULT_WIDTH, $height = THUMBNAIL_DEFAULT_HEIGHT)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Page Selecting event
	function Page_Selecting(&$filter) {

		// Enter your code here
	}

	// Page Breaking event
	function Page_Breaking(&$break, &$content) {

		// Example:
		//$break = FALSE; // Skip page break, or
		//$content = "<div style=\"page-break-after:always;\">&nbsp;</div>"; // Modify page break content

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Cell Rendered event
	function Cell_Rendered(&$Field, $CurrentValue, &$ViewValue, &$ViewAttrs, &$CellAttrs, &$HrefValue, &$LinkAttrs) {

		//$ViewValue = "xxx";
		//$ViewAttrs["class"] = "xxx";

	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}

	// Load Filters event
	function Page_FilterLoad() {

		// Enter your code here
		// Example: Register/Unregister Custom Extended Filter
		//RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A', PROJECT_NAMESPACE . 'GetStartsWithAFilter'); // With function, or
		//RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A'); // No function, use Page_Filtering event
		//UnregisterFilter($this-><Field>, 'StartsWithA');

	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Page Filtering event
	function Page_Filtering(&$fld, &$filter, $typ, $opr = "", $val = "", $cond = "", $opr2 = "", $val2 = "") {

		// Note: ALWAYS CHECK THE FILTER TYPE ($typ)! Example:
		//if ($typ == "dropdown" && $fld->Name == "MyField") // Dropdown filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "extended" && $fld->Name == "MyField") // Extended filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "popup" && $fld->Name == "MyField") // Popup filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "custom" && $opr == "..." && $fld->Name == "MyField") // Custom filter, $opr is the custom filter ID
		//	$filter = "..."; // Modify the filter

	}

	// Email Sending event
	function Email_Sending(&$email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		// Enter your code here
	}
}
?>