<!DOCTYPE html>
<html class="no-js" lang="en">
<?php
include "backend/header.php";
?>


<!--Body Content-->
<div id="page-content">
    <!--MainContent-->
    <div id="MainContent" class="main-content" role="main">
        <!--Breadcrumb-->
        <div class="bredcrumbWrap">

        </div>
        <!--End Breadcrumb-->
        <!-- ----------------------------------------------------------------------------------- -->
        <?php
        $view = "SELECT * FROM `feedback` WHERE Product_Master_idProduct_Master='" . $_GET['idProduct'] . "'";
        $resulttt = mysqli_query($conn, $view);
        $count = mysqli_num_rows($resulttt);

        $id = $_GET['idProduct'];
        $sql = "SELECT * FROM `product_master` WHERE `idProduct_Master`='$id'";

        $result = mysqli_query($conn, $sql);
        //  $num = mysqli_num_rows($result);
        $sql8 = "SELECT * FROM `feedback` JOIN product_master on feedback.Product_Master_idProduct_Master=product_master.idProduct_Master JOIN `retailer` on feedback.Retailer_idRetailer=retailer.idRetailer  WHERE product_master.idProduct_Master=$id";
        $result8 = mysqli_query($conn, $sql8);
        $num8 = mysqli_num_rows($result8);
        $sql9 = "SELECT * FROM `feedback` WHERE feedback.Product_Master_idProduct_Master =$id";
        $result9 = mysqli_query($conn, $sql9);
        if (mysqli_num_rows($result9) > 0) {
            while ($data = mysqli_fetch_assoc($result9)) {
                $rate_db[] = $data;
                $sum_rates[] = $data['rating_value'];
            }
            if (count($rate_db)) {
                $rate_times = count($rate_db);
                $sum_rates = array_sum($sum_rates);
                $rate_value = $sum_rates / $rate_times;
                $rate_bg = (($rate_value) / 5) * 100;
            } else {
                $rate_times = 0;
                $rate_value = 0;
                $rate_bg = 0;
            }
            // $r1 = 0;
            // $r2 = 0;
            // $r3 = 0;
            // $r4 = 0;
            // $r5 = 0;
            // // $total = 0;
            // while ($row9 = mysqli_fetch_assoc($result9)) {
            //     if ($row9['rating_value'] == 1) {
            //         $r1++;
            //     } elseif ($row9['rating_value'] == 2) {
            //         $r2++;
            //     } elseif ($row9['rating_value'] == 3) {
            //         $r3++;
            //     } elseif ($row9['rating_value'] == 4) {
            //         $r4++;
            //     } elseif ($row9['rating_value'] == 5) {
            //         $r5++;
            //     }
            // }
            // $total = $r1 + $r2 + $r3 + $r4 + $r5;
            // $total1 = $num8 * 5;
            // $avrage = ($total / $total1) * 10;
            // $avrage1 = number_format($avrage);
            // echo  $total;
            // echo $total1;
            //  echo $num8;
            // echo $rate_bg;
            // echo number_format($rate_value, 1);
        }

        ?>
        <!-- ------------------------------------------------------------------------------------- -->
        <br><br><br><br>
        <div id="ProductSection-product-template" class="product-template__container prstyle2 container">
            <!--#ProductSection-product-template-->
            <div class="product-single product-single-1">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="product-details-img product-single__photos bottom">
                            <div class="zoompro-wrap product-zoom-right pl-20">
                                <div class="zoompro-span">
                                    <!-- --------------------------- -->
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {

                                        //<!-- product -->
                                        echo '

							<div class="col-12 item">
								<div class="product-image">

									<div class="product-image">


								</div>

					            <!-- ----------------------------- -->

                                            <img class="blur-up lazyload zoompro" data-zoom-image="admin/' . $row['image_url'] . '" alt="not found" src="admin/' . $row['image_url'] . '" width="90%" />
                                        </div>

                                    </div>
                                    <div class="product-thumb product-thumb-1">
                                        <!-- <div id="gallery" class="product-dec-slider-1 product-tab-left">
                                            <a data-image="assets/images/product-detail-page/cape-dress-1.jpg" data-zoom-image="assets/images/product-detail-page/cape-dress-1.jpg" class="slick-slide slick-cloned" data-slick-index="-4" aria-hidden="true" tabindex="-1">
                                                <img class="blur-up lazyload" src="assets/images/product-detail-page/cape-dress-1.jpg" alt="" />
                                            </a>
                                            <a data-image="assets/images/product-detail-page/cape-dress-2.jpg" data-zoom-image="assets/images/product-detail-page/cape-dress-2.jpg" class="slick-slide slick-cloned" data-slick-index="-3" aria-hidden="true" tabindex="-1">
                                                <img class="blur-up lazyload" src="assets/images/product-detail-page/cape-dress-2.jpg" alt="" />
                                            </a>
                                            <a data-image="assets/images/product-detail-page/cape-dress-3.jpg" data-zoom-image="assets/images/product-detail-page/cape-dress-3.jpg" class="slick-slide slick-cloned" data-slick-index="-2" aria-hidden="true" tabindex="-1">
                                                <img class="blur-up lazyload" src="assets/images/product-detail-page/cape-dress-3.jpg" alt="" />
                                            </a>
                                            <a data-image="assets/images/product-detail-page/cape-dress-4.jpg" data-zoom-image="assets/images/product-detail-page/cape-dress-4.jpg" class="slick-slide slick-cloned" data-slick-index="-1" aria-hidden="true" tabindex="-1">
                                                <img class="blur-up lazyload" src="assets/images/product-detail-page/cape-dress-4.jpg" alt="" />
                                            </a>
                                            <a data-image="assets/images/product-detail-page/cape-dress-5.jpg" data-zoom-image="assets/images/product-detail-page/cape-dress-5.jpg" class="slick-slide slick-cloned" data-slick-index="0" aria-hidden="true" tabindex="-1">
                                                <img class="blur-up lazyload" src="assets/images/product-detail-page/cape-dress-5.jpg" alt="" />
                                            </a>
                                            <a data-image="assets/images/product-detail-page/cape-dress-6.jpg" data-zoom-image="assets/images/product-detail-page/cape-dress-6.jpg" class="slick-slide slick-cloned" data-slick-index="1" aria-hidden="true" tabindex="-1">
                                                <img class="blur-up lazyload" src="assets/images/product-detail-page/cape-dress-6.jpg" alt="" />
                                            </a>
                                            <a data-image="assets/images/product-detail-page/cape-dress-7.jpg" data-zoom-image="assets/images/product-detail-page/cape-dress-7.jpg" class="slick-slide slick-cloned" data-slick-index="2" aria-hidden="true" tabindex="-1">
                                                <img class="blur-up lazyload" src="assets/images/product-detail-page/cape-dress-7.jpg" alt="" />
                                            </a>
                                            <a data-image="assets/images/product-detail-page/cape-dress-8.jpg" data-zoom-image="assets/images/product-detail-page/cape-dress-8.jpg" class="slick-slide slick-cloned" data-slick-index="3" aria-hidden="true" tabindex="-1">
                                                <img class="blur-up lazyload" src="assets/images/product-detail-page/cape-dress-8.jpg" alt="" />
                                            </a>
                                        </div> -->
                                    </div>
                                    </div>
                                    </div>
                                    		<!-- /product -->';
                                    }
                                    ?>

                                    <!-- <div class="lightboximages">
                                        <a href="assets/images/product-detail-page/camelia-reversible-big1.jpg" data-size="1462x2048"></a>
                                        <a href="assets/images/product-detail-page/camelia-reversible-big2.jpg" data-size="1462x2048"></a>
                                        <a href="assets/images/product-detail-page/camelia-reversible-big3.jpg" data-size="1462x2048"></a>
                                        <a href="assets/images/product-detail-page/camelia-reversible7-big.jpg" data-size="1462x2048"></a>
                                        <a href="assets/images/product-detail-page/camelia-reversible-big4.jpg" data-size="1462x2048"></a>
                                        <a href="assets/images/product-detail-page/camelia-reversible-big5.jpg" data-size="1462x2048"></a>
                                        <a href="assets/images/product-detail-page/camelia-reversible-big6.jpg" data-size="731x1024"></a>
                                        <a href="assets/images/product-detail-page/camelia-reversible-big7.jpg" data-size="731x1024"></a>
                                        <a href="assets/images/product-detail-page/camelia-reversible-big8.jpg" data-size="731x1024"></a>
                                        <a href="assets/images/product-detail-page/camelia-reversible-big9.jpg" data-size="731x1024"></a>
                                        <a href="assets/images/product-detail-page/camelia-reversible-big10.jpg" data-size="731x1024"></a>
                                    </div> -->

                                </div>

                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="product-single__meta">
                                    <div class="product-review">
                                        <a class="reviewLink" href="#tab2">


                                            <?php
                                            if (mysqli_num_rows($result9) > 0) {
                                                echo ' <span class="reviewScore">' . substr(number_format($rate_value, 1), 0, 3) . '</span>';
                                                if ($rate_value < 3) {
                                                    echo '<svg height=30 width=23 class="star rating" data-rating="1">
                                                                            <polygon fill="red" points="9.9, 1.1, 3.3, 21.78, 19.8, 8.58, 0, 8.58, 16.5, 21.78" style="fill-rule:nonzero;" />
                                                                            </svg>&nbsp;';
                                                } elseif ($rate_value == 3) {
                                                    echo '<svg height=20 width=20 class="star rating" data-rating="1">
                                                                            <polygon fill="green" points="9.9, 1.1, 3.3, 21.78, 19.8, 8.58, 0, 8.58, 16.5, 21.78" style="fill-rule:nonzero;" />
                                                                            </svg>&nbsp;';
                                                } else {
                                                    echo '<svg height=20 width=20 class="star rating" data-rating="1">
                                                                            <polygon fill="gold" points="9.9, 1.1, 3.3, 21.78, 19.8, 8.58, 0, 8.58, 16.5, 21.78" style="fill-rule:nonzero;" />
                                                                            </svg>&nbsp;';
                                                }
                                                echo ' <span class="reviewCount">(' . $rate_times . ' reviews)</span>';
                                            }
                                            ?>


                                        </a>
                                    </div>
                                    <!-- -------------------------------------------------------- -->
                                    <?php

                                    //$sql = "SELECT * FROM product_master WHERE idProduct_Master = '$id'";
                                    $sql = "SELECT * FROM `product_master` WHERE idProduct_Master =$id ";

                                    $result = mysqli_query($conn, $sql);
                                    $num = mysqli_num_rows($result);
                                    while ($row = mysqli_fetch_array($result)) {
                                        // $idProduct_Master = $row['idProduct_Master'];
                                        $Product_Name = $row['Product_Name'];
                                        $Product_Price = $row['Product_Price'];
                                        $Product_Details = $row['Product_Details'];
                                        $Product_colors = $row['Product_colors'];
                                        $Product_Size = $row['Product_Size'];
                                        if ($row['Product_Qty'] > 0) {
                                            $Product_Qty = "In Stock";
                                        } else {
                                            $Product_Qty = "Out of stock";
                                        }

                                        echo '

                                    <h1 class="product-single__title"> ' . $Product_Name . '  </h1>


                                    <div class="prInfoRow">
                                        <div class="product-stock"> <span class="instock ">' . $Product_Qty . '</span> <span class="outstock hide">Unavailable</span> </div>

                                    </div>
                                    <p class="product-single__price product-single__price-product-template">
                                        <span class="visually-hidden">Regular price</span>

                                        <span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                            <span id="ProductPrice-product-template"><span class="money">₹' . $Product_Price . '<small>.00</small></span></span>
                                        </span>

                                    </p>
                                    <div class="product-single__description rte">
                                        <p>' . $Product_Details . '</p>
                                    </div>

                                    <form method="post" >
                                        <div class="swatch clearfix swatch-0 option1" data-option-index="0">
                                            <div class="product-form__item">
                                                <label class="header">Color: <span class="slVariant">' . $Product_colors . '</span></label>

                                            </div>
                                        </div>

                                        <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                                            <div class="product-form__item">
                                                <label class="header">Size: <span class="slVariant">' . $Product_Size . '</span></label>

                                            </div>
                                        </div>

                                        <!-- Product Action -->
                                        <div class="product-action clearfix">
                                                       <div class="wrapQtyBtn">
                                                        <span class="label">Qty:</span>
                                           <div class="qtyField">

                                                    <a class="qtyBtn minus" href="javascript:void(3);"><i class="fa anm anm-minus-r" aria-hidden="true"></i></a>
                                                    <input type="text" id="Quantity" name="qty" value="3" class="product-form__input qty">
                                                    <a class="qtyBtn plus" href="javascript:void(3);"><i class="fa anm anm-plus-r" aria-hidden="true"></i></a>
                                                </div>
                                         </div>
                                                </div>
                                            </div>

                                                <div class="product-form__item--submit">
                                           <a href="productlayout.php?idRetailer=' . $_COOKIE['idRetailer'] . '' . '&idProduct=' . $_GET['idProduct'] . '">
                                                    <button type="submit" name="addtocart" class="btn product-form__cart-submit">
                                             Add To Cart
                                            </button>
                                                </a>
                                            </div>



                                            </div>
                                        </div>
                                        <!-- End Product Action -->
                                           </form>

                                    <div class="display-table shareRow">
                                        <div class="display-table-cell medium-up--one-third">
                                            <div class="wishlist-btn">
                                                <a class="wishlist add-to-wishlist" href="index.php?idRetailer=' . $rows['idRetailer'] . '' . '&idProduct=' . $row['idProduct_Master'] . '" title="Add to Wishlist">
                                                <i class="icon anm anm-heart-l" aria-hidden="true"></i> <span>Add to Wishlist</span></a>
                                            </div>

                                            ';
                                    }
                                    ?>
                                </div>

                            </div>
                        </div>
                        <!-- review code start -->
                        <?php
                        // $find = "SELECT * FROM `retailer` NATURAL JOIN sales_order WHERE retailer.idRetailer=sales_order.Retailer_idRetailer AND sales_order.is_cancel=0 AND idRetailer=" . $_COOKIE['idRetailer'] . "";
                        $find1 = "SELECT * FROM product_master JOIN sales_order_detail on product_master.idProduct_Master=sales_order_detail.Product_Master_idProduct_Master JOIN sales_order ON sales_order.idSales_Order=sales_order_detail.Sales_Order_idSales_Order WHERE idProduct_Master=" . $_GET['idProduct'] . " and Retailer_idRetailer= " . $_COOKIE['idRetailer'] . "";
                        $resultfind1 = mysqli_query($conn, $find1);
                        $row2 = mysqli_num_rows($resultfind1);
                        if ($row2 > 0) {
                            if (isset($_POST['addtoreview'])) {

                                $add = "SELECT * FROM sales_order";
                                $result = mysqli_query($conn, $add);
                                $row = mysqli_fetch_assoc($result);
                                $id = $row['idSales_Order'];

                                $name = $_POST['Name'];
                                $email = $_POST['email'];
                                $title = $_POST['Title'];
                                $desc = $_POST['Desc'];
                                $rating = $_POST['rate'];

                                //  echo $id;
                                // echo $pid;
                                // echo $name;
                                // echo $email;
                                // echo $title;
                                // echo $desc;
                                //   $sql="INSERT INTO feedback (`Name`,`email`,`Title`,`Desc`,`Product_Master_idProduct_Master `,`Sales_Order_idSales_Order `) VALUES ('$name','$email','$title','$desc','$pid','$id')";
                                $sql = "INSERT INTO `feedback` (`Name`, `email`, `Title`, `Desc`, `Feedback_Date`,`rating_value`, `Product_Master_idProduct_Master`, `Sales_Order_idSales_Order`,`Retailer_idRetailer`)
                            VALUES ('$name', '$email', '$title', '$desc', current_timestamp(),'$rating', '$pid', '$id','$_COOKIE[idRetailer]')";

                                $result = mysqli_query($conn, $sql);
                                if ($result) {

                                    echo '<div class="alert alert-warning">
					                <b>Thanks for your feedback ..!!</b>
					                </div>';
                                } else {
                                    echo 'fail';
                                }
                            }

                        ?>
                            <!-- review code end -->


                            <!--Product Tabs-->
                            <div class="tabs-listing">
                                <div class="tab-container">
                                    <!-- <h3 class="acor-ttl active" rel="tab1">Product Details</h3> -->
                                    <!-- <div id="tab1" class="tab-content">
                                            <div class="product-description rte">
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industr.</p>


                                            </div>
                                        </div> -->
                                    <h3 class="acor-ttl" rel="tab2">Product Reviews</h3>
                                    <div id="tab2" class="tab-content">
                                        <div id="shopify-product-reviews">
                                            <div class="spr-container">
                                                <div class="spr-header clearfix">
                                                    <div class="spr-summary">
                                                        <span class="product-review">
                                                            <div style="margin-top: 10px">
                                                                <div class="result-container">
                                                                    <!-- <svg height=23 width=23 class="star rating" data-rating="1">
                                                                        <polygon fill='blank' points="9.9, 1.1, 3.3, 21.78, 19.8, 8.58, 0, 8.58, 16.5, 21.78" style="fill-rule:nonzero;" />
                                                                    </svg>&nbsp; -->

                                                                    <?php
                                                                    if (mysqli_num_rows($result9) > 0) {
                                                                        echo ' <span class="reviewScore">' . substr(number_format($rate_value, 1), 0, 3) . '</span>';
                                                                        if ($rate_value < 3) {
                                                                            echo '<svg height=30 width=23 class="star rating" data-rating="1">
                                                                            <polygon fill="red" points="9.9, 1.1, 3.3, 21.78, 19.8, 8.58, 0, 8.58, 16.5, 21.78" style="fill-rule:nonzero;" />
                                                                            </svg>&nbsp;';
                                                                        } elseif ($rate_value == 3) {
                                                                            echo '<svg height=20 width=20 class="star rating" data-rating="1">
                                                                            <polygon fill="green" points="9.9, 1.1, 3.3, 21.78, 19.8, 8.58, 0, 8.58, 16.5, 21.78" style="fill-rule:nonzero;" />
                                                                            </svg>&nbsp;';
                                                                        } else {
                                                                            echo '<svg height=20 width=20 class="star rating" data-rating="1">
                                                                            <polygon fill="gold" points="9.9, 1.1, 3.3, 21.78, 19.8, 8.58, 0, 8.58, 16.5, 21.78" style="fill-rule:nonzero;" />
                                                                            </svg>&nbsp;';
                                                                        }
                                                                        echo ' <span class="reviewCount">(' . $rate_times . ' reviews)</span>';
                                                                    }
                                                                    ?>

                                                                    <!-- <span class="spr-summary-actions">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                                <a href="#new-review-form" class="spr-summary-actions-newreview btn">Write a review</a>
                                                            </span> -->
                                                                </div>
                                                            </div>
                                                            <div class="spr-content">
                                                                <div class="spr-form clearfix">
                                                                    <form method="post" id="new-review-form" class="new-review-form">
                                                                        <h3 class="spr-form-title">Write a review</h3>
                                                                        <?php
                                                                        $abc = "SELECT * FROM retailer WHERE retailer.idRetailer=" . $_COOKIE['idRetailer'] . "";
                                                                        $resultabc = mysqli_query($conn, $abc);
                                                                        $rowww = mysqli_fetch_assoc($resultabc);
                                                                        echo '
                                                                <fieldset class="spr-form-contact">
                                                                    <div class="spr-form-contact-name">
                                                                        <label class="spr-form-label" for="review_author_10508262282">Name</label>
                                                                        <input class="spr-form-input spr-form-input-text "  name="Name" id="review_author_10508262282" type="text"  value="' . $rowww['first_name'] . ' ' . $rowww['last_name'] . '" >
                                                                    </div>
                                                                    <div class="spr-form-contact-email">
                                                                        <label class="spr-form-label" for="review_email_10508262282">Email</label>
                                                                        <input class="spr-form-input spr-form-input-email " name="email" id="review_email_10508262282" type="email"  value="' . $rowww['E-mail'] . '" >
                                                                    </div>
                                                                </fieldset>';
                                                                        // }
                                                                        ?>
                                                                        <fieldset class="spr-form-review">
                                                                            <div class="spr-form-review-rating">
                                                                                <label class="spr-form-label">Rating</label>
                                                                                <div class="spr-form-input spr-starrating">
                                                                                    <div class="product-review">

                                                                                        <input type="radio" id="rat" name="rate" value="1">1<i class="fa fa-star fa-2x"></i>
                                                                                        <input type="radio" id="rat" name="rate" value="2">2<i class="fa fa-star fa-2x"></i>
                                                                                        <input type="radio" id="rat" name="rate" value="3">3<i class="fa fa-star fa-2x"></i>
                                                                                        <input type="radio" id="rat" name="rate" value="4">4<i class="fa fa-star fa-2x"></i>
                                                                                        <input type="radio" id="rat" name="rate" value="5">5<i class="fa fa-star fa-2x"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="spr-form-review-title">
                                                                                <label class="spr-form-label" for="review_title_10508262282">Review Title</label>
                                                                                <input class="spr-form-input spr-form-input-text " name="Title" id="review_title_10508262282" type="text" name="review[title]" value="" placeholder="Give your review a title" required>
                                                                            </div>

                                                                            <div class="spr-form-review-body">
                                                                                <label class="spr-form-label" for="review_body_10508262282">Body of Review <span class="spr-form-review-body-charactersremaining">(1500)</span></label>
                                                                                <div class="spr-form-input">
                                                                                    <textarea class="spr-form-input spr-form-input-textarea " name="Desc" id="review_body_10508262282" data-product-id="10508262282" name="review[body]" rows="10" placeholder="Write your comments here" required></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </fieldset>
                                                                        <fieldset class="spr-form-actions">
                                                                            <input type="submit" name="addtoreview" class="spr-button spr-button-primary button button-primary btn btn-primary" value="Submit Review">
                                                                        </fieldset>
                                                                    </form>
                                                                </div>
                                                                <div class="spr-reviews">
                                                                    <div class="spr-review">
                                                                    <?php

                                                                    while ($rowww = mysqli_fetch_assoc($resulttt)) {

                                                                        echo ' <div class="spr-review-header">
                                                                <a href="deletefeedback.php?idProduct=' . $_GET['idProduct'] . '&idFeedback=' . $rowww['idFeedback'] . '" class="remove" ><i class="anm anm-times-l" aria-hidden="true"></i></a>&nbsp &nbsp &nbsp
                                                                <span class="product-review spr-starratings spr-review-header-starratings">
                                                                <span class="reviewLink">';
                                                                        $p = $rowww["rating_value"];
                                                                        for ($i = 0; $i < $p; $i++) {
                                                                            echo '
                                                       <i class="fa fa-star fa-2x"></i>';
                                                                        }
                                                                        $q = 5 - $p;
                                                                        for ($j = 0; $j < $q; $j++) {
                                                                            echo '
                                                        <i class="fa fa-star-o empty"></i>';
                                                                        }

                                                                        echo '  </span></span>
                                                                    <h3 class="spr-review-header-title">' . $rowww['Title'] . '</h3>
                                                                    <span class="spr-review-header-byline"><strong>' . $rowww['Name'] . '</strong> on <strong>' . $rowww['Feedback_Date'] . '</strong></span>
                                                                </div>
                                                                <div class="spr-review-content">
                                                                    <p class="spr-review-content-body">' . $rowww['Desc'] . '</p>
                                                                </div>


                                                        ';
                                                                    }
                                                                } ?>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <h3 class="acor-ttl" rel="tab4">Shipping &amp; Returns</h3>
                                        <div id="tab4" class="tab-content">
                                            <h4>Returns Policy</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eros justo, accumsan non dui sit amet. Phasellus semper volutpat mi sed imperdiet. Ut odio lectus, vulputate non ex non, mattis sollicitudin purus.
                                                Mauris consequat justo a enim interdum, in consequat dolor accumsan. Nulla iaculis diam purus, ut vehicula leo efficitur at.</p>
                                            <p>Interdum et malesuada fames ac ante ipsum primis in faucibus. In blandit nunc enim, sit amet pharetra erat aliquet ac.</p>
                                            <h4>Shipping</h4>
                                            <p>Pellentesque ultrices ut sem sit amet lacinia. Sed nisi dui, ultrices ut turpis pulvinar. Sed fringilla ex eget lorem consectetur, consectetur blandit lacus varius. Duis vel scelerisque elit, et vestibulum metus.
                                                Integer sit amet tincidunt tortor. Ut lacinia ullamcorper massa, a fermentum arcu vehicula ut. Ut efficitur faucibus dui Nullam tristique dolor eget turpis consequat varius. Quisque a interdum augue. Nam
                                                ut nibh mauris.</p>
                                        </div> -->
                                        </div>
                                    </div>
                                    <!--End Product Tabs-->
                                </div>
                            </div>
                            <!--End-product-single-->

                            <!--Related Product Slider-->
                            <!--Collection Tab slider-->
                            <div class="tab-slider-product section">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="section-header text-center">
                                                <h2 class="h2">Related Products</h2>
                                                <p>Browse the huge variety of our products</p>
                                            </div>
                                            <div class="tabs-listing">
                                                <?php

                                                $sql = "SELECT * FROM `product_master`;";

                                                $result = mysqli_query($conn, $sql);
                                                //  $num = mysqli_num_rows($result);
                                                ?>
                                                <div class="tab_container">
                                                    <div id="tab1" class="tab_content grid-products">
                                                        <div class="productSlider">


                                                            <!-- start product image -->

                                                            <!-- start product image -->
                                                            <?php

                                                            while ($row = mysqli_fetch_assoc($result)) {

                                                                //<!-- product -->
                                                                echo '

							<div class="col-12 item">
								<div class="product-image">

									<div class="product-image">

										<a href="productlayout.php?idRetailer=' . $rows["idRetailer"] . '' . '&idProduct=' . $row["idProduct_Master"] . '"><img src="admin/' . $row['image_url'] . '" alt="image not found" height=400px width=100px>
									  </a>
                                    </div>
                                    <div class="product-form__item--submit">
                                           <a  href="productlayout.php?idRetailer=' . $rows["idRetailer"] . '' . '&idProduct=' . $row["idProduct_Master"] . '">
                                             <button  type="button" name="idRetailer"> Add To Wishlist</button>
                                             </a>
                                            </div>
									<div class="product-body">

										<h2 class="product-name"><b>' . $row['Product_Name'] . '</b></a></h2>
										<h3 class="price">Color :- ' . $row['Product_colors'] . '</h3>
										<h3 class="product-size"> Size :- ' . $row['Product_Size'] . '</h3>
                                        <h3 class="price"><b>Price :- ₹ ' . $row['Product_Price'] . '<small>.00</small></b></h3>
									<form method="post">
									</div><a href="productlayout.php?idRetailer=' . $rows["idRetailer"] . '' . '&idProduct=' . $row["idProduct_Master"] . '">
								       <button class="btn btn-addto-cart" type="button"  tabindex="0">Add To Cart</button>
                                            </a>
								</div>
                                </form>
							</div>
							<!-- /product -->';
                                                            }

                                                            ?>
                                                            <!-- end product image -->


                                                        </div>
                                                        <!-- end product image -->


                                                    </div>
                                                </div>

                                            </div>

                                            <!-- -------------------------------------------------------------------------------- -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Collection Tab slider-->
                            <!--End  Related Product Slider-->

                    </div>
                    <!--#ProductSection-product-template-->
                </div>
                <!--MainContent-->
            </div>
            <!--End Body Content-->
        </div>
        <!--Footer-->

        <?php
        include "backend/footer.php";
        ?>
        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="pswp__bg"></div>
            <div class="pswp__scroll-wrap">
                <div class="pswp__container">
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                </div>
                <div class="pswp__ui pswp__ui--hidden">
                    <div class="pswp__top-bar">
                        <div class="pswp__counter"></div><button class="pswp__button pswp__button--close" title="Close (Esc)"></button><button class="pswp__button pswp__button--share" title="Share"></button><button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                        <div class="pswp__preloader">
                            <div class="pswp__preloader__icn">
                                <div class="pswp__preloader__cut">
                                    <div class="pswp__preloader__donut"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script>
            //     var ratedIndex = -1,
            //         uID = 0;

            //     $(document).ready(function() {
            //         resetStarColors();

            //         if (localStorage.getItem('ratedIndex') != null) {
            //             setStars(parseInt(localStorage.getItem('ratedIndex')));
            //             uID = localStorage.getItem('uID');
            //         }

            //         $('.fa-star').on('click', function() {
            //             ratedIndex = parseInt($(this).data('index'));
            //             localStorage.setItem('ratedIndex', ratedIndex);
            //             saveToTheDB();
            //         });

            //         $('.fa-star').mouseover(function() {
            //             resetStarColors();
            //             var currentIndex = parseInt($(this).data('index'));
            //             setStars(currentIndex);
            //         });

            //         $('.fa-star').mouseleave(function() {
            //             resetStarColors();

            //             if (ratedIndex != -1)
            //                 setStars(ratedIndex);
            //         });
            //     });

            //     function saveToTheDB() {
            //         $.ajax({
            //             url: "productlayout.php",
            //             method: "POST",
            //             dataType: 'json',
            //             data: {
            //                 save: 1,
            //                 uID: uID,
            //                 ratedIndex: ratedIndex
            //             },
            //             success: function(r) {
            //                 uID = r.id;
            //                 localStorage.setItem('uID', uID);
            //             }

            //         });
            //         // console.log(ratedIndex);
            //     }

            //     function setStars(max) {
            //         for (var i = 0; i <= max; i++)
            //             $('.fa-star:eq(' + i + ')').css('color', 'green');
            //     }

            //     function resetStarColors() {
            //         $('.fa-star').css('color', 'gray');
            //     }
            //
        </script>
        </body>
        <!-- <script type='text/javascript'>
    (function() {
        if (window.localStorage) {
            if (!localStorage.getItem('firstLoad')) {
                localStorage['firstLoad'] = true;
                window.location.reload();
            } else
                localStorage.removeItem('firstLoad');
        }
    })();
</script> -->

</html>