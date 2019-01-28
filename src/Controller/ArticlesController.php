<?php
namespeace App\Contloler;

class ArticlesController extends AppController
{
  public function index()
    {
        $this->loadComponent('Paginator');
        $articles = $this->Paginator->paginate($this->Articles->find());
        $this->set(compact('articles'));
    }
}
