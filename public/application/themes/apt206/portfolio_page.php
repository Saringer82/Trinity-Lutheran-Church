<?php
defined('C5_EXECUTE') or die("Access Denied.");

$this->inc('elements/header.php');
?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12 col-md-2">
                            Back
                        </div>
                        <div class="col-xs-12 col-md-3 col-md-push-7">
                            <?php
                            $a = new Area('Sidebar');
                            $a->display($c);
                            ?>
                        </div>
                        <div class="col-xs-12 col-md-7 col-md-pull-3">
                            <?php
                            $a = new Area('Main');
                            $a->display($c);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php
//initialize the block
$next_prev = BlockType::getByHandle('next_previous');

//set your options
$next_prev->controller->orderBy = 'display_asc';
$next_prev->controller->loopSequence = true;
$next_prev->controller->excludeSystemPages = true;

//get the pages
$prev_page = $next_prev->controller->getPreviousCollection();
$next_page = $next_prev->controller->getNextCollection();

//get url's to the pages
$nh = Loader::helper('navigation');
$prev_url = $nh->getLinkToCollection($prev_page);
$next_url = $nh->getLinkToCollection($next_page);
?>

    <section class="next-article">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <a href="<?php echo $prev_url; ?>" class="btn btn-previous">Previous</a>
                    <a href="<?php echo $next_url; ?>" class="btn btn-next">Next</a>
                </div>
            </div>
        </div>
    </section>


<?php
$this->inc('elements/footer.php');
