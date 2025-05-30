<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 7/10/2015
 * Time: 3:59 PM
 */
namespace sccbakery\Http\Presenters;

use Illuminate\Pagination\BootstrapThreePresenter;

class PaginationPresenter extends BootstrapThreePresenter {

    public function render() {
        if($this->hasPages()) {
            return sprintf(
                '<ul class="own-pagination">%s %s %s</ul>',
                $this->getPreviousButton(),
                $this->getLinks(),
                $this->getNextButton()
            );
        }
    }
}