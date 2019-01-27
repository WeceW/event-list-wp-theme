<?php

/**
 * A middle model is used to wrap redundant data binding.
 */

class MiddleModel extends \DustPress\Model {

    public function Submodules() {
        $this->bind_sub('Header');
        $this->bind_sub('Footer');
    }
}
