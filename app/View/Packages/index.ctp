<?php //$cartUrl = $this->Html->url(array('controller' => 'Carts', 'action' => 'View')); ?>
<?php

$this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
    'update' => '#resultDiv',
    'evalScripts' => true,
));

?>

<section class="section">
    <div class="container mycontainer">
        <div id="resultDiv">
            <div class="page-heading">
                <div class="widget">
                    <h2 class="title-border"><?php echo __('Packages'); ?></h2>
                </div>
            </div>
            <div id="products" class="row list-group">
                <?php echo $this->Session->flash();
                $cartUrl = $this->Html->url(array('controller' => 'Carts', 'action' => 'viewajax')); ?>
                <?php foreach ($Package as $post):$id = $post['Package']['id'];
                    if (strlen($post['Package']['photo']) > 0) {
                        $photo = "package/" . $post['Package']['photo'];
                    } else {
                        $photo = "nia.png";
                    }
                    $viewUrl = $this->Html->url(array('controller' => 'Packages', 'action' => "view", $id)); ?>

                    <div class="item  col-md-3">
                        <div class="thumbnail mycontainer item_img" style="padding: 5px">
                            <a class=""
                               href="<?php echo $this->Html->url(array('controller' => 'Packages', 'action' => 'singleproduct', $id, Inflector::slug(strtolower($post['Package']['name']), "-"))) ?>">
                                <?php echo $this->Html->image($photo, array('alt' => h($post['Package']['name']), 'class' => '
                            group list-group-image PackageImg')); ?>
                            </a>
                            <div class="caption">
                                <h4 class="group inner list-group-item-heading package-name-list">
                                    <strong><?php echo h($post['Package']['name']); ?></strong></h4>
                                <div class="row">
                                    <div class="col-xs-12 col-md-12">
                                        <span class="lead">
                                            <?php if ($post['Package']['show_amount'] != $post['Package']['amount']) { ?>
                                                <span class="text-danger">
                                                <strong>
                                                    <strike>
                                                        <?php echo $currency . $post['Package']['show_amount']; ?>
                                                    </strike>
                                                </strong>
                                            </span>
                                            <?php } ?>
                                            <span class="text-success">
                                                <big>
                                                    <strong id="pac<?php echo $id ?>">
                                                        <?php echo $currency . $post['Package']['amount']; ?>
                                                    </strong>
                                                </big>
                                            </span>
                                        </span>
                                        <hr style="margin:10px 0;">
                                    </div>

                                    <div class="col-xs-12 col-md-12 text-center">
                                        <div class="btn-group">
                                            <?php
                                            $url = $this->Html->url(array('controller' => 'Carts', 'action' => 'buy'));
                                            if ($post['Package']['amount'] > 0) {
                                                echo $this->Html->link('<span class="fa fa-shopping-cart"></span>&nbsp;' . __('Add to Cart'), 'javascript:void(0);', array('onclick' => "shopCart('$id');", 'rel' => $url, 'escape' => false, 'class' => 'btn btn-success shopCart', 'id' => 'addtocart' . $id));
                                            } else {
                                                echo $this->Html->link('<span class="fa fa-play"></span>&nbsp;' . __('Start Now'),array('controller'=>'Packages','action'=>'startnow',$id), array('escape' => false, 'class' => 'btn btn-success'));
                                            }


                                            ?>

                                            <?php echo $this->Html->link('<span class="fa fa-alt-screen"></span>&nbsp;' . __('Full Details'), 'javascript:void(0);', array('onclick' => "show_modal('$viewUrl');", 'escape' => false, 'class' => 'btn btn-info')); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
                unset($value); ?>
            </div>


            <div
                    class="col-sm-12"><?php echo $this->element('pagination', array('IsSearch' => 'No', 'IsDropdown' => 'No')); ?></div>
        </div>
        <div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-content">
            </div>
        </div>
    </div>
</section>
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
                    var cart = $('#products_animation_id');
                    var imgtodrag = $('#addtocart' + selectedValue).parent().parent().parent().parent().parent('.item_img').find("img").eq(0);
                    if (imgtodrag) {
                        var imgclone = imgtodrag.clone()
                            .offset({
                                top: imgtodrag.offset().top,
                                left: imgtodrag.offset().left
                            })
                            .css({
                                'opacity': '0.9',
                                'position': 'absolute',
                                'height': '250px',
                                'width': '250px',
                                'z-index': '100',
                                'border': '1px solid #000',
                                'border-radius': '100%'


                            })
                            .appendTo($('body'))
                            .animate({
                                'top': cart.offset().top + 10,
                                'left': cart.offset().left + 10,
                                'width': 75,
                                'height': 75
                            }, 1000, 'easeInOutExpo');

                        setTimeout(function () {
                            cart.effect("shake", {
                                times: 2
                            }, 200);
                        }, 1500);

                        imgclone.animate({
                            'width': 0,
                            'height': 0
                        }, function () {
                            $(this).detach()
                        });

                    }

                    setTimeout(function () {
                        var checkoutUrl = '<?php echo $this->Html->url(array('controller' => 'Carts', 'action' => 'View')) ?>';
                        window.location.href = checkoutUrl;
                    }, 1200);
                }

            },
            error: function (e) {

            }
        });

    }
</script>
<script
        type="text/javascript">
    $(document).ready(function () {
        $('#sort').change(function () {
            var selectedValue = $(this).val();
            post_req.action = selectedValue;
            post_req.submit();
        });
    });
</script>
<?php
echo $this->fetch('script');
echo $this->Html->script('/design700/js/jquery-ui.min.js');

?>

