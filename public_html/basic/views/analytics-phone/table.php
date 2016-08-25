<?php
use yii\helpers\Html;


//jQuery
$this->registerJsFile('/jqgrid/js/jquery/1.7.2/jquery.min.js', ['position' => \yii\web\View::POS_HEAD]);

//jQuery UI
$this->registerJsFile('/jqgrid/js/jquery-ui/1.8.11/jquery-ui.min.js',  ['position' => \yii\web\View::POS_HEAD]);
$this->registerCssFile('/jqgrid/js/jquery-ui/1.8.11/themes/redmond/jquery.ui.all.min.css');


$this->registerJsFile('/jqgrid/plugins/ui.multiselect.js',  ['position' => \yii\web\View::POS_HEAD]);
$this->registerCssFile('/jqgrid/plugins/ui.multiselect.css');

//jqGrid
$this->registerCssFile('/jqgrid/css/ui.jqgrid.css');
$this->registerJsFile('/jqgrid/js/i18n/grid.locale-en.js',  ['position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile('/jqgrid/js/jquery.jqGrid.min.js',  ['position' => \yii\web\View::POS_HEAD]);

//jqGrid Extension
$this->registerCssFile('/client/jqgrid-ext.css');
$this->registerJsFile('/client/jqgrid-ext.js',  ['position' => \yii\web\View::POS_HEAD]);

//Other plugins
$this->registerJsFile('/jqgrid/js/jquery/form/2.67/jquery.form.min.js',  ['position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile('/jqgrid/js/jquery/form/2.67/jquery.form.min.js',  ['position' => \yii\web\View::POS_HEAD]);

//range_picker
$this->registerJsFile('/jqgrid/range_picker/js/daterangepicker.jQuery.compressed.edit.js',  ['position' => \yii\web\View::POS_HEAD]);
$this->registerCssFile('/jqgrid/range_picker/css/ui.daterangepicker.css');

//Code highlighter
$this->registerJsFile('/jqgrid/highlightjs/6.0/highlight.min.js',  ['position' => \yii\web\View::POS_HEAD]);
$this->registerCssFile('/jqgrid/highlightjs/6.0/styles/vs.css');

?>


<link rel="icon" href="misc/favicon.png" type="image/png">

<script>

        $.extend($.jgrid.defaults,
            {
                hidegrid:false,
                hoverrows:false,

                ridview: true,
                viewrecords:true,
                scrollOffset:21,

                width:900,
                height:290
            });

        //$.jgrid.defaults.height = '400px';
        $.jgrid.nav.refreshtext = 'Обновить';
        $.jgrid.formatter.date.newformat = 'ISO8601Short';

        $.jgrid.edit.closeAfterEdit = true;
        $.jgrid.edit.closeAfterAdd = true;





</script>
<script>


    var dateRangePicker_onChange =  function dateRangePicker_onChange() {
        var $input = $('#gs_date_register');
        var old_val = $input.val();

        setTimeout(function () {
            if ($input.val() == old_val) {
                $grid[0].triggerToolbar();
            }
        }, 50);
    }


</script>
<style>
    <?php if(!isset($_REQUEST['iframe'])) : ?> body {background: #F5F5F5; font-size: 11px; padding: 10px;}<?php endif;?>
    #descr {
        display: none;
    }

    #descr_rus {
        display: none;
    }

    #accordion UL {
        padding: 0;
        margin: 0;
        list-style-type: circle;
    }

    #accordion UL A {
        text-decoration: none;
        font-size: 11px;
    }

    #accordion UL A:hover {
        text-decoration: underline;
    }

    #accordion UL LI.active {
        list-style-type: disc;
    }

    .ui-widget {
        font-family: verdana;
        font-size: 12px;
    }

    .ui-jqgrid {
        font-family: tahoma, arial;
    }

    .ui-jqgrid TR.jqgrow TD {
        font-size: 11px;
    }

    .ui-jqgrid TR.jqgrow TD {
        padding-left: 5px;
        padding-right: 5px;
    }

    .ui-jqgrid TR.jqgrow A {
        color: blue;
    }

    .ui-jqgrid INPUT,
    .ui-jqgrid SELECT,
    .ui-jqgrid TEXTAREA,
    .ui-jqgrid BUTTON {
        font-family: tahoma, arial;
    }
</style>
<h1 style="text-align: center;width: 100%;"> Статистика телефоных звонков</h1>

<?= $rendered_grid ?>





