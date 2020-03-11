<footer>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 footer-nav">
                        <?php
                        $a = new GlobalArea('Footer Site Navigation');
                        $a->display();
                        ?>
                    </div>
                    <div class="col-xs-3">
                        <?php
                        $a = new GlobalArea('Footer Social');
                        $a->display();
                        ?>
                    </div>
                    <div class="col-xs-3">
                        <?php
                        $a = new GlobalArea('Footer Social');
                        $a->display();
                        ?>
                    </div>
                </div>
            </div>
        </section>
</footer>

<?php $this->inc('elements/footer_bottom.php');?>
