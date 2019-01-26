<?php
/**
 * Template Name: Events
 *
 * This template needs a page to function!
 */

/**
 * Class Archive
 */
class PageEvents extends MiddleModel {

    /**
     * Enable DustPress.js usage
     *
     * @var array
     */
    protected $api = [
        'Query'
    ];
    
    /**
     * Query posts for the archive page.
     * This function also handles pagination.
     *
     * @return array|bool|WP_Query
     */
    public function Query() {
        $args = $this->get_args();

        $per_page   = (int) get_option( 'posts_per_page' );
        $page       = isset( $args['page'] ) ? $args['page'] : 1;
        $offset     = ( $page - 1 ) * $per_page;

        $query_args = [
            'post_type'                 => 'event',
            'posts_per_page'            => $per_page,
            'offset'                    => $offset,
            'update_post_meta_cache'    => false,
            'update_post_term_cache'    => false,
            'no_found_rows'             => false,
            'query_object'              => false,
            'whole_fields'              => true,
            'max_recursion_level'       => $per_page,
        ];

        // This returns a WP_Query like object.
        // Queried posts are accessible in dust under the 'Query' key.
        return \DustPress\Query::get_acf_posts( $query_args );
    }
}
