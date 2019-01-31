<?php
// src/Controller/ArticlesController.php

namespace App\Controller;

class ArticlesController extends AppController
{
    public function initialize()
    {
      parent::initialize();

      $this->loadComponent('Paginator');
      $this->loadComponent('Flash');
    }
    public function index()
    {
        $articles = $this->Paginator->paginate($this->Articles->find());
        $this->set(compact('articles'));
    }
    public function view($slug = null)
    {
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        $this->set(compact('article'));
    }
    public function add()
    {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')){
          $article = $this->Articles->patchEntity($article, $this->request->getData());

          $article->user_id = 1;

          if ($this->Articles->save($article)){
            $this->Flash->success(__('記事を作成しました'));
            return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('記事を作成できませんでした')) ;
        }
        $tags = $this->Articles->Tags->find('list');
        $this->set('tags', $tags);
        $this->set('article',$article);
      }
      public function edit($slug)
      {
        $article = $this->Articles
        ->findBySlug($slug)
        ->contain('Tags') // 関連づけられた Tags を読み込む
        ->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
          $this->Articles->patchEntity($article, $this->request->getData());
          if ($this->Articles->save($article)) {
            $this->Flash->success(__('記事の変更を保存しました'));
          return $this->redirect(['action' => 'index']);
          }
        $this->Flash->error(__('記事の変更が保存できませんでした'));
        }
        // タグのリストを取得
        $tags = $this->Articles->Tags->find('list');

        // ビューコンテキストに tags をセット
        $this->set('tags', $tags);

        $this->set('article', $article);
      }
      public function delete($slug)
      {
        $this->request->allowMethod(['post','delete']);

        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        if ($this->Articles->delete($article)){
          $this->Flash->success(__('{0}の記事は削除されました',$article->title));
          return $this->redirect(['action' => 'index']);
        }
      }

    }
