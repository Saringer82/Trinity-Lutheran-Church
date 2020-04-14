<?php defined('C5_EXECUTE') or die("Access Denied.");

$this->inc('elements/header_top.php');

$as = new GlobalArea('Header Search');
$blocks = $as->getTotalBlocksInArea();
$displayThirdColumn = $blocks > 0 || $c->isEditMode();
?>

<header>
    <div class="container">
        <div class="col-xs-3 logo">
            <?php
            $a = new GlobalArea('Logo');
            $a->display();
            ?>
        </div>
        <div class="col-xs-9">
            <?php
            $a = new GlobalArea('Header Navigation');
            $a->display();
            ?>
        </div>

    </div>
</header>
