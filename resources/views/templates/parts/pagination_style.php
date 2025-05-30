<?php
    $presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);
    $trans = $environment->getTranslator();
?>
<?php if ($paginator->getLastPage() > 1): ?>
    <ul class="own-pagination">
        <?php
            echo $presenter->getPrevious($trans->trans('pagination.previous'));
            echo $presenter->getPageRange(1, $paginator->getLastPage() );
            echo $presenter->getNext($trans->trans('pagination.next'));
        ?>
    </ul>
<?php endif; ?>