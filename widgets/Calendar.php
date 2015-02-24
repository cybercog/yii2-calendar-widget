<?php

namespace tm\widgets;

use yii\bootstrap\Widget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;

class Calendar extends Widget
{
    /**
     * @var array Additional config
     */
    public $config = [];

    /**
     * @var string Text for loading alert
     */
    public $loading = 'Loading...';

    /**
     * @var boolean If the plugin displays a Google Calendar.
     */
    public $googleCalendar = false;

    /**
     * @var string Hash of config options
     */
    private $_hashOptions;

    /**
     * @var string Name of the plugin
     */
    private $_pluginName = 'calendar';

    /**
     * Runs the widget.
     */
    public function run()
    {
        $this->registerClientScript();

        $this->options['data-plugin-name'] = $this->_pluginName;
        $this->options['data-plugin-options'] = $this->_hashOptions;

        Html::addCssClass($this->options, 'calendar');

        echo '<div id="container_' . $this->options['id'] . '">';
        echo Html::tag('div', '', $this->options);
        echo '</div>';
    }

    /**
     * Registers the needed JavaScript.
     */
    public function registerClientScript()
    {
        $options = $this->getClientOptions();
        $this->_hashOptions = $this->_pluginName . '_' . hash('crc32', serialize($options));
        $id = $this->options['id'];
        $view = $this->getView();
        $view->registerJs("var {$this->_hashOptions} = {$options};\nvar calendar_{$this->options['id']};", $view::POS_HEAD);
        $js = "calendar_{$this->options['id']} = jQuery(\"#{$id}\").calendar({$this->_hashOptions});";
        $asset = CalendarAsset::register($view);
        
        $view->registerJs($js);
    }

    /**
     * @return array the options for the text field
     */
    protected function getClientOptions()
    {
        $id = $this->options['id'];

        $options['loading'] = new JsExpression("function(isLoading, view ) {
                $('#container_{$id}').find('.fc-loading').toggle(isLoading);
        }");

        $options = array_merge($options, $this->config);
        return Json::encode($options);
    }
}
