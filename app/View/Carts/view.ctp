<?php if (count($products) == 0) { ?>
    <style type="text/css">
        .img-thumbnail > img {
            max-width: 220px;
            min-width: 220px;
        }
    </style>
    <section class="section">
        <div class="container mycontainer">
            <div class="container-fluid">
                <div class="col-md-12 product-info">
                    <div class="col-md-12">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <div class="empty-cart">
                                <center>
                                    <?php echo $this->Html->link('<i class="fa fa-shopping-bag"></i>', array('controller' => 'Packages'), array('class' => "cartbag", 'escape' => false)); ?>
                                    <br>
                                    <br>
                                    <span class="text-uppercase empty-msg"><?php echo __('your cart is empty'); ?></span>
                                    <p class="add-item-msg"><?php echo __('Add packages to your cart now!'); ?></p>
                                    <?php echo $this->Html->link('<span class="fa fa-shopping-cart"></span>&nbsp;' . __('Continue Shopping'), array('controller' => 'Packages', 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => false)); ?>
                                </center>
                            </div>
                        </div>
                        <div class="col-sm-2"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="page-heading">
                            <div class="widget">
                                <h2 class="title-border"><?php echo __('FEATURED EXAMS'); ?></h2>
                            </div>
                        </div>
                        <div class="flexslider carousel">
                            <ul class="slides">
                                <?php
                                if ($Packages) {
                                    foreach ($Packages as $Packagesvalue) {
                                        $Package_id = $Packagesvalue['Package']['id'];
                                        $Packagesvalue['Package']['name'];
                                        $Packagesvalue['Package']['photo'];
                                        if ($id != $Package_id) {
                                            ?>
                                            <li>
                                                <div class="col-md-12">
                                                    <a href="<?php echo $this->Html->url(array('controller' => 'Packages', 'action' => 'singleproduct/' . $Package_id)) ?>">
                                                        <div class="img-thumbnail">
                                                            <?php if (strlen($Packagesvalue['Package']['photo']) > 0) {
                                                                $photo1 = "package/" . $Packagesvalue['Package']['photo'];
                                                            } else {
                                                                $photo1 = "nia.png";
                                                            } ?>
                                                            <?php echo $this->Html->image($photo1, array('alt' => $Packagesvalue['Package']['name'], 'class' => 'img-package')); ?>
                                                        </div>
                                                        <div style="clear: both;"></div>
                                                        <h4 class="text-info text-left"><?php echo $Packagesvalue['Package']['name']; ?></h4>
                                                    </a>
                                                </div>
                                            </li>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div style="clear: both;"></div>
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

<?php } else { ?>
    <section class="section">
        <div class="container mycontainer">
            <div class="col-sm-12">
                <div class="col-sm-12">
                    <div class="panel-heading">
                        <div class="widget">
                            <h2 class="title-border m0"><?php echo __('Shopping Cart'); ?></h2>
                        </div>
                    </div>
                    <div class="">
                        <table class="table table-hover" border="0">
                            <thead>
                            <tr>
                                <th><?php echo __('Product'); ?> </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total = 0;
                            $totalQuantity = 0; ?>
                            <?php foreach ($products

                                           as $product):
                                if (strlen($product['Package']['photo']) > 0) {
                                    $photo = "package_thumb/" . $product['Package']['photo'];
                                } else {
                                    $photo = "nia.png";
                                }
                                $id = $product['Package']['id'];
                                $viewUrl = $this->Html->url(array('controller' => 'Packages', 'action' => "view", $id));
                                ?>
                                <tr>
                                    <td class="col-sm-8 col-md-6">
                                        <div class="media">
                                            <a class="thumbnail pull-left" href=""
                                               onclick"show_modal(<?php echo $viewUrl; ?>)">
                                            <?php echo $this->Html->image($photo, array('alt' => h($product['Package']['name']), 'class' => 'img-thumbnail img-package', 'width' => '100', 'height' => '100')); ?>
                                            </a>

                                            <div class="media-body">
                                                <h4 class="media-heading">
                                                    <?php echo $this->Html->link(h($product['Package']['name']), 'javascript:void(0);', array('onclick' => "show_modal('$viewUrl');", 'escape' => false, 'class' => '')); ?>
                                                </h4>

                                            </div>
                                        </div>
                                        <div>
                                            <span style="float: right;"><?php echo $this->html->link('<span class="fa fa-remove"></span> Remove', array('controller' => 'Carts', 'action' => 'delete', $product['Package']['id']), array('escape' => false, 'class' => 'btn btn-sm btn-danger')); ?></span>
                                        </div>
                                        <div>
                                            <strong><?php echo __('Qty'); ?>: </strong>
                                            <?php echo $this->Form->hidden('package_id.', array('value' => $product['Package']['id'])); ?>
                                            <?php echo $product['Package']['count']; ?>
                                        </div>
                                        <div>
                                            <strong style="font-size:17px;">
                                                <?php echo __('Amount'); ?>
                                                <?php if ($product['Package']['show_amount'] != $product['Package']['amount']) { ?>
                                                    <strike>
                                                        <span style="font-weight: normal;"> <?php echo $currency . $product['Package']['show_amount']; ?></span>
                                                    </strike>
                                                <?php } ?> <?php echo $currency . $product['Package']['count'] * $product['Package']['amount']; ?>
                                            </strong>
                                        </div>
                                        <div>
                                            <span><strong><?php echo __('Exams'); ?>: </strong></span><span
                                                    class="text-success"><strong><?php foreach ($product['Exam'] as $examName):
                                                        echo h($examName['name']); ?> |
                                                    <?php endforeach;
                                                    unset($examName);
                                                    unset($examName); ?></strong></span>
                                        </div>
                                    </td>
                                </tr>
                                <?php $total = $total + ($product['Package']['count'] * $product['Package']['amount']);
                                $totalQuantity = $totalQuantity + $product['Package']['count']; ?>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td align="right">  
                                    <h3><?php echo __('Total'); ?>: <?php echo $currency . $total ?></h3></td>
                            </tr>
                            <tr>
                                <td align="right">
                                    <?php echo $this->Html->link('<span class="fa fa-shopping-cart"></span>&nbsp;' . __('Continue Shopping'), array('controller' => 'Packages', 'action' => 'index'), array('class' => 'btn btn-default', 'escape' => false)); ?>

                                </td>
                            </tr>
                            <tr>
                                <td align="right">
                                    <?php if ($total == 0) { ?>
                                    <?php echo $this->Html->link(__('Proceed to Free Checkout') . '&nbsp;&nbsp;<span class="fa fa-play"></span>', array('controller' => 'Checkouts', 'action' => 'index'), array('class' => 'btn btn-success', 'escape' => false)); ?>
                                </td>
                                <?php } else { ?>
                                    <?php echo $this->Html->link(__('Checkout') . '&nbsp;&nbsp;<span class="fa fa-play"></span>', array('controller' => 'Checkouts', 'action' => 'index'), array('class' => 'btn btn-success', 'escape' => false)); ?>
                                <?php } ?>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>

            </div>
        </div>
        <div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-content">
            </div>
        </div>
    </section>
<?php } ?>