<!doctype html>
<!--[if lt IE 7 ]> <html class="ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <BASE href="<?= u::getURLPath() ?>">
    <title><?= $this->title ?></title>
    <?php
        foreach($this->meta as $key=>$m)
            echo '<meta name="'.$key.'" content="'.$m.'">'."\n\t";
    ?>
    <?= c_load::CSS(); ?>
    <!--[if lt IE 9]>
    <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?= $this->_head; ?>
</head>
<body <?= $this->_body->_attributes ?>>
     <?= $this->_body ?>
    <div id="container" <?= $this->container->_attributes ?>>
        <header id="main-header" class="wrapper">
                <?= $this->header ?>
        </header>
        <div id="main" class="wrapper">
                <article>
                    <?= $this->content ?>
                </article>
            <aside id="sidebar">
                    <?= $this->sidebar ?>
            </aside>
              <footer id="footer" class="wrapper">
                   <?= $this->footer ?>
              </footer>
        </div>
        <!--/#main -->
    </div>
    <!--/#container -->
    <?= $this->_js ?>
</body>
</html>
