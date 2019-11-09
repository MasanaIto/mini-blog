<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            <?php if (isset($title)): echo $this->escape($title) . ' - '; endif; ?>
            Mini Blog
        </title>
    </head>
    <body>

        <header>
            <h1><a href="<?php echo $base_url; ?>">Mini Blog</a></h1>
        </header>

        <main>
            <?php echo $_content; ?>
        </main>

    </body>
</html>
