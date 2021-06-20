<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html lang="<?php echo $configLanguage; ?>" dir="<?php echo $dirType; ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-translate-customization" content="839d71f7ff6044d0-328a2dc5159d6aa2-gd17de6447c9ba810-f">
    <?php echo $this->Html->charset(); ?>
    <title><?php echo $metaTitle; ?></title>
    <meta name="keyword" content="<?php echo $metaKeyword; ?>"/>
    <meta name="description" content="<?php echo $metaContent; ?>"/>
    <?php
    echo $this->Html->meta('icon'); ?>
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php
    echo $this->Html->css('/design300/css/font-awesome.min');
    echo $this->Html->css('/design300/css/bootstrap.min');
    echo $this->Html->css('/design300/css/font');
    echo $this->Html->css('/design300/css/settings');
    echo $this->Html->css('/design300/css/style');
    echo $this->Html->css('/design300/css/slider');
    echo $this->Html->css('validationEngine.jquery');
    echo $this->Html->css('bootstrap-multiselect');
    echo $this->Html->css('style');
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->Html->script('/design300/js/jquery.min');
    echo $this->Html->script('/design300/js/jquery.flexslider-min');
    echo $this->Html->script('html5shiv');
    echo $this->Html->script('respond.min');
    echo $this->Html->script('jquery.validationEngine-en');
    echo $this->Html->script('jquery.validationEngine');
    echo $this->Html->script('/design300/js/bootstrap.min');
    echo $this->Html->script('/design300/js/rs-slider');
    echo $this->Html->script('bootstrap-multiselect');
    echo $this->Html->script('waiting-dialog.min');
    echo $this->Html->script("langs/$configLanguage");
    echo $this->Html->script('custom.min');
    if ($this->params['controller'] == "pages") {
        $this->params['controller'] = "";
    } ?>
    <?php if ($translate > 0) { ?>
        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({
                    pageLanguage: 'en',
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                }, 'google_translate_element');
            }
        </script>
        <script type="text/javascript"
                src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <?php } ?>

    <script type="text/javascript">
        $(document).ready(function () {

            $("#products_animation_id").hover(
                function () {
                    $("#products_animation").show(500);
                }, function () {
                    //$( "#products_animation" ).hide(500);
                }
            );

            $("#products_animation").hover(
                function () {
                    // $( "#products_animation" ).show(500);
                }, function () {
                    $("#products_animation").hide(500);
                }
            );

            $("#products_animation_id").click(function (event) {
                $("#products_animation").toggle();
            });
            $("#products_animation").hide();
        });
    </script>


