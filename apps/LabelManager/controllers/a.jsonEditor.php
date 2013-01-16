<html>
<head>
<title>Json Editor Demo</title>
    <script src="js/jquery.js"></script>
    <script src="js/jquery.ui.js"></script>
    <script src="js/php.default.min.js"></script>
    <script src="js/jquery.jsoneditor.js"></script>
    <script type="text/javascript" src="js/jquery.fancybox.js"></script>
<style>
.json_editor_div .json_remove { color: #FF0000;font-weight:bold;cursor:pointer;float:right; }
.json_editor_div .json_create_value { color:#0000C0;cursor:pointer }
.json_editor_div .json_create_array { color:#0000C0;cursor:pointer }
.json_editor_div .json_export { color:#0000C0;cursor:pointer }
.json_editor_div .json_import { color:#0000C0;cursor:pointer }

.json_editor_div .json_toggle { width:50px;display:inline-block; color:#C0C0C0;cursor:pointer }
.json_editor_div .json_type_swap { width:50px;display:inline-block;color:#C0C0C0;cursor:pointer }

.json_editor_div .highlight{ background-color:pink; }
.json_editor_div .highlight *{ background-color:pink; }

.json_editor_div .json_key_name{ border:0px; border-bottom: #000000 1px solid;color:#00A000;cursor:pointer }
.json_editor_div .json_key_value{ border:0px; border-bottom: #000000 1px solid;color:orange;cursor:pointer; }

.json_editor_div ul{
    border-left:#000000 1px solid;
    border-top:#000000 1px solid;
    border-bottom:#000000 1px solid;
    border-collapse:collapse;
    list-style-type:none;
    padding: 0px 0px 2px 0px;
    margin: 2px 0px 0px 0px;
}
.json_editor_div ul li { padding: 0px 0px 0px 50px; }
.json_editor_div *{ font-family:Verdana;font-size:10.0pt; line-height:1.0; padding:0px;margin:2px 1px 2px 1px ; }
#container{
    width: 800px;
    height: 600px;
    padding: 1em;
}
</style>
</head>
<body>
<div id="container">
<h1>Json Editor : <?php echo $_GET['id']; ?></h1>

<div id="json_div"></div>

<br/>
<select id="example">
    <option value="0">Choose your action</option>
    <option value="1">Save json value</option>
    <option value="2">Save as template</option>
</select>

<br/><br/>
<br/><br/>
<button id="saveQuit">Save and quit</button>
</div>
</body>
</html>
<script>

$( function( ){
    var test_val = <?php echo (!empty($_GET['value'])?stripslashes($_GET['value']):'{"valid":false,"maxChar":160,"Remarks":""}');?>;

    $( "#json_div" )
        .json_editor( test_val, {
                enable_drag:	false,
                enable_remove:	true,
                enable_export:	true,
                enable_import:	true,
                enable_new_val:	true,
                enable_new_array:	true }
        );

    $( "#example" ).change( function( ){
        var selected_index = parseInt( $( this ).val( ) );

//		alert( selected_index );
        switch (selected_index) {

            case 1:
                var jsonVal = ( json_encode( $( "#json_div" ).json_editor( 'export_json' ) ) );
                $.ajax({
                  type: "POST",
                  url: '../inc/a.labels.php?insert',
                  data: "id=<?php echo $_GET['id']?>&value="+jsonVal,
                }).done(function(msg) {
                  alert( "Data Saved !");
                });
                break;
            case 2:
                //this is the same as doing it with .json_editor( 'export_json', [ 'topArray1', 'sub1'] );
                alert( json_encode( $( "#json_div" ).json_editor( 'topArray1' ).json_editor( 'sub1' ).json_editor( 'export_json' ) ) );
                break;
            case 3:
                alert( json_encode( $( "#json_div" ).json_editor( 'export_json', [ 'topArray2', 'sub1' ] ) ) );
                break;
            case 4:
                $( "#json_div" ).json_editor( 'remove', [ 'sample', '0' ] );
                break;
            case 5:
                $( "#json_div" ).json_editor( 'add_key', [ 'sample' ] );
                break;
            case 6:
                $( "#json_div" ).json_editor( 'add_array', [ 'sample' ] );
                break;
            case 7:
                $( "#json_div" ).json_editor( 'import_json', [ 'topArray2', 'sub1' ], { 0:'5', 1:'6', 2:parseInt( Math.random( ) * 100000 ) } );
                break;
        }
    } );

    $( "#saveQuit" ).click( function( ){
                var jsonVal = ( json_encode( $( "#json_div" ).json_editor( 'export_json' ) ) );
                $.ajax({
                  type: "POST",
                  url: '../inc/a.labels.php?insert',
                  data: "id=<?php echo $_GET['id']?>&value="+jsonVal,
                }).done(function(msg) {
                  alert("Data Saved !");
                  parent.$.fancybox.close();
                });
    });
});
</script>
