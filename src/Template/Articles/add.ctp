
<h1>記事の追加</ht>
  <?php
  echo $this->Form->create($article);
  echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => 1]);
  echo $this->Form->control('title');
  echo $this->Form->control('body', ['rows' => '3']);
  echo $this->Form->button(__('Save Article'));
  echo $this->Form->end();
  ?>