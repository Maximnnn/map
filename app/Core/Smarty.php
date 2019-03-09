<?php

namespace App\Core;

class Smarty extends \Smarty
{

    public function __construct()
    {
        parent::__construct();

        $this->setTemplateDir(ROOT . '/templates/');
        $this->setCompileDir(ROOT . '/templates/templates_c/');
        $this->setCacheDir(ROOT . '/templates/cache/');
    }

    public function render($view, $data, $js = [], $pageData = [])
    {
        foreach ($data as $key => $value) {
            $this->assign($key, $value);
        }

        $this->assign('scripts', array_reduce($js, function($scripts, $script) {
            $scripts .= '<script src="' . $script . '"  async defer></script>';
            return $scripts;
        }, ''));

        $this->assign('pageData', json_encode($pageData));

        try {
            $content  = $this->fetch('header.tpl');
            $content .= $this->fetch($view . '.tpl');
            $content .= $this->fetch('footer.tpl');
        } catch (\Exception $e) {
            $content = $e->getMessage();
        }

        return $content;
    }

}