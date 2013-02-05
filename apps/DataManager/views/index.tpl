<!DOCTYPE html>
<!--[if IEMobile 7]><html class="iem7" lang="fr" dir="ltr"><![endif]-->
<!--[if lt IE 7]><html class="ie6" lang="fr" dir="ltr"><![endif]-->
<!--[if (IE 7)&(!IEMobile)]><html class="ie7" lang="fr" dir="ltr"><![endif]-->
<!--[if IE 8]><html class="ie8" lang="fr" dir="ltr"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="<?= ZE_LANG ?>" dir="ltr"><!--<![endif]-->
<head>
    <meta charset="UTF-8" />

    <link rel="stylesheet" href="<?= ARX_CSS ?>/arxmin.css?v=1" />
    <link rel="stylesheet" href="<?= ARX_CSS ?>/jquery.ui.css?v=1" />
    <link rel="stylesheet" href="css/style.css?v=1" />
</head>
<body class="application">
    
    <div class="container-fluid">
        <div class="row-fluid">
            <ul class="breadcrumb">
                <li class="first"><i class="icon-sitemap"></i></li>
                <li><a href="#">Home</a> <span class="divider">/</span></li>
                <li><a href="#">Library</a> <span class="divider">/</span></li>
                <li class="active">Data</li>
            </ul>
        </div>

        <div class="row-fluid">
            <div id="sidebar">
                <ul class="nav sortable">
                    <li>
                        <div class="accordion" id="id-parent">
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a href="#id" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#id-parent" data-tooltipmenu="#folder1" rel="tooltipmenu"><i class="icon-folder-close-alt"></i><i class="icon-folder-open-alt"></i> Features</a>

                                    <ul id="folder1">
                                        <li>
                                            <a href="#move"><i class="icon-move"></i></a>
                                        </li>
                                        <li>
                                            <a href="#edit"><i class="icon-pencil"></i></a>
                                        </li>
                                        <li>
                                            <a href="#delete"><i class="icon-trash"></i></a>
                                        </li>
                                    </ul>

                                    <div class="ui">
                                        <i class="icon-caret-down"></i>
                                    </div>
                                </div>
                                <div class="accordion-body collapse in" id="id">
                                    <div class="accordion-inner">
                                        <ul class="nav connectedSortable">
                                            <li>
                                                <a href="#file2" rel="tooltipmenu"><i class="icon-file-alt"></i> Users</a>

                                                <ul id="file2">
                                                    <li>
                                                        <a href="#move"><i class="icon-move"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#edit"><i class="icon-pencil"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#delete"><i class="icon-trash"></i></a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#file3" rel="tooltipmenu"><i class="icon-file-alt"></i> Messages</a>

                                                <ul id="file3">
                                                    <li>
                                                        <a href="#move"><i class="icon-move"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#edit"><i class="icon-pencil"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#delete"><i class="icon-trash"></i></a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="#file1" rel="tooltipmenu"><i class="icon-file-alt"></i> Contact</a>
                        <ul class="ui" id="file1">
                            <li>
                                <a href="#move"><i class="icon-move"></i></a>
                            </li>
                            <li>
                                <a href="#edit"><i class="icon-pencil"></i></a>
                            </li>
                            <li>
                                <a href="#delete"><i class="icon-trash"></i></a>
                            </li>
                        </ul>
                    </li>
                    <li class="add">
                        <a href="#add"><i class="icon-plus"></i></a>
                    </li>
                </ul>
            </div>

            <div id="application">
                test
            </div>
        </div>

     
    <div class="tab-content">
        <div class="tab-pane active" id="iframe">

        </div>
        <div class="tab-pane" id="add">

        </div>
        <div class="tab-pane" id="settings">
        <?php
        
        ?>
        </div>
    </div>
    
        <?php
            
        ?>
        
        <?= $this->_body ?>
    </div>

    <script src="/admin/js/lib/jquery.min.js"></script>
    <script src="/admin/js/lib/bootstrap.min.js"></script>
    <script src="/admin/js/lib/bootstrap-tooltipmenu.min.js"></script>
    <script src="<?= ARX_JS ?>/jquery-ui.js"></script>
    <script src="js/script.min.js"></script>
</body>
</html>