</head>
<body>
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>
<div id="wrapper">
    <div class="h-wrapper">
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="pull-left hidden-xs">
                            <ul class="social-icon unstyled">
                                <?php if (strlen($contact[0]) > 0) { ?>
                                    <li><a href="#"><i
                                                class="fa fa-phone"></i><span><?php echo $contact[0]; ?></span></a>
                                    </li><?php } ?>
                                <?php if (strlen($contact[1]) > 0) { ?>
                                    <li><a href="mailto:<?php echo $contact[1]; ?>"><i
                                                class="fa fa-envelope"></i><span><?php echo $contact[1]; ?></span></a>
                                    </li><?php } ?>
                                <?php if (strlen($contact[2]) > 0) { ?>
                                    <li><a href="<?php echo $contact[2]; ?>" target="_blank"><i
                                                class="fa fa-facebook"></i><span><?php echo __('follow on facebook'); ?></span></a>
                                    </li><?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="pull-right hidden-xs">
                            <ul class="social-icon unstyled">
                                <li><?php echo $this->Html->link('<i class="fa fa-shopping-bag"></i><span>' . __('') . ' <i class="badge" id="cart-counter">' . $cartCount . '</i></span>', '#', array('escape' => false, 'id' => 'products_animation_id')); ?>
                                    <ul id="products_animation"
                                        class="ulproducts_animation dropdown-menu dropdown-user pull-right"
                                        style="display:none;">
                                        <div class="divproducts_animation">
                                            <?php
                                            $total = 0;
                                            $totalQuantity = 0;
                                            if (!empty($products_animation)) {
                                                foreach ($products_animation as $product_animation) {
                                                    $product_name = $product_animation['Package']['name'];
                                                    $product_amount = $product_animation['Package']['amount'];
                                                    $product_show_amount = $product_animation['Package']['show_amount'];

                                                    if (strlen($product_animation['Package']['photo']) > 0) {
                                                        $product_photo = "/img/package_thumb/" . $product_animation['Package']['photo'];
                                                    } else {
                                                        $product_photo = "/img/nia.png";
                                                    }
                                                    $total = $total + ($product_animation['Package']['count'] * $product_animation['Package']['amount']);
                                                    $totalQuantity = $totalQuantity + $product_animation['Package']['count'];


                                                    ?>
                                                    <li class="ani_li">
                                                        <div class="col-md-2 col-xs-2 product_animation_img">
                                                            <?php echo $this->Html->image($product_photo, array('alt' => $product_animation['Package']['name'])); ?>
                                                        </div>
                                                        <div class="col-md-7 col-xs-7 p0">
                                                            <span class="textblack"><?php echo $product_name ?></span>
                                                            <p class="text-muted small p0"><?php echo __('Exams'); ?>:
                                                                <span class=""><strong>

                                                    <?php
                                                    if (!empty($product_animation['Exam'])) {
                                                        foreach ($product_animation['Exam'] as $examName):
                                                            echo h($examName['name']); ?> |
                                                        <?php endforeach;
                                                        unset($examName);
                                                        unset($examName);
                                                    } else {
                                                        echo __('No Exam Found');
                                                    }
                                                    ?></strong>

                                            </span>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-3 col-xs-3">
                                                            <?php if ($product_animation['Package']['show_amount'] != $product_animation['Package']['amount']) { ?>
                                                                <span class="text-danger"><strong><strike><?php echo $currency . $product_animation['Package']['show_amount']; ?></strike></strong></span>
                                                            <?php } ?>
                                                            <div style="clear: both;"></div>
                                                            <span class="text-success"><big><strong> <?php echo $currency . $product_animation['Package']['amount']; ?></strong></big></span>
                                                        </div>
                                                    </li>
                                                <?php } ?>

                                            <?php } else { ?>
                                                <div class="empty-cart textblack">
                                                    <center>

                                                        <a class="cartbag"
                                                           href="<?php echo $this->html->url(array('controller' => 'Carts', 'action' => 'View')); ?>"><i
                                                                    class="fa fa-shopping-bag"></i></a>
                                                        <br>
                                                        <span class="textblack text-uppercase empty-msg"><?php echo __('your shopping bag is empty'); ?></span>
                                                        <br>
                                                        <?php echo $this->Html->link('<span>', __('Continue shopping') . '</span>', array('controller' => 'Packages', 'action' => 'index'), array('escape' => false, 'class' => 'btn btn-success shopCart', 'style' => 'background: #000;border: #000;')); ?>
                                                    </center>
                                                </div>

                                            <?php } ?>
                                        </div>
                                        <li class="ani_li" style="border-top: 1px solid #000;">
                                            <div class="col-md-9"><span
                                                        class="textblack"><strong><?php echo __('TOTAL PRICE'); ?></strong></span>
                                            </div>
                                            <div class="col-md-3 p0" style="text-align: center;">
                                                <span class="textblack"><strong><?php echo $currency . $total ?></strong></span>
                                            </div>
                                            <div style="clear: both;"></div>
                                        </li>
                                        <li class="ani_li" style="border: none;">
                                            <div class="col-md-12" style="text-align: center;">
                                                <?php echo $this->Html->link('<span>' . __('View Bag') . '</span>', array('controller' => 'Carts', 'action' => 'View'), array('escape' => false, 'class' => 'btn btn-success shopCart', 'style' => 'background: #68c6ec;border: #68c6ec;')); ?>
                                            </div>
                                        </li>

                                    </ul>

                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php if ($this->params['controller'] == ""){ ?>
        <header class="header-wrapper header-transparent with-topbar">
            <?php }else { ?>
            <header class="header-wrapper header-transparent header-stylecol with-topbar">
                <?php } ?>
                <div class="main-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-3">
                                <div
                                        class="logo-text"><?php if (strlen($frontLogo) > 0) { ?><?php echo $this->Html->link($this->Html->image($frontLogo, array('alt' => $siteName, 'class' => 'img-responsive front-logo')), array('controller' => '/'), array('escape' => false));
                                    } else { ?><?php echo $siteName; ?><?php } ?></div>
                            </div>
                            <div class="col-sm-12 col-md-9">
                                <nav class="navbar-right">
                                    <?php echo $this->MenuBuilder->build('frontMenu', array('childrenClass' => '', 'firstClass' => '', 'menuClass' => 'menu', 'childrenDropdown' => 'submenu', 'activeClass' => 'active', 'wrapperFormat' => '<ul %s><li class="toggle-menu"><i class="fa icon_menu"></i></li><li class="mobilshopping"><a class="shop" href=" ' . $this->Html->url(array('controller' => 'Carts', 'action' => 'View')) . '"><i class="fa fa-shopping-bag">' . $cartCount . '</i></a></li>%s</ul>'), $frontMenu); ?>
                                </nav>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
    </div>

    <div class="maincontent">
        <?php echo $this->fetch('content'); ?>
    </div>
</div>

<div id="footer_index"></div>
<footer class="footer-wrapper footer-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-sm-push-6 col-md-push-4 xs-box">
                <?php echo __('Time'); ?> <span><?php echo $this->Time->format('d-m-Y h:i:s A', time()); ?></span>
            </div>
            <div class="col-sm-6 col-md-4 col-sm-pull-6 col-md-pull-4">
                <p class="copyright"><?php echo __('&copy; Copyright'); ?> <?php echo $this->Time->format('Y', time()); ?>
                    <span> <?php echo $siteName; ?></span></p>
            </div>
            <span><?php echo __('Powered by'); ?>
                &nbsp;<?php echo $this->Html->Link($sitepowerdby, $sitepowerdlink, array('target' => '_blank')); ?></span>
        </div>
    </div>
</footer>
</div>
<div id="_include_main_plugins"></div>
<div id="_include_owl_carousel"></div>
<div id="_include_isotope"></div>
<?php echo $this->Html->script('/design300/js/script');
echo $this->fetch('script');
echo $this->Js->writeBuffer(); ?>
<div id="scriptUrl"
     style="display: none;"><?php echo $this->Html->url(array('crm' => false, 'controller' => 'app', 'action' => 'webroot', 'img')); ?></div>
<script>
    $(document).ready(function () {
        $('.flexslider').flexslider({
            animation: 'slide',
            directionNav: false,
            slideshowSpeed: '9000',
            controlsContainer: '.flexslider'
        });
        $("#mymenu").addClass('displaynone');
        $('#mob').click(function () {
            var clicks = $(this).data('clicks');
            if (clicks) {
                $("#mymenu>#frontMenu").stop().animate({left: '-680px'}, {
                    complete: function () {
                        $("#mymenu").removeClass('bgblck displayblock');
                        $("#mymenu").addClass('displaynone');
                    }
                });

            } else {
                $("#mymenu").removeClass('displaynone ');
                $("#mymenu").addClass('bgblck displayblock');
                $("#mymenu>#frontMenu").stop().animate({left: '0px'});
            }
            $(this).data("clicks", !clicks);
        });


    });
</script>
</body>
</html>