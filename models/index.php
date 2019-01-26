<?php

/**
 * This is the default model class for our theme.
 */
class Index extends \DustPress\Model {

    public function init() {
        $this->bind_sub("Header");
        $this->bind_sub("Footer");
    }

    /**
     * This returns the page set for frontpage.
     *
     * @return array|null|WP_Post
     */
    public function Page() {
        return get_post( get_the_ID() );
    }
}