<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

//jQuery
$this->registerJsFile('/jqgrid/js/jquery/1.7.2/jquery.min.js', ['position' => \yii\web\View::POS_HEAD]);

//jQuery UI
$this->registerJsFile('/jqgrid/js/jquery-ui/1.8.11/jquery-ui.min.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerCssFile('/jqgrid/js/jquery-ui/1.8.11/themes/redmond/jquery.ui.all.min.css');


$this->registerJsFile('/jqgrid/plugins/ui.multiselect.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerCssFile('/jqgrid/plugins/ui.multiselect.css');

//jqGrid
$this->registerCssFile('/jqgrid/css/ui.jqgrid.css');
$this->registerJsFile('/jqgrid/js/i18n/grid.locale-en.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile('/jqgrid/js/jquery.jqGrid.min.js', ['position' => \yii\web\View::POS_HEAD]);

//jqGrid Extension
$this->registerCssFile('/client/jqgrid-ext.css');
$this->registerJsFile('/client/jqgrid-ext.js', ['position' => \yii\web\View::POS_HEAD]);

//Other plugins
$this->registerJsFile('/jqgrid/js/jquery/form/2.67/jquery.form.min.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile('/jqgrid/js/jquery/form/2.67/jquery.form.min.js', ['position' => \yii\web\View::POS_HEAD]);

//range_picker
$this->registerJsFile('/jqgrid/range_picker/js/daterangepicker.jQuery.compressed.edit.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerCssFile('/jqgrid/range_picker/css/ui.daterangepicker.css');

//Code highlighter
$this->registerJsFile('/jqgrid/highlightjs/6.0/highlight.min.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerCssFile('/jqgrid/highlightjs/6.0/styles/vs.css');

// JS
$this->registerJsFile('/basic/web/js/analytics-phone/index.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('/basic/web/css/analytics-phone/index.css');



?>


<link rel="icon" href="misc/favicon.png" type="image/png">

<script>

    $.extend($.jgrid.defaults,
        {
            hidegrid: false,
            hoverrows: false,

            ridview: true,
            viewrecords: true,
            scrollOffset: 21,

            width: 900,
            height: 290
        });

    //$.jgrid.defaults.height = '400px';
    $.jgrid.nav.refreshtext = 'Обновить';
    $.jgrid.formatter.date.newformat = 'ISO8601Short';

    $.jgrid.edit.closeAfterEdit = true;
    $.jgrid.edit.closeAfterAdd = true;


</script>
<script>


    var dateRangePicker_onChange = function dateRangePicker_onChange() {
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
    <?php if(!isset($_REQUEST['iframe'])) : ?>
    body {
        background: #F5F5F5;
        font-size: 11px;
        padding: 10px;
    }

    <?php endif;?>
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

<h1>Статистика телефоных звонков</h1>

<div class="tabs">
    <ul class="sub-menu-phone">
        <li>Список звонков</li>
        <li>Общяя статистика</li>
        <li>Описание</li>
        <li>Управление данными</li>
    </ul>
    <div>
        <!-- Первое содержимое-->
        <div>
            <ul>
                <?= $rendered_grid ?>
            </ul>
        </div>
        <div>
            <!-- Второе содержимое-->
            <ul>
                <li> Количество звонков: <?=$stats['total_calls']?></li>
                <li> Количество входящих звонков: <?=$stats['total_in_calls']?></li>
                <li> Количество исходящих звонков: <?=$stats['total_out_calls']?></li>
                <li> Средняя продолжительность звонка: <?=$stats['avg_duration_calls']?></li>
                <li> Найбільш часто вживаний Номер Б: <?php foreach($stats['max_numbers_b'] as $number_b):?>
                        <?php if(count($stats['max_numbers_b']) > 1):?>
                            <br/>
                        <?php endif;?>
                    <?=$number_b?>
                    <?php endforeach;?>
                </li>
            </ul>
        </div>
        <div>
            <!--Третье содержимое-->
            <br/>
            Веб-додаток статистики телефонних дзвінків.<br><br> **Інструменти**<br><br> Використовувати будь-який з
            трьох PHP-фреймворків Yii2, Symfony ,<br> Laravel, MySQL. Можна використовувати<br> jQuery або будь-який
            JS-фреймворк.<br><br> **Початкові дані**<br><br> Таблиця телефонних дзвінків<br><br> Список полів:<br> -
            Номер А<br> - Номер Б<br> - Дата початку<br> - Дата з'єднання<br> - Дата завершення<br> - Напрямок (вхідний,
            вихідний)<br> - Коментар до дзвінка<br><br> приклад:<br> 380441234567<br> 380501234567<br> 2016-01-01
            12:00:11<br> 2016-01-01 12:01:11<br> 2016-01-01 12:04:11<br> 1<br> "Тестове поле"<br><br> Потрібно
            згенерувати дзвінки в кількості 10000 штук, дата початку<br> дзвінка повинна бути будь-якої дати 2016 року,
            з тривалістю розмови до<br> 30 хв, інші поля випадковим чином.<br><br> **Функціонал веб-додатку**<br><br> 1.
            Список дзвінків у вигляді таблиці з можливістю фільтрації по полям<br> (Номер А, Номер Б, Дата початку
            діапазон ВІД-ДО, Напрямок). Мати<br> можливість записати коментар до дзвінка.<br><br> 2. Окремий пункт меню
            "Загальна статистика" за вибраний період<br><br> 1. Кількість дзвінків<br> 2. Кількість вхідних дзвінків<br>
            3. Кількість вихідних дзвінків<br> 4. Середня тривалість дзвінка<br> 5. Максимальна тривалість дзвінка<br>
            6. Найбільш часто вживаний Номер Б

        </div>
        <div>
            <!--4 содержимое-->
            <br/>
            <ul>
                <li><a href="/basic/web/analytics-phone/create">Создание 10 000 записей в таблице 'analytics_phone'</a>
                </li>
                <li><a href="/basic/web/analytics-phone/delete">Удаление всех записей из таблицы 'analytics_phone'</a>
                </li>
            </ul>


        </div>
    </div>
</div>



