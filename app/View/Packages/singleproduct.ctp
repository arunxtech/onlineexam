<?php $cartUrl = $this->Html->url(array('controller' => 'Carts', 'action' => 'addedtobag/' . $post['Package']['id'])); ?>
<style type="text/css">


    .gold {
        color: #FFBF00;
    }

    .product {
        /*border: 1px solid #dddddd;*/
        /*height: 600px;*/
    }

    .product > img {
        max-width: 230px;
    }

    .product-rating {
        font-size: 20px;
        margin-bottom: 25px;
    }

    .product-title {
        font-size: 20px;
    }

    .product-desc {
        font-size: 14px;
    }

    .product-price {
        font-size: 22px;
    }

    .product-stock {
        /*color: #74DF00;*/
        font-size: 14px;
        /*margin-top: 10px;*/
    }

    .product-info {
        margin-top: 30px;
    }

    hr {
        margin: 15px 0 !important;
    }

    .service-image-left > center > img, .service-image-right > center > img {
        /*max-height: 320px;*/
        padding: 5px;
    }

    .section1 {
        background: #f7f7f7;
    }

    .back-page:hover {
        color: #434343;
    }

    .pdp-breadcrumb a {
        text-transform: capitalize;
        position: absolute;
        left: 0;
    }

    .content-product .content-heading {
        font-size: 18px;
        margin-top: 20px;
        font-family: dinnextprobold;
        color: #434343;
        margin-bottom: 8px;
        text-transform: uppercase;
        font-weight: bold;
        text-align: center;
    }

    span.pdp-breadcrumb {
        padding: 10px;
    }

    .back-page {
        position: absolute;
        z-index: 0;
        cursor: pointer;
        text-transform: inherit;
        color: #8b8a8a;
        padding: 5px;
    }

    .title-border.one {
        width: 160px;
        margin: 0 auto;
        text-transform: uppercase;
        font-family: dinnextprobold;
        color: #434343;
        font-size: 20px;
        font-weight: bold;
    }

    h2.title-border {
        width: 235px;
        margin: 0 auto;
        text-transform: uppercase;
        color: #434343;
        font-size: 20px;
        font-weight: bold;
    }

    .product.col-md-8.service-image-left {
        text-align: center;
    }

    img#item-display {
        width: 100%;
        max-width: 512px;
        max-height: 512px;
        padding: 10px;
    }

    .page-heading {
        padding: 10px;
    }

    .img-thumbnail {
        min-height: 235px;
    }

    @media (max-width: 767px) {
        .img-thumbnail {
            min-height: auto;
        }

        span.text-info {
            font-size: 12px;
        }
    }

    a.btn.btn-success.shopCart {
        width: 246px;
        text-transform: uppercase;
    }

    .product_description {
        background: #fff;
        padding: 10px;
        margin-bottom: 10px;
    }

    .addtocart {
        text-align: center;
        margin-bottom: 20px;
    }

    .flex-viewport {
        background: #f7f7f7;
    }

    .flexslider {
        box-shadow: none;
    }

    .mycontainer {
        padding: 10px;
        background: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2)
    }
