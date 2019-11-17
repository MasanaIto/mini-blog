<ul class="error_log">
    <?php foreach($errors as $error): ?>
    <li><?php echo $this->escape($error); ?></li>
    <?php endforeach; ?>
</ul>