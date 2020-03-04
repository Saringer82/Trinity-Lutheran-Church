<?php
defined('C5_EXECUTE') or die("Access Denied.");

$c = Page::getCurrentPage();

/** @var \Concrete\Core\Utility\Service\Text $th */
$th = Core::make('helper/text');
/** @var \Concrete\Core\Localization\Service\Date $dh */
$dh = Core::make('helper/date');

$im = \Core::make('helper/image');

if ($c->isEditMode() && $controller->isBlockEmpty()) {
    ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Page List Block.') ?></div>
    <?php
} else {
    ?>

    <div class="ccm-block-page-list-wrapper overview">

            <?php
            $includeEntryText = false;
            if (
                (isset($includeName) && $includeName)
                ||
                (isset($includeDescription) && $includeDescription)
                ||
                (isset($useButtonForLink) && $useButtonForLink)
            ) {
                $includeEntryText = true;
            }
            foreach ($pages as $page) {
                // Prepare data for each page being listed...
                $buttonClasses = 'ccm-block-page-list-read-more';
                $entryClasses = 'ccm-block-page-list-page-entry';
                $title = $page->getCollectionName();
                $title = $th->shortenTextWord($title, 50);
                if ($page->getCollectionPointerExternalLink() != '') {
                    $url = $page->getCollectionPointerExternalLink();
                    if ($page->openCollectionPointerExternalLinkInNewWindow()) {
                        $target = '_blank';
                    }
                } else {
                    $url = $page->getCollectionLink();
                    $target = $page->getAttribute('nav_target');
                }
                $target = empty($target) ? '_self' : $target;
                $description = $page->getCollectionDescription();
                $description = $controller->truncateSummaries ? $th->wordSafeShortText($description,
                    $controller->truncateChars) : $description;
                $description = $th->shortenTextWord($description, 150);
                $thumbnail = false;

                //Custom date
                $customDate = $dh->formatCustom("d.m.y", $page->getCollectionDatePublic());

                if ($displayThumbnail) {
                    $thumbnail = $page->getAttribute('thumbnail');
                    if ($thumbnail && is_object($thumbnail)) {
                        $src = $thumbnail->getURL();
                        $alt = $thumbnail->getTitle();
                    } else {
                        $thumbnail = true;
                        $src = '';
                        $alt = '';
                    }
                }
                ?>

                <div class="overview-box" style="background-image: url('<?= $src; ?>')">
                    <a class="content" href="<?php echo h($url) ?>" target="<?php echo h($target) ?>">
                        <div class="card">

                                <div class="card-content">
                                    <div class="title"><?php echo h($title) ?></div>
                                    <div class="description hidden-xs hidden-sm"><?php echo h($description) ?></div>
                                </div>

                        </div>
                    </a>
                </div>

                <?php
            } ?>
            <?php if (count($pages) == 0) { ?>
                <div class="ccm-block-page-list-no-pages"><?php echo h($noResultsMessage) ?></div>
            <?php } ?>

    </div><!-- end .ccm-block-page-list-wrapper -->

    <?php
} ?>
