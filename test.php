<!DOCTYPE html>
<html lang="en">
<head>
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Float grid demo</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../dist/gridstack.css"/>
    <!-- Color Picker Begin -->
    <link rel="stylesheet" href="jquery.minicolors.css">
    <!-- Color Picker End -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.0/jquery-ui.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/3.5.0/lodash.min.js"></script>
    <script src="../dist/gridstack.js"></script>
    <!-- Color Picker Begin -->
    <script src="jquery.minicolors.js"></script>
    <!-- Color Picker End -->
    <style type="text/css">
        .grid-stack {
            background: lightgoldenrodyellow;
        }

        .grid-stack-item-content {
            color: #2c3e50;
            text-align: center;
            background-color: #18bc9c;
        }

        #drop-area{
            background: #D8F9D3;min-height:100px;padding:10px;
        }

        h3.drop-text{
            color:#999;text-align:center;font-size:2em;
        }

    </style>
</head>
<body>
<div class="container-fluid">
    <h1>Test</h1>

    <div>
        <a class="btn btn-default add-new-widget" id="add-new-widget" href="#">Add Widget</a>
    </div>

    <br/>

    <div class="grid-stack">
        <div class="grid-stack-item">
        </div>
    </div>

</div>
<script type="text/javascript">
    $(function () {
        var options = {
            float: true
        };
        $('.grid-stack').gridstack(options);


        <!-- Load Grid  Begin -->
        $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: "insert.php",
                dataType: 'json',
                data: {gridload: 'loadingposition'},
                success: function (response) {
                    for (var i in response)
                    {
                        var obj = jQuery.parseJSON( response[i].position );
                        var id  = response[i].id;
                        var grid = $('.grid-stack').data('gridstack');
                        grid.add_widget($('<div><div class="grid-stack-item-content" id="divAllTextBox_'+id+'" data-custom-id="'+id+'"><form id="addForm_'+id+'" method="post" enctype="multipart/form-data"><button type="button" class="btn btn-default" id='+id+' onclick="delData('+response[i].id+'); return false;">Delete</button><div class="form-group"><label for="title">Title</label><input type="text" class="form-control title title" id="title_'+id+'" placeholder="Title" name="title" value="'+response[i].title+'"></div><div class="form-group"><label for="subtitle">Sub Title</label><input type="text" class="form-control subtitle" id="subtitle_'+id+'" placeholder="Sub Title" name="subtitle" value="'+response[i].subtitle+'"></div><div class="form-group"><label for="circle">Circle</label><input type="text" class="form-control circle" id="circle_'+id+'" placeholder="Circle" name="circle" value="'+response[i].circle+'"></div><div class="form-group"><label for="text">Text</label><textarea class="form-control" rows="3" id="text_'+id+'" placeholder="Text" name="text" value="'+response[i].text+'"></textarea></div><div class="form-group"><label for="price">Price</label><input type="text" class="form-control" id="price_'+id+'" placeholder="Price" name="price" value="'+response[i].price+'"></div><div class="form-group"><label for="pseudoprice">Pseudo Price</label><input type="text" class="form-control" id="pseudoprice_'+id+'" placeholder="Pseudo Price" name="pseudoprice" value="'+response[i].pseudo_price+'"></div><div class="form-group"><label for="link">Link</label><input type="text" class="form-control" id="link_'+id+'" placeholder="Link" name="link" value="'+response[i].link+'"></div><div class="form-group" ><label for="color">Color</label><input type="text" name="favcolor" id="color_'+id+'" class="form-control demo" value="'+response[i].color+'"></div><div class="form-group"><label for="column">Column</label><input type="text" class="form-control" id="column_'+id+'" placeholder="Column" name="column" value="'+response[i].column+'"></div><div class="form-group"><label for="column">Image</label><input name="image" type="file" id="image_'+id+'" ><input name="hiddenid" id="hiddenid_'+id+'" type="hidden" value='+id+' ></div><button class="btn btn-default" id='+id+' onclick="saveData('+response[i].id+'); return false;">Submit</button></form></div><div/>'),obj.x, obj.y, obj.width, obj.height, true);
                    }
                    <!-- Color Picker Begin -->
                    $('.demo').minicolors({
                        control: $(this).attr('data-control') || 'hue',
                        defaultValue: $(this).attr('data-defaultValue') || '',
                        inline: $(this).attr('data-inline') === 'true',
                        letterCase: $(this).attr('data-letterCase') || 'lowercase',
                        opacity: $(this).attr('data-opacity'),
                        position: $(this).attr('data-position') || 'bottom left',
                        change: function(hex, opacity) {
                            if( !hex ) return;
                            if( opacity ) hex += ', ' + opacity;
                            if( typeof console === 'object' ) {
                                console.log(hex);
                            }
                        },
                        theme: 'bootstrap'
                    });
                    <!-- Color Picker Begin -->
                }
            });
        });
        <!-- Load Grid End -->

        <!-- Get Position Begin -->
        $(document).ready(function(){
            $('.grid-stack').on('change', function (e, items) {
                var res = _.map($('.grid-stack .grid-stack-item:visible'), function (el) {
                    el  = $(el);
                    var node = el.data('_gridstack_node');
                    return {
                        id: el.attr('data-custom-id'),
                        x: node.x,
                        y: node.y,
                        width: node.width,
                        height: node.height
                    };
                });
                var positionData = JSON.stringify(res);
                //alert(positionData);
                $.post("insert.php", {positionData: positionData, onchangeData: 'updateposition'},
                    function (response) {
                        //alert(response);
                        /*for (var i in response)
                         {
                         alert(response[i].id);
                         }*/
                    });
            });
        });<!-- Get Position End -->


        var id = 1;
        <!-- Adding new widget begin -->
        $('body').on('click', ".add-new-widget", function(){

            var el   = '<div><div class="grid-stack-item-content" id="divAllTextBox_'+id+'" data-custom-id="'+id+'"><form id="addForm_'+id+'" method="post" enctype="multipart/form-data"><button type="button" class="btn btn-default" id='+id+' onclick="delData('+id+'); return false;">Delete</button><div class="form-group"><label for="title">Title</label><input type="text" class="form-control title title" id="title_'+id+'" placeholder="Title" name="title" ></div><div class="form-group"><label for="subtitle">Sub Title</label><input type="text" class="form-control subtitle" id="subtitle_'+id+'" placeholder="Sub Title" name="subtitle" ></div><div class="form-group"><label for="circle">Circle</label><input type="text" class="form-control circle" id="circle_'+id+'" placeholder="Circle" name="circle"></div><div class="form-group"><label for="text">Text</label><textarea class="form-control" rows="3" id="text_'+id+'" placeholder="Text" name="text" ></textarea></div><div class="form-group"><label for="price">Price</label><input type="text" class="form-control" id="price_'+id+'" placeholder="Price" name="price" ></div><div class="form-group"><label for="pseudoprice">Pseudo Price</label><input type="text" class="form-control" id="pseudoprice_'+id+'" placeholder="Pseudo Price" name="pseudoprice" ></div><div class="form-group"><label for="link">Link</label><input type="text" class="form-control" id="link_'+id+'" placeholder="Link" name="link" ></div><div class="form-group"><label for="color">Color</label><input type="text" name="favcolor" id="color_'+id+'" class="form-control demo" ></div><div class="form-group"><label for="column">Column</label><input type="text" class="form-control" id="column_'+id+'" placeholder="Column" name="column" ></div><div class="form-group"><label for="column">Image</label><input name="image" type="file" id="image_'+id+'" ><input name="hiddenid" id="hiddenid_'+id+'" type="hidden" value='+id+' ></div><button class="btn btn-default" id='+id+' onclick="saveData('+id+'); return false;">Submit</button></form></div><div/>';
            id++;
            var grid = $('.grid-stack').data('gridstack');
            grid.add_widget(el, 0, 0, 2, 13, true);

            <!-- Insert Position Begin -->
            var res = _.map($('.grid-stack .grid-stack-item:visible'), function (el) {
                el  = $(el);
                var node = el.data('_gridstack_node');
                return {
                    id: el.attr('data-custom-id'),
                    x: node.x,
                    y: node.y,
                    width: node.width,
                    height: node.height
                };
            });
            var json = JSON.stringify(res);
            var responseID;
            $.ajax({
                async:false,
                type: "post",
                url: "insert.php",
                data: {json: json, jsonData: 'insertjson'},
                success: function (response) {
                    responseID = response['id'];
                    //saveData(response['id']);
                    location.reload();
                }
            });
            <!-- Insert Position End -->
        });
        <!-- Adding new widget end -->
    });

    <!-- Insert and replace div begin -->
    function saveData(id){
        var ID             = id;
        var form = $("#addForm_"+ID)[0];
        var formdata       = new FormData(form);
        formdata.append('image', 'image_'+ID);
        $.ajax({
            type: "post",
            url: "insert.php",
            data: formdata,
            cache: false,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response);
            }
        });
    };<!-- Insert and replace div end -->

    <!-- Delete box and data begin -->
    function delData(id) {
        var delID = id;
        $("#divAllTextBox_"+delID).remove();
        var delForm = 'delForm';
        var dataString = 'delID='+delID+'&delForm='+delForm;
        $.ajax({
            type: "post",
            url: "insert.php",
            data: dataString,
            success: function (response) {
            }
        });
    };
    <!-- Delete box and data end -->

</script>
