<?php
defined('C5_EXECUTE') or die("Access Denied.");

$this->inc('elements/header.php');
?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-content">
                    <?php
                    $a = new Area('Main');
                    $a->display($c);
                    ?>
                </div>
            </div>
        </div>
    </main>

<?php
$this->inc('elements/footer.php');
