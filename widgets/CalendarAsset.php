<?php
namespace tm\widgets;

use yii\web\AssetBundle;
use Yii;

class CalendarAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $depends = [];

    /**
     * @inheritdoc
     */
    public $js = ['jquery-ui.min.js', 'calendar.js'];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->css = ['calendar.css'];
        $this->sourcePath = __DIR__ . '/../assets';
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function registerAssetFiles($view)
    {
        parent::registerAssetFiles($view);
    }
}