</style>
<section class="section mycontainer">
        <span class="pdp-breadcrumb">

           <a href="<?php echo $this->Html->url(array('controller' => 'Packages', 'action' => 'index')) ?>"
              class="back-page"><i class="fa fa-chevron-left"
                                   aria-hidden="true"></i> <?php echo __('Back to Packages'); ?></a>
        </span>
    <div class="item-container">
        <div class="container">
            <div class="col-md-12">
                <div class="product col-md-8 service-image-left ">
                    <div class="mycontainer">
                        <center>
                            <?php if (strlen($post['Package']['photo']) > 0) {
                                $photo = "package/" . $post['Package']['photo'];
                            } else {
                                $photo = "nia.png";
                            } ?>
                            <?php echo $this->Html->image($photo, array('alt' => $post['Package']['name'], 'id' => 'item-display')); ?>
                        </center>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mycontainer">
                        <div class="product-title"><?php echo h($post['Package']['name']); ?></div>
                        <hr>
                        <div class="product-price">
                             <span class="text-danger">
                                <strong>
                                    <strike><?php echo $currency . $post['Package']['show_amount']; ?></strike></strong>
                                </span><span
                                    class="text-success"><big><strong> <?php echo $currency . $post['Package']['amount']; ?></strong></big></span>
                        </div>
                        <div class="product-stock">
                            <?php echo __('Expiry'); ?> :
                            <span class="text-info"><strong><?php if ($post['Package']['expiry_days'] == 0) echo __('Unlimited'); else echo $post['Package']['expiry_days']; ?>
                                    <?php echo __('Days'); ?></strong></span>
                        </div>
                        <div class="product-stock">
                            <strong><?php echo __('Exams'); ?> :</strong> <span
                                    class="text-info"><strong>
                                        <?php
                                        if (!empty($post['Exam'])) {
                                            foreach ($post['Exam'] as $examName):
                                                echo h($examName['name']); ?> |
                                            <?php endforeach;
                                            unset($examName);
                                            unset($examName);
                                        } else {
                                            echo __('No Exam Found');
                                        }

                                        ?>
                                            
                                        </strong></span>
                        </div>
                        <hr>
                        <?php $url = $this->Html->url(array('controller' => 'Carts', 'action' => 'buy'));
                        $id = $post['Package']['id']; ?>
                        <div class="addtocart">

                            <?php
                            if ($post['Package']['amount'] > 0) {
                                echo $this->Html->link('<span class="fa fa-shopping-cart"></span>&nbsp;' . __('Add to Cart'), 'javascript:void(0);', array('onclick' => "shopCart('$id');", 'rel' => $url, 'escape' => false, 'class' => 'btn btn-success shopCart', 'id' => 'addtocart' . $id, 'style' => 'background: #68c6ec;border: #68c6ec;'));
                            } else {
                                echo $this->Html->link('<span class="fa fa-play"></span>&nbsp;' . __('Start Now'), array('controller' => 'Packages', 'action' => 'startnow', $id), array('escape' => false, 'class' => 'btn btn-success', 'style' => 'background: #68c6ec;border: #68c6ec;'));
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="container mycontainer">
            <div class="page-heading">
                <div class="widget">
                    <h2 class="title-border"><?php echo __('Product Description'); ?></h2>
                </div>
            </div>
            <div class="product_description">
                <?php echo str_replace("<script", "", $post['Package']['description']); ?>
            </div>
        </div>
    </section>
</section>

<div class="container-fluid">
    <div class="col-md-12 product-info">
        <div class="col-md-12">
            <div class="page-heading">
                <div class="widget">
                    <h2 class="title-border"><?php echo __('Recommended Packages'); ?></h2>
                </div>
            </div>
            <div class="flexslider carousel">
                <ul class="slides">
                    <?php
                    foreach ($Packages as $Packagesvalue) {
                        $Package_id = $Packagesvalue['Package']['id'];
                        $Packagesvalue['Package']['name'];
                        $Packagesvalue['Package']['photo'];
                        if ($post['Package']['id'] != $Package_id) {
                            ?>
                            <li>
                                <div class="col-md-12">
                                    <a href="<?php echo $this->Html->url(array('action' => 'singleproduct', $Package_id, Inflector::slug(strtolower($Packagesvalue['Package']['name']), "-"))); ?>">
                                        <div class="img-thumbnail">
                                            <?php if (strlen($Packagesvalue['Package']['photo']) > 0) {
                                                $photo1 = "package/" . $Packagesvalue['Package']['photo'];
                                            } else {
                                                $photo1 = "nia.png";
                                            } ?>
                                            <?php echo $this->Html->image($photo1, array('alt' => $post['Package']['name'])); ?>
                                        </div>
                                        <div style="clear: both;"></div>
                                        <span class="text-info"><?php echo $Packagesvalue['Package']['name']; ?></span>
                                    </a>
                                </div>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">
    </div>
</div>
<script>

    function shopCart(selectedValue) {

        var targetUrl = $('#addtocart' + selectedValue).attr('rel') + '?prodId=' + selectedValue;
        $.ajax({
            type: 'get',
            url: targetUrl,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            },
            success: function (response) {
                if (response) {

                    $('#cart-counter').html(response);
                    setTimeout(function () {
                        var checkoutUrl = '<?php echo $this->Html->url(array('controller' => 'Carts', 'action' => 'View')) ?>';
                        window.location.href = checkoutUrl;
                    }, 100);
                }
            },
            error: function (e) {

            }
        });
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.flexslider').flexslider({
            animation: "slide",
            animationLoop: false,
            itemWidth: 241,
            itemMargin: 5,
            minItems: 2,
            maxItems: 4,
        });
    });


</script>
<div style="clear: both;"></div>