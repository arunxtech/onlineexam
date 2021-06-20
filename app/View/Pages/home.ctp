<style type="text/css">
    .box-services-c {
        margin: 0 auto;
        border-radius: 50%;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
        text-align: center;
        width: 245px;
        padding: 20px;
    }

    .font_bold {
        font-weight: 400;
    }

    .homehedp {
        font-size: 18px;
        color: #5A6779;
        font-weight: 400;
        width: 70%;
        margin: 0 auto;
    }

    .btn {
        display: inline-block;
        padding: 8px 2rem;
        overflow: hidden;
        position: relative;
        text-decoration: none;
        text-transform: uppercase;
        border-radius: 3px;
        -webkit-transition: 0.3s;
        -moz-transition: 0.3s;
        -ms-transition: 0.3s;
        -o-transition: 0.3s;
        transition: 0.3s;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        border: none;
        font-size: 15px;
        text-align: center;
        background-color: #00bcd4;
    }

    .home .header {
        margin: 32px 0;
    }

    .homepackage {
        margin: 32px 0;
    }

    h2.title {
        margin: 8px 0 24px;
        text-transform: uppercase;
        font-weight: 300;
    }

    p.text {
        position: relative !important;
        background-color: transparent !important;
        color: #5A6779 !important;
    }

    .flexslider {
        box-shadow: none !important;
    }

    .slideimg {
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
    }

    .input-state {
        position: relative;
        margin-top: 24px;
    }

    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        margin: -1px;
        padding: 0;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        border: 0;
    }

    .get-apps-link input[type=text] {
        border-width: 2px;
        height: auto;
        font-weight: 500;
        border-color: transparent transparent #F0F0F0;
        padding: 12px 96px 12px 0;
    }

    .top-bg-overlay-fill {
        position: absolute;
        background: rgba(0, 0, 0, .5);
        height: 100%;
        width: 100%;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
    }

    .lb-content {
        /*display: inline-block;*/
        vertical-align: middle;
        white-space: normal;

        position: relative;
        padding: 35px 0;
        margin-left: -4px;
        color: #fff;
    }

