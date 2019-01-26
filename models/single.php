<?php

/**
 * This is the model for singular posts.
 */
class Single extends \DustPress\Model {

    public function init() {
        $this->bind_sub("Header");
        $this->bind_sub("Footer");
    }

    /**
     * This returns the current post
     *
     * @return array|null|WP_Post
     */
    public function Content() {
        $args = [
          'meta_keys' => null,
          'single'    => true
        ];
        
        return \DustPress\Query::get_acf_post( 25, $args );

        return get_post( get_the_ID() );
        return get_post( 1 );
    }
}