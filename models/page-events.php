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
        'Query',
        'QueryAll'
    ];

    /**
     * Query all events for the Events page and for every tab.
     *
     * @return array|bool|WP_Query
     */
    public function Query() {
        $this->get_args();
        $tab_title = 'tab_title';
        $tab_name  = 'tab_name';
        $tab_query = 'data';

        $q1 = array(
            'params' => array(
                $tab_name  => 'all_events',
                $tab_title => 'All Events',
            ),
            $tab_query => $this->QueryAll(),
        );
        $q2 = array(
            'params' => array(
                $tab_name  => 'upcoming_events',
                $tab_title => 'Upcoming Events',
            ),
            $tab_query => $this->QueryUpcoming(),
        );

        return [$q1, $q2];
    }

    /**
     * Query ALL EVENTS for the Events page.
     *
     * @return array|bool|WP_Query
     */
    protected function QueryAll() {
        // echo var_dump( dustpress()->is_dustpress_ajax() );
        // if ( dustpress()->is_dustpress_ajax() ) {  // <--- This call is crashing the site for some reason..?
        //     $args = $this->get_args();
        //     return \DustPress\Query::get_acf_posts( $args );
        // }
        $query_args = [
            'post_type'                 => 'event',
            'no_found_rows'             => false,
            'meta_key'                  => 'date_from',
            'orderby'                   => 'meta_value',
        ];
        return \DustPress\Query::get_acf_posts( $query_args );
    }


    /**
     * Query UPCOMING EVENTS for the Events page.
     *
     * @return array|bool|WP_Query
     */
    protected function QueryUpcoming() {
        $today = date("Ymd");

        $query_args = [
            'post_type'      => 'event',
            'posts_per_page' => -1,
            'no_found_rows'  => false,
            'meta_query'     => array(
                'relation'   => 'OR',
                array(
                    'key'     => 'date_from',
                    'compare' => '>=',
                    'value'   => $today,
                ),
                array(
                    'key'     => 'date_until',
                    'compare' => '>=',
                    'value'   => $today,
                ),
            ),
            'meta_key'       => 'date_from',
            'orderby'        => 'meta_value',
            'order'          => 'ASC',
        ];
        return \DustPress\Query::get_acf_posts( $query_args );
    }
}
