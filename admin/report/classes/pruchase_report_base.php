<?php
namespace PHPReportMaker12\project2;

/**
 * Table class for pruchase report
 */
class pruchase_report_base extends ReportTable
{
	public $ShowGroupHeaderAsRow = FALSE;
	public $ShowCompactSummaryFooter = TRUE;
	public $idProduct_Master;
	public $Product_Name;
	public $Product_Details;
	public $Product_Price;
	public $Product_Size;
	public $Product_Qty;
	public $Product_colors;
	public $image_url;
	public $date;
	public $Product_Category_idProduct_Category;
	public $idPurchase_Order;
	public $pro_id;
	public $Product_Qty1;

	// Constructor
	public function __construct()
	{
		global $ReportLanguage, $CurrentLanguage;

		// Language object
		if (!isset($ReportLanguage))
			$ReportLanguage = new ReportLanguage();
		$this->TableVar = 'pruchase_report_base';
		$this->TableName = 'pruchase report';
		$this->TableType = 'VIEW';
		$this->TableReportType = 'rpt';
		$this->SourceTableIsCustomView = FALSE;
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0;

		// idProduct_Master
		$this->idProduct_Master = new ReportField('pruchase_report_base', 'pruchase report', 'x_idProduct_Master', 'idProduct_Master', '`idProduct_Master`', 3, -1, FALSE, 'FORMATTED TEXT', 'NO');
		$this->idProduct_Master->Sortable = TRUE; // Allow sort
		$this->idProduct_Master->DefaultErrorMessage = $ReportLanguage->phrase("IncorrectInteger");
		$this->idProduct_Master->DateFilter = "";
		$this->fields['idProduct_Master'] = &$this->idProduct_Master;

		// Product_Name
		$this->Product_Name = new ReportField('pruchase_report_base', 'pruchase report', 'x_Product_Name', 'Product_Name', '`Product_Name`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Product_Name->Sortable = TRUE; // Allow sort
		$this->Product_Name->DateFilter = "";
		$this->fields['Product_Name'] = &$this->Product_Name;

		// Product_Details
		$this->Product_Details = new ReportField('pruchase_report_base', 'pruchase report', 'x_Product_Details', 'Product_Details', '`Product_Details`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Product_Details->Sortable = TRUE; // Allow sort
		$this->Product_Details->DateFilter = "";
		$this->fields['Product_Details'] = &$this->Product_Details;

		// Product_Price
		$this->Product_Price = new ReportField('pruchase_report_base', 'pruchase report', 'x_Product_Price', 'Product_Price', '`Product_Price`', 3, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Product_Price->Sortable = TRUE; // Allow sort
		$this->Product_Price->DefaultErrorMessage = $ReportLanguage->phrase("IncorrectInteger");
		$this->Product_Price->DateFilter = "";
		$this->fields['Product_Price'] = &$this->Product_Price;

		// Product_Size
		$this->Product_Size = new ReportField('pruchase_report_base', 'pruchase report', 'x_Product_Size', 'Product_Size', '`Product_Size`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Product_Size->Sortable = TRUE; // Allow sort
		$this->Product_Size->DateFilter = "";
		$this->fields['Product_Size'] = &$this->Product_Size;

		// Product_Qty
		$this->Product_Qty = new ReportField('pruchase_report_base', 'pruchase report', 'x_Product_Qty', 'Product_Qty', '`Product_Qty`', 3, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Product_Qty->Sortable = TRUE; // Allow sort
		$this->Product_Qty->DefaultErrorMessage = $ReportLanguage->phrase("IncorrectInteger");
		$this->Product_Qty->DateFilter = "";
		$this->fields['Product_Qty'] = &$this->Product_Qty;

		// Product_colors
		$this->Product_colors = new ReportField('pruchase_report_base', 'pruchase report', 'x_Product_colors', 'Product_colors', '`Product_colors`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Product_colors->Sortable = TRUE; // Allow sort
		$this->Product_colors->DateFilter = "";
		$this->fields['Product_colors'] = &$this->Product_colors;

		// image_url
		$this->image_url = new ReportField('pruchase_report_base', 'pruchase report', 'x_image_url', 'image_url', '`image_url`', 200, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->image_url->Sortable = TRUE; // Allow sort
		$this->image_url->DateFilter = "";
		$this->fields['image_url'] = &$this->image_url;

		// date
		$this->date = new ReportField('pruchase_report_base', 'pruchase report', 'x_date', 'date', '`date`', 135, 0, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->date->Sortable = TRUE; // Allow sort
		$this->date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $ReportLanguage->phrase("IncorrectDate"));
		$this->date->DateFilter = "";
		$this->date->Lookup = new ReportLookup('date', 'pruchase_report_base', TRUE, 'date', ["date","","",""], [], [], [], [], [], [], '`date` ASC', '');
		$this->date->Lookup->RenderViewFunc = "renderLookup";
		$this->fields['date'] = &$this->date;

		// Product_Category_idProduct_Category
		$this->Product_Category_idProduct_Category = new ReportField('pruchase_report_base', 'pruchase report', 'x_Product_Category_idProduct_Category', 'Product_Category_idProduct_Category', '`Product_Category_idProduct_Category`', 3, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Product_Category_idProduct_Category->Sortable = TRUE; // Allow sort
		$this->Product_Category_idProduct_Category->DefaultErrorMessage = $ReportLanguage->phrase("IncorrectInteger");
		$this->Product_Category_idProduct_Category->DateFilter = "";
		$this->fields['Product_Category_idProduct_Category'] = &$this->Product_Category_idProduct_Category;

		// idPurchase_Order
		$this->idPurchase_Order = new ReportField('pruchase_report_base', 'pruchase report', 'x_idPurchase_Order', 'idPurchase_Order', '`idPurchase_Order`', 3, -1, FALSE, 'FORMATTED TEXT', 'NO');
		$this->idPurchase_Order->Sortable = TRUE; // Allow sort
		$this->idPurchase_Order->DefaultErrorMessage = $ReportLanguage->phrase("IncorrectInteger");
		$this->idPurchase_Order->DateFilter = "";
		$this->fields['idPurchase_Order'] = &$this->idPurchase_Order;

		// pro_id
		$this->pro_id = new ReportField('pruchase_report_base', 'pruchase report', 'x_pro_id', 'pro_id', '`pro_id`', 3, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pro_id->Sortable = TRUE; // Allow sort
		$this->pro_id->DefaultErrorMessage = $ReportLanguage->phrase("IncorrectInteger");
		$this->pro_id->DateFilter = "";
		$this->fields['pro_id'] = &$this->pro_id;

		// Product_Qty1
		$this->Product_Qty1 = new ReportField('pruchase_report_base', 'pruchase report', 'x_Product_Qty1', 'Product_Qty1', '`Product_Qty1`', 3, -1, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Product_Qty1->Sortable = TRUE; // Allow sort
		$this->Product_Qty1->DefaultErrorMessage = $ReportLanguage->phrase("IncorrectInteger");
		$this->Product_Qty1->DateFilter = "";
		$this->fields['Product_Qty1'] = &$this->Product_Qty1;
	}

	// Render for popup
	public function renderPopup()
	{
		global $ReportLanguage;
		if ($this->date->CurrentValue === NULL) // Handle null value
			$this->date->ViewValue = $ReportLanguage->phrase("NullLabel");
		elseif ($this->date->CurrentValue == "") // Handle empty value
			$this->date->ViewValue = $ReportLanguage->phrase("EmptyLabel");
		else
			$this->date->ViewValue = $this->date->CurrentValue;
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
		return ($this->_sqlFrom <> "") ? $this->_sqlFrom : "`pruchase report`";
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