</style>
<template>
    <style>
        :host {
            cursor: default;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        span {
            display: inline-block;
            position: relative;
            color: #ccd6dd;
            width: 20px;
            font-size: 20px;
        }

        span > span {
            display: block;
            position: absolute;
            top: 0px;
            bottom: 0px;
            overflow: hidden;
            color: #00aac4;
            font-size: 25px;
        }
    </style>
</template>
<?php $RegistersUrl = $this->Html->url(array('controller' => 'Registers', 'action' => 'index')); ?>
<?php if ($Homesection[0]['Homesection']['published'] == 'Published') { ?>
    <section class="section mycontainer"
             style="position: relative;background-image: url('<?php echo $this->webroot;?>img/tab/<?php echo $Homesection[0]['Homesection']['sections_img'] ?>');background-size: cover;min-height: 500px;text-align: center;">
        <div class="mb50"></div>

        <div class="container home">
            <div class="top-bg-overlay-fill"></div>
            <div class="lb-content text-center">
                <h1 class="text-center font_bold m0"
                    style="color: #fff"><?php echo __($Homesection[0]['Homesection']['sections_heading']); ?></h1>
                <p class="text-center"
                   style="color: #fff"><?php echo __($Homesection[0]['Homesection']['sections_content']); ?></p>
            </div>
        </div>
        <div class="mb50"></div>

    </section>
<?php } ?>
<?php

if ($Homesection[1]['Homesection']['published'] == 'Published' && $Homesection[1]['Homesection']['id'] == 2) {
    ?>
    <section class="section mycontainer">
        <div class="container home">
            <div class="mb50"></div>
            <?php if ($Homesection[1]['Homesection']['content'] != 0) { ?>
                <div class="col-xs-12 header">
                    <h2 class="text-center font_bold m0">
                        <?php echo __($Homesection[1]['Homesection']['sections_heading']); ?>
                    </h2>
                    <p class="homehedp text-center"><?php echo __($Homesection[1]['Homesection']['sections_content']) ?></p>
                </div>
            <?php } ?>
            <!-- filter -->
            <?php if ($Homesection[1]['Homesection']['image'] != 0) { ?>
                <div class="col-xs-12 text-center">
                    <div class="filter">
                        <h2 class="text-center font_bold m0"><?php echo __('Latest Packages') ?></h2>
                    </div>
                </div>
                <div class="col-xs-12 text-center homepackage">
                    <?php
                    $cartUrl = $this->Html->url(array('controller' => 'Carts', 'action' => 'viewajax')); ?>
                    <?php foreach ($Package as $post):$id = $post['Package']['id'];
                        if (strlen($post['Package']['photo']) > 0) {
                            $photo = "package_thumb/" . $post['Package']['photo'];
                        } else {
                            $photo = "nia.png";
                        }
                        $viewUrl = $this->Html->url(array('controller' => 'Packages', 'action' => "view", $id)); ?>

                        <div class="item  col-md-3">
                            <div class="thumbnail mycontainer item_img" style="padding: 5px">
                                <a class=""
                                   href="<?php echo $this->Html->url(array('controller' => 'Packages', 'action' => 'singleproduct', $id, Inflector::slug(strtolower($post['Package']['name']), "-"))) ?>">
                                    <?php echo $this->Html->image($photo, array('alt' => h($post['Package']['name']), 'class' => '
		                            group list-group-image homeimg')); ?>
                                </a>
                                <div class="caption">
                                    <h4 class="group inner list-group-item-heading package-name-list">
                                        <strong><?php echo h($post['Package']['name']); ?></strong></h4>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                    unset($value); ?>


                </div>
                <div class="col-xs-12 text-center">
                    <div class="filter">
                        <div class="btn-group">
                            <a href="<?php echo $this->html->url(array('controller' => 'Packages', 'action' => 'index')); ?>"
                               class="btn btn-success"><?php echo __('Show All'); ?></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
<?php } ?>
<?php if ($frontSlides == 1) { ?>
    <section class="section mycontainer" style="background-color: #f6f8fa;">
        <div class=" home">
            <div class="mb50"></div>
            <div class="flexslider ss" style="background: #f6f8fa;">
                <ul class="slides">
                    <?php foreach ($slides as $k => $value):
                        $photoImg = 'slides_thumb/' . $value['Slide']['photo']; ?>
                        <li>
                            <div class="feat-text-slide col-md-5">
                                <div class="each js-each-feature active" data-feature-id="content-control-1"
                                     style="display: block;">
                                    <h2 class="title"><?php echo $value['Slide']['heading'] ?></h2>
                                    <p class="text"><?php echo $value['Slide']['content'] ?>.</p>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <?php echo $this->Html->image($photoImg, array('alt' => $value['Slide']['slide_name'])); ?>
                            </div>

                        </li>
                    <?php endforeach;
                    unset($k);
                    unset($value); ?>
                </ul>
            </div>
            <div class="mb50"></div>
        </div>
    </section>
<?php } ?>

<?php
if ($Homesection[2]['Homesection']['published'] == 'Published' or $Homesection[3]['Homesection']['published'] == 'Published') {
    ?>
    <section class="section mycontainer">
        <div class="container home">
            <div class="mb50"></div>
            <div class="mb50"></div>
            <div class="col-md-12">
                <div class="col-md-3 col-md-offset-6">
                    <ul class="nav nav-tabs">
                        <?php
                        if ($Homesection[2]['Homesection']['published'] == 'Published' && $Homesection[2]['Homesection']['published'] == 'Published') { ?>
                            <li class="active"><a data-toggle="tab" href="#home">
                                    <?php echo __($Homesection[2]['Homesection']['section']) ?></a></li>
                            <li><a data-toggle="tab"
                                   href="#menu1"><?php echo $Homesection[3]['Homesection']['section'] ?></a></li>
                        <?php } elseif ($Homesection[2]['Homesection']['published'] == 'Published' && $Homesection[3]['Homesection']['published'] == 'Unpublished') {
                            ?>
                            <li class="active"><a data-toggle="tab" href="#home">
                                    <?php echo __($Homesection[2]['Homesection']['section']); ?></a></li>
                        <?php } elseif ($Homesection[2]['Homesection']['published'] == 'Unpublished' && $Homesection[3]['Homesection']['published'] == 'Published') {
                            ?>
                            <li class="active"><a data-toggle="tab" href="#home">
                                    <?php echo __($Homesection[3]['Homesection']['section']) ?></a></li>
                        <?php } ?>

                    </ul>
                </div>

            </div>
            <div class="tab-content">
                <?php
                if ($Homesection[2]['Homesection']['published'] == 'Published' && $Homesection[3]['Homesection']['published'] == 'Published') { ?>

                    <div id="home" class="tab-pane fade in active">
                        <div class="col-md-12">
                            <?php
                            if ($Homesection[2]['Homesection']['image'] == 1 && $Homesection[2]['Homesection']['content'] == 1) {
                                $conhidden = '';
                                $concol = 'col-md-6';

                                $imghidden = '';
                                $imgcol = 'col-md-6';

                            } elseif ($Homesection[2]['Homesection']['image'] == 1 && $Homesection[2]['Homesection']['content'] == 0) {
                                $conhidden = 'hidden';
                                $concol = '';

                                $imghidden = '';
                                $imgcol = 'col-md-12';
                            } elseif ($Homesection[2]['Homesection']['image'] == 0 && $Homesection[2]['Homesection']['content'] == 1) {
                                $conhidden = '';
                                $concol = 'col-md-12';
                                $imghidden = 'hidden';
                                $imgcol = '';
                            } elseif ($Homesection[2]['Homesection']['image'] == 0 && $Homesection[2]['Homesection']['content'] == 0) {
                                $conhidden = 'hidden';
                                $concol = '';
                                $imghidden = 'hidden';
                                $imgcol = '';
                            }

                            ?>


                            <div class="<?php echo $imgcol . $imghidden ?>">
                                <?php echo $this->html->image('tab/' . $Homesection[2]['Homesection']['sections_img'], array('alt' => '', 'border' => '0', 'class' => 'img-responsive', 'style' => 'margin: 0 auto')) ?>
                            </div>
                            <div class=" <?php echo $concol . $conhidden; ?>">
                                <div class="each js-app-content" data-active-app="current_app" style="display: block;">
                                    <div class="mb50"></div>
                                    <h2 class="font_bold"><?php echo __($Homesection[2]['Homesection']['sections_heading']); ?></h2>
                                    <p class="text"><?php echo __($Homesection[2]['Homesection']['sections_content']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="menu1" class="tab-pane fade">
                        <div class="col-md-12">
                            <?php
                            if ($Homesection[3]['Homesection']['image'] == 1 && $Homesection[3]['Homesection']['content'] == 1) {
                                $conhidden = '';
                                $concol = 'col-md-6';

                                $imghidden = '';
                                $imgcol = 'col-md-6';

                            } elseif ($Homesection[3]['Homesection']['image'] == 1 && $Homesection[3]['Homesection']['content'] == 0) {
                                $conhidden = 'hidden';
                                $concol = '';

                                $imghidden = '';
                                $imgcol = 'col-md-12';
                            } elseif ($Homesection[3]['Homesection']['image'] == 0 && $Homesection[3]['Homesection']['content'] == 1) {
                                $conhidden = '';
                                $concol = 'col-md-12';
                                $imghidden = 'hidden';
                                $imgcol = '';
                            } elseif ($Homesection[3]['Homesection']['image'] == 0 && $Homesection[3]['Homesection']['content'] == 0) {
                                $conhidden = 'hidden';
                                $concol = '';
                                $imghidden = 'hidden';
                                $imgcol = '';
                            }

                            ?>
                            <div class="<?php echo $imgcol . $imghidden; ?>">
                                <?php echo $this->html->image('tab/' . $Homesection[3]['Homesection']['sections_img'], array('alt' => '', 'border' => '0', 'class' => 'img-responsive')) ?>
                            </div>
                            <div class="<?php echo $concol . $conhidden ?>">
                                <div class="each js-app-content" data-active-app="current_app" style="display: block;">
                                    <div class="mb50"></div>
                                    <h2 class="font_bold"><?php echo __($Homesection[3]['Homesection']['sections_heading']); ?></h2>
                                    <p class="text"><?php echo __($Homesection[3]['Homesection']['sections_content']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } elseif ($Homesection[2]['Homesection']['published'] == 'Published' && $Homesection[3]['Homesection']['published'] == 'Unpublished') {
                    ?>
                    <div id="home" class="tab-pane fade in active">
                        <div class="col-md-12">
                            <?php
                            if ($Homesection[2]['Homesection']['image'] == 1 && $Homesection[2]['Homesection']['content'] == 1) {
                                $conhidden = '';
                                $concol = 'col-md-6';

                                $imghidden = '';
                                $imgcol = 'col-md-6';

                            } elseif ($Homesection[2]['Homesection']['image'] == 1 && $Homesection[2]['Homesection']['content'] == 0) {
                                $conhidden = 'hidden';
                                $concol = '';

                                $imghidden = '';
                                $imgcol = 'col-md-12';
                            } elseif ($Homesection[2]['Homesection']['image'] == 0 && $Homesection[2]['Homesection']['content'] == 1) {
                                $conhidden = '';
                                $concol = 'col-md-12';
                                $imghidden = 'hidden';
                                $imgcol = '';
                            } elseif ($Homesection[2]['Homesection']['image'] == 0 && $Homesection[2]['Homesection']['content'] == 0) {
                                $conhidden = 'hidden';
                                $concol = '';
                                $imghidden = 'hidden';
                                $imgcol = '';
                            }

                            ?>


                            <div class="<?php echo $imgcol . $imghidden ?>">
                                <?php echo $this->html->image('tab/' . $Homesection[2]['Homesection']['sections_img'], array('alt' => '', 'border' => '0', 'class' => 'img-responsive', 'style' => 'margin: 0 auto')) ?>
                            </div>
                            <div class=" <?php echo $concol . $conhidden; ?>">
                                <div class="each js-app-content" data-active-app="current_app" style="display: block;">
                                    <div class="mb50"></div>
                                    <h2 class="font_bold"><?php echo $Homesection[2]['Homesection']['sections_heading']; ?></h2>
                                    <p class="text"><?php echo $Homesection[2]['Homesection']['sections_content']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } elseif ($Homesection[2]['Homesection']['published'] == 'Unpublished' && $Homesection[3]['Homesection']['published'] == 'Published') {
                    ?>
                    <div id="menu1" class="tab-pane fade tab-pane fade in active">
                        <div class="col-md-12">
                            <?php
                            if ($Homesection[3]['Homesection']['image'] == 1 && $Homesection[3]['Homesection']['content'] == 1) {
                                $conhidden = '';
                                $concol = 'col-md-6';

                                $imghidden = '';
                                $imgcol = 'col-md-6';

                            } elseif ($Homesection[3]['Homesection']['image'] == 1 && $Homesection[3]['Homesection']['content'] == 0) {
                                $conhidden = 'hidden';
                                $concol = '';

                                $imghidden = '';
                                $imgcol = 'col-md-12';
                            } elseif ($Homesection[3]['Homesection']['image'] == 0 && $Homesection[3]['Homesection']['content'] == 1) {
                                $conhidden = '';
                                $concol = 'col-md-12';
                                $imghidden = 'hidden';
                                $imgcol = '';
                            } elseif ($Homesection[3]['Homesection']['image'] == 0 && $Homesection[3]['Homesection']['content'] == 0) {
                                $conhidden = 'hidden';
                                $concol = '';
                                $imghidden = 'hidden';
                                $imgcol = '';
                            }

                            ?>
                            <div class="<?php echo $imgcol . $imghidden; ?>">
                                <?php echo $this->html->image('tab/' . $Homesection[3]['Homesection']['sections_img'], array('alt' => '', 'border' => '0', 'class' => 'img-responsive')) ?>
                            </div>
                            <div class="<?php echo $concol . $conhidden ?>">
                                <div class="each js-app-content" data-active-app="current_app" style="display: block;">
                                    <div class="mb50"></div>
                                    <h2 class="font_bold"><?php echo __($Homesection[3]['Homesection']['sections_heading']); ?></h2>
                                    <p class="text"><?php echo __($Homesection[3]['Homesection']['sections_content']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
            <div class="mb50"></div>
        </div>
    </section>
<?php } ?>
<section class="section mycontainer" style="background-color: #f6f8fa;">
    <div class="mb50"></div>
    <div class="mb50"></div>
    <div class="container home">

        <?php if ($siteTestimonial){ ?>
        <div class="col-sm-12">
            <div class="section-testimonials  el_max_height"
            ">
            <div class="">
                <h3 class="title-small mrg-left text-center "><?php echo __('TESTIMONIALS'); ?></h3>
                <div class="owl-carousel owl-portfolio">
                    <?php
                    $tscount = "";
                    foreach ($testimonials as $postTestimonial):
                        $tscount++;
                        ?>
                        <div class="owl-el">
                            <div class="jag-tst-avatar text-center">
                                <?php if ($postTestimonial['Testimonial']['photo']) {
                                    echo $this->Html->image('testimonial_thumb/' . $postTestimonial['Testimonial']['photo'], array('alt' => 'CakePHP', 'border' => '0', 'class' => 'img-responsive'));
                                } else {
                                    echo $this->Html->image('blankuser.jpg', array('alt' => 'CakePHP', 'border' => '0', 'class' => 'img-responsive'));
                                }
                                ?>
                            </div>
                            <div class="ss-tst-details text-center">
                                <div class="ss-name marginbottom_10"><?php echo $postTestimonial['Testimonial']['name']; ?></div>
                                <div class="ss-rating text-center">
                                    <star-rating max="5" ng-value="5"
                                                 value="<?php echo $postTestimonial['Testimonial']['rating'] ?>"></star-rating>
                                </div>
                            </div>
                            <blockquote>
                                <p class="p0"><?php echo $postTestimonial['Testimonial']['description']; ?></p>
                                <footer>
                                </footer>
                            </blockquote>
                        </div>
                    <?php endforeach;
                    unset($postTestimonial); ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>


    </div>
    <div class="mb50"></div>
</section>

<section class="section mycontainer">
    <div class="container ">
        <div class="mb50"></div>
        <div class="row col-p30">
            <?php if ($sitePanel1) { ?>
                <div class="col-sm-4 xs-box2">
                    <div class="box-services-c">
                        <i class="fa fa-user fa-5x"></i>
                        <h3 class="title-small br-bottom-center"><?php echo __('No of Visitors'); ?></h3>
                        <p class="mb0">
                        <h3 class="text-danger"><?php echo $visitors; ?></h3></strong></p>
                    </div>
                </div>
            <?php } ?>
            <?php if ($sitePanel2) { ?>
                <div class="col-sm-4 xs-box2">
                    <div class="box-services-c">
                        <i class="fa fa-graduation-cap fa-5x"></i>
                        <h3 class="title-small br-bottom-center"><?php echo __('No of Students'); ?></h3>
                        <p class="mb0">
                        <h3 class="text-danger"><?php echo $students; ?></h3></p>
                    </div>
                </div>
            <?php } ?>
            <?php if ($sitePanel3) { ?>
                <div class="col-sm-4">
                    <div class="box-services-c">
                        <i class="fa fa-book fa-5x"></i>
                        <h3 class="title-small br-bottom-center"><?php echo __('No of Exams'); ?></h3>
                        <p class="mb0">
                        <h3 class="text-danger"><?php echo $exams; ?></h3></p>
                    </div>
                </div>
            <?php } ?>

        </div>
        <div class="mb50"></div>
    </div>
</section>
<?php if ($siteAds) { ?>
    <section class="section mycontainer" style="background-color: #f6f8fa;">
        <div class="mb50"></div>
        <div class="container home">
            <div class="col-sm-12">
                <div class="section-testimonials  el_max_height">
                    <h3 class="title-small mrg-left text-center "><?php echo __('Advertisements'); ?></h3>
                    <div class="flexslider carousel" style="background: transparent;">
                        <ul class="slides">
                            <?php
                            $sn = 0;
                            foreach ($advertisements as $value) {
                                $sn++;
                                if ($sn == 4) {
                                    $sn = 1;
                                }
                                ?>
                                <li>
                                    <?php
                                    $photoImg = 'advertisement_thumb/' . $value['Advertisement']['photo']; ?>
                                    <?php
                                    $urlArr = "#";
                                    if (strlen($value['Advertisement']['url']) > 0) {
                                        if ($value['Advertisement']['url_type'] == "External") {
                                            $urlArr = $value['Advertisement']['url'];
                                        } else {
                                            $urlArr = array('controller' => $value['Advertisement']['url']);
                                        }
                                    }
                                    echo $this->Html->link($this->Html->image($photoImg, array('alt' => $value['Advertisement']['name'], 'class' => 'img-responsive')), $urlArr, array('escape' => false, 'target' => $value['Advertisement']['url_target'])); ?>

                                </li>
                            <?php }
                            unset($value); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb50"></div>
    </section>
<?php } ?>

<section class="section mycontainer">
    <div class="mb50"></div>
    <div class="container home">
        <div class="col-sm-12">
            <h3 class="title-small text-center"><?php echo __('Latest News & Events'); ?></h3>
            <div class="col-md-8 col-md-offset-2">
                <marquee align="top" direction="up" onmouseover="this.stop();" onmouseout="this.start();"
                         scrollamount="2" height="218">
                    <ul>
                        <?php foreach ($news as $value):$id = $value['News']['page_url']; ?>
                            <li><?php echo $this->Html->link($value['News']['news_title'], array('controller' => 'News', 'action' => 'show', $id)); ?></li>
                        <?php endforeach;
                        unset($value); ?>
                    </ul>
                </marquee>
            </div>

        </div>
    </div>

    <div class="mb50"></div>
</section>


<style type="text/css">
    .top-bg-overlay-fill {
        position: absolute;
        background: rgba(0, 0, 0, .5);
        height: 100%;
        width: 100%;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
    }
</style>
<?php if ($Homesection[4]['Homesection']['published'] == 'Published') { ?>
    <section class="section mycontainer"
             style="position: relative;background-image: url('<?php echo $this->webroot;?>img/tab/<?php echo $Homesection[4]['Homesection']['sections_img'] ?>');background-size: cover;min-height: 350px;text-align: center;">
        <div class="mb50"></div>
        <div class="container home">
            <div class="top-bg-overlay-fill"></div>
            <div class="lb-content text-center">
                <h1 class="text-center font_bold m0"
                    style="color: #fff;"><?php echo $Homesection[4]['Homesection']['sections_heading'] ?></h1>
                <p class="text-center"
                   style="color: #fff"><?php echo $Homesection[4]['Homesection']['sections_content'] ?></p>

            </div>
        </div>
        <div class="mb50"></div>

    </section>
<?php } ?>
<script>
    $(document).ready(function () {
        $('.flexslider.ss').flexslider({
            animation: 'slide',
            directionNav: false,
            slideshowSpeed: '5000',
            controlsContainer: '.flexslider.ss'
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.flexslider.carousel').flexslider({
            animation: "slide",
            slideshowSpeed: '4000',
            mousewheel: true,
            directionNav: true,
            animationLoop: true,
            controlNav: false,
            itemWidth: 288,
            itemMargin: 30,
            touch: true,
            minItems: 3,
            maxItems: 6,
            controlsContainer: '.flexslider.carousel'
        });
    });
</script>

<?php
echo $this->Html->script('/design700/js/star-rating.js');
?>