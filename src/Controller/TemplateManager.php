<?php
namespace WCal\Controller;

class TemplateManager
{
    private $path_to_templates = __DIR__.'/../View/Templates';
    private $template;

    public function __construct()
    {
        $this->template = new \League\Plates\Engine($this->path_to_templates);
    }
    
    public function home(){
        echo $this->template->render('home');
    }
    
    public function about(){
        echo $this->template->render('about');
    }
    
    public function form(){
        echo $this->template->render('form');
    }
    
    public function data(){
        echo $this->template->render('data');
    }
    
    public function update($id){
        echo $this->template->render('form', ['id' => $id]);
    }
    
}
