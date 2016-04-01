<!DOCTYPE html>
<html>
<head>
    <title>jQuery MiniColors</title>
    <meta charset="utf-8">



    <!-- Bootstrap 3 -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="jquery.minicolors.css">


    <!-- MiniColors -->

    <!-- jQuery -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.0/jquery-ui.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/3.5.0/lodash.min.js"></script>
    <script src="../dist/gridstack.js"></script>
    <script src="jquery.minicolors.js"></script>


    <script>
        $(document).ready( function() {


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



        });
    </script>
</head>
<body>
<div class="row" style="margin: 40px 40px;">
    <div class="col-12">

        <!-- Intro -->

        <!-- Contents -->
        <h2 id="contents">Contents</h2>


        <!-- Demos -->

        <!-- Control types -->
        <h3>Control Types</h3>
        <div class="well">
            <div class="row">
                <div class="col-lg-4 col-sm-4 col-12">

                    <div class="form-group">
                        <label for="hue-demo">Hue (default)</label>
                        <input type="text" id="hue-demo" class="form-control demo" data-control="hue" value="#ff6161">
                    </div>

            </div>
        </div>
        </div>
</div>
</div>
</body>
</html>