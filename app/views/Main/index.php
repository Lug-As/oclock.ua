<h4>Hello from <?= __FILE__; ?></h4>
<?php unset($data['posts']); ?>
<?php foreach ($posts as $post):?>
    <div class="post">
        <h3><?= $post['title']; ?></h3>
        <p><?= $post['description']; ?></p>
    </div>
<?php endforeach; ?>
<?php debug($data, "data"); ?>