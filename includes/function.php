<?php
    function getHeader(array $data, string $currentPage) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Ptis Cms</title>
            <link href="../public/boostrap/css/bootstrap.css" rel="stylesheet">
        </head>
        <body role="document">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">PETIT CMS<a>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <?php
                                    foreach ($data as $key => $value) {
                                        getNavLink($key, $value, $currentPage);
                                    }
                                ?>
                            </ul>
                        </div>
            </nav>
        <?php
    }

    function getNavLink(string $key, array $value, string $currentPage) {
            $classActive = "";
            if ($key === $currentPage) {
                $classActive = "class=active";
            }
        ?>
        <li <?=$classActive?>>
            <!--index.php?page=cdm-->
            <a class="nav-link" href="<?=APP_URL?>?<?=APP_PARAM_PAGE?>=<?=$key?>"><?=$value['title']?></a>
        </li>
        <?php
    }

    function getPage(array $dataPage) {
        ?>
        <div class="container theme-showcase" role="main">
            <div class="jumbotron">
                <h1><?=$dataPage['title']?></h1>
                <p><?=$dataPage['description']?></p>
                <span class="label btn btn-<?=$dataPage['span-label']?>"><?=$dataPage['span-text']?></span>
            </div>
            <img class="img-thumbnail" alt="<?=$dataPage['img-alt']?>" src="../public/img/<?=$dataPage['img']?>" data-holder-rendered="true">
            <p><?=$dataPage['date']?></p>
        </div>
        </div>
        <?php
    }

    function getData(PDO $pdo , string $currentPage): ?array {
        $sql = "
            SELECT
                title,
                img,
                `img-alt`,
                `span-text`,
                `span-label`,
                description
            FROM
                page
            WHERE 
                slug = :slug   
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":slug", $currentPage);
        $stmt->execute();
        errorHandler($stmt);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        return $data;
    }

    function getFooter() {
        ?>
        </body>
        </html>
        <?php
    }

    function errorHandler(PDOStatement $stmt) {
        if ($stmt->errorCode() !== '00000') {
            throw new PDOException($stmt->errorInfo()[2]);
        }
    }