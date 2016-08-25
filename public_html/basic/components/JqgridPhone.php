<?php
namespace app\components;


use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use jqGridLoader;
use jqSimple;

require_once($_SERVER['DOCUMENT_ROOT'] . '/jqGrid/php/' . 'jqGridLoader.php');


class JqgridPhone extends Component
{
    protected function config()
    {
        $_CONFIG = array(
            'root_path' => $_SERVER['DOCUMENT_ROOT'] . '/jqGrid/php/',
            'componentGridPath' => dirname(__DIR__) . '/components/Jqgrid/',

            'encoding' => 'utf-8',
            'pdo_dsn' => 'mysql:dbname=yii_yii;localhost',
            'pdo_user' => 'yii_yii',
            'pdo_pass' => 'yii_yiioOpsAkXweD',
        );
        return $_CONFIG;
    }

    public function jqSimple()
    {
        //todo: брать из yii
        $_CONFIG = $this->config();

        $jq_loader = new jqGridLoader();

        $jq_loader->set('grid_path', $_CONFIG['componentGridPath']);

        $jq_loader->set('pdo_dsn', $_CONFIG['pdo_dsn']);
        $jq_loader->set('pdo_user', $_CONFIG['pdo_user']);
        $jq_loader->set('pdo_pass', $_CONFIG['pdo_pass']);

        $jq_loader->set('debug_output', false);


        $jq_loader->autorun();

//-----------
// Get grid
//-----------

        $grid = 'jqSimple';

        $rendered_grid = $jq_loader->render($grid);


        $js = "<script>
        {$rendered_grid}
        </script>";

        return $js;
    }
}