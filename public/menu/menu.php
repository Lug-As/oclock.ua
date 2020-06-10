<li>
    <h5><a href="category/<?= $category['alias']; ?>"><?= $category['title']; ?></a></h5>
    <?php if (isset($category['childs'])):?>
    <ul>
        <?= $this->getHtml($category['childs']); ?>

    </ul>
    <?php endif; ?>
</li>