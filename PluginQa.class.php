<?php

/**
 * Запрещаем напрямую через браузер обращение к этому файлу.
 */
if (!class_exists('Plugin')) {
    die('Hacking attemp!');
}

class PluginQa extends Plugin {

    // Объявление делегирований (нужны для того, чтобы назначить свои экшны и шаблоны)
    public $aDelegates = array(

    );

    // Объявление переопределений (модули, мапперы и сущности)
    protected $aInherits=array(
		'action' => array('ActionAjax'),
		'entity'  =>array('ModuleTopic_EntityTopic', 'ModuleComment_EntityComment'),

    );

    // Активация плагина
    public function Activate() {
        return true;
    }

    // Деактивация плагина
    public function Deactivate(){
        return true;
    }


    // Инициализация плагина
    public function Init() {
        $this->Viewer_AppendScript(Plugin::GetTemplateDir(__CLASS__)."assets/js/qa.js"); // Добавление своего JS
	}
}
?>
