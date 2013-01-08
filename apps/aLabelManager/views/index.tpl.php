<?php
    require_once dirname(__FILE__).'/../core.php';
    header('Content-type: text/html; charset=UTF-8'); // force header UTF-8
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/admin.css" media="screen" />
    <link type="text/css" href="css/bootstrap.min.css" rel="stylesheet" />
    <link type="text/css" href="css/ui/jquery.ui.css" rel="stylesheet" />
    <link type="text/css" href="css/jquery.fancybox.css" rel="stylesheet" />

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.ui.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="js/jquery.fancybox.js"></script>
    <script type="text/javascript" src="js/jquery.easing.js" /></script>
    <script type="text/javascript" src="js/jquery.jeditable.js" /></script>
    <script type="text/javascript" src="js/jquery.mousewheel.js" /></script>

    <script type="text/javascript">
        var oTable;
        $(function(){
           oTable = $('#labelsTable').dataTable( {
                   "iDisplayLength": 1000,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "ajax,
                    "fnDrawCallback": function () {
                     $('#labelsTable tr').each(function(index) {
                         var id = $(this).children(':nth(0)').html();
                         var uniquename = $(this).children(':nth(1)').html();
                         var isocode = $(this).children(':nth(2)').html();

                         $(this).attr('id','tr|'+uniquename+'|'+isocode);
                         $(this).children(':nth(0)').attr('id','id|'+id).attr('class','id');
                         $(this).children(':nth(1)').attr('id','uniquename|'+id).attr('class','uniquename');
                         $(this).children(':nth(2)').attr('id','isocode|'+id).attr('class','isocode');
                         $(this).children(':nth(3)').attr('id','value|'+id).attr('class','value');
                         $(this).children(':nth(4)').attr('id','context|'+id).attr('class','context');
                     });



                     $('.context').click(function(e){
                             //alert($(this).attr('id'));
                              $.fancybox({
                                        padding		: 0,
                                        autoScale		: false,
                                        title			: $(this).attr('id'),
                                        width		: '900px',
                                        height		: 495,
                                        href			: 'lib/a.jsonEditor.php?id='+$(this).attr('id')+'&value='+$(this).text(),
                                        onClosed		: function() {
                                            window.location.reload();
                                      oTable.fnDraw();
                                        }
                                    });

                                return false;
                     });


                  $('#labelsTable tbody td.value').editable( 'inc/a.labels.load.php?insert',
                      {
                         type      : 'textarea',
                         cancel    : 'Cancel',
                         submit    : 'OK',
                         indicator : '<img src="img/indicator.gif">',
                         tooltip   : 'Click to edit...',
                        callback: function(sValue,y) {
                           oTable.fnDraw();
                        },
                        height: "60px"
                    });

                }

                //CONTEXT LABELS

            });
        });
        $(function(){

            // Accordion
            var stop = false;
            $( ".accordion h3" ).click(function(e) {
                if (stop) {
                    e.stopImmediatePropagation();
                    e.preventDefault();
                    stop = false;
                }
            });
            $(".accordion").accordion({
                header: "h3",
                collapsible: true,
                sortable: true,
                active : <?php echo (!empty($_GET['show'])?$_GET['show']:'false'); ?>
            }).sortable({
                axis: "y",
                handle: "h3",
                stop: function() {
                    stop = true;
                }
            });

            //lightbox baby
            $('.lb').fancybox();

            $('.showLb').fancybox({'width' : 780, 'height' : 550});

            // Datepicker
            $('.ui-date').datepicker({});
        });
    </script>
</head>
<body>
    <div class="app-container">
        <div class="wrapper">
            <div id="main" class="tabs">
                <table id="labelsTable" class="table table-striped table-bordered dataTable">

                    <thead>
                        <tr>
                            <th width="100">Id</th>
                            <th width="100">Uniquename</th>
                            <th width="50" >Isocode</th>
                            <th>Value</th>
                            <th width="100">Context</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div><!--/main-->
            <div id="footer">

            </div><!--/footer-->
        </div><!--/wrapper-->
    </div>
</body>
</html>
