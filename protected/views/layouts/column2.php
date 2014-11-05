<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="col-sm-8">
    <div id="content">
        <?php echo $content; ?>
    </div>
    <!-- content -->
</div>
<div class="col-sm-4">
    <div id="sidebar">
        <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title' => 'Operations',
        ));
        $this->widget('zii.widgets.CMenu', array(
            'items' => $this->menu,
            'htmlOptions' => array('class' => 'operations'),
        ));
        $this->endWidget();
        ?>
    </div>
    <!-- sidebar -->
</div>
<?php $this->endContent(); ?>