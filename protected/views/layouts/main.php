<?php
$this->setNavbar();
/* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" value="notranslate">
    <meta charset="UTF-8">
    <meta name="language" content="english"/>

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css"
          media="screen, projection"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css"
          media="print"/>
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css"
          media="screen, projection"/>
    <link href='http://fonts.googleapis.com/css?family=Lato:400,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css"/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/unions.css"/>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/yiiAjax.js"></script>

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>
<header id="header">
    <div class="container">
        <div class="row">
            <div class="pull-left col-xs-6">
                <?php echo CHtml::image(Yii::app()->baseUrl . '/images/banner_logo.jpg', 'Student Center', array('class' => 'img-responsive')); ?>
            </div>
        </div>
    </div>
</header>
<hr class="gold-bar">

<?php
$this->widget(
    'booster.widgets.TbNavbar',
    array(
        'type' => 'inverse',
        'brand' => false,
        'brandUrl' => '#',
        'collapse' => true, // requires bootstrap-responsive.css
        'fixed' => false,
        'fluid' => true,
        'items' => $this->navbar,
    )
);

//$this->renderPartial($this->navbar, null, false, false)
?>

<div id="main-content" class="container-fluid">
    <!-- mainmenu -->
    <?php echo $content; ?>

</div>
<div class="container">
    <!-- footer -->
    <div id="footer">
        <p>
            <small>Copyright &#169;
                2014&#8212; Curators of the <a href="http://www.umsystem.edu">University of Missouri</a>.
                All rights reserved. <br/><a href="http://www.missouri.edu/dmca/">DMCA</a> and <a
                    href="http://www.missouri.edu/copyright.php">other copyright information</a>. An <a
                    href="http://www.missouri.edu/eeo-aa.php">equal opportunity/affirmative action</a>
                institution.
            </small>
        </p>
    </div>
</div>

</body>
</html>