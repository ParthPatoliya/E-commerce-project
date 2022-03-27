<?php


include "backend/db_connect.php";

if (isset($_POST['service_find'])) {
  $search_param = mysqli_real_escape_string($conn, $_POST['service_find']);
  $seach_sql = "SELECT *  FROM product_master  WHERE product_master.Product_Name like '%$search_param %' order by product_master.Product_colors";
  $search_query = mysqli_query($conn, $seach_sql);
  $output = '';
  if (mysqli_num_rows(mysqli_query($conn, $seach_sql)) > 0) {
    // $output = '  <thead>
    //     <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
    //       <th class="px-4 py-3">Image</th>
    //       <th class="px-4 py-3">Product Name</th>
    //       <th class="px-4 py-3">Price</th>

    //     </tr>
    //   </thead>';
    while ($row = mysqli_fetch_assoc($search_query)) {
      $id = $row['idProduct_Master'];

      $output .= '
        <tr class="text-gray-700 dark:text-gray-400">
        <td class="px-4 py-3">
          <div class="flex items-center text-sm">
            <!-- Avatar with inset shadow -->
            <div>

            <a href="productlayout.php?idRetailer=' . $_COOKIE["idRetailer"] . '' . '&idProduct=' . $row["idProduct_Master"] . '">  <img src="admin/' . $row['image_url'] . '" class="font-semibold" height="100px" width="100px"/></a>
            </div>
          </div>
        </td>
        <td class="px-4 py-3 text-sm">
        <a href="productlayout.php?idRetailer=' . $_COOKIE["idRetailer"] . '' . '&idProduct=' . $row["idProduct_Master"] . '">' . $row['Product_Name'] . '</a>
        </td>
        <td class="px-4 py-3 text-sm">
        ' . $row['Product_Price'] . '
        </td>
        
       
      </tr>';
    }
  } else {
    $output = '
  <tr>
    <td colspan="5"> No result found. </td>   
  </tr>';
  }
  echo $output;
}
