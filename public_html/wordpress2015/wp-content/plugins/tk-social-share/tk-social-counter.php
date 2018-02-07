<?php
/**
 * Social Counter Class
 *
 * Counts number of shares for each social network
 */

class TK_Social_Counter {

    public $cache_hrs = 7200; // Two hours

    /**
     * Return total share count
     */
    public function tkss_total_sharing_count () {
        $fbcount  = $this->tkss_facebook_count();
        $twcount  = $this->tkss_twitter_count();
        $glcount  = $this->tkss_google_count();
        $pincount = $this->tkss_pinterest_count();
        $sucount  = $this->tkss_stumbleupon_count();
        $cliount  = $this->tkss_linkedin_count();
        $rdcount  = $this->tkss_reddit_count();

        return $fbcount + $twcount + $glcount + $pincount + $sucount + $cliount + $rdcount;
    }

    /**
     * Return sharing count for every social network
     * @param  [String] $sharing_icon [Name of the Social Network]
     * @return [int]               [Number of shares]
     */
    public function tkss_sharing_count( $sharing_icon ) {
        switch ( $sharing_icon ) {
            case 'facebook':
                return $this->tkss_facebook_count();
                break;
            case 'twitter':
                return $this->tkss_twitter_count();
                break;
            case 'google':
                return $this->tkss_google_count();
                break;
            case 'pinterest':
                return $this->tkss_pinterest_count();
                break;
            case 'stumbleupon':
                return $this->tkss_stumbleupon_count();
                break;
            case 'linkedin':
                return $this->tkss_linkedin_count();
                break;
            case 'reddit':
                return $this->tkss_reddit_count();
                break;
        }
    }

	/**
	 * Counts Facebook shares
	 * @return int Number of shares
	 */
	public function tkss_facebook_count() {
        if ( false === get_transient( get_the_ID() . '_fb_share_count' ) ) {
    		$url_fb  = "http://api.facebook.com/restserver.php?method=links.getStats&urls=" . get_permalink();
    		$data_fb = simplexml_load_file( $url_fb );
    		$shares  = 0;

            if ( isset( $data_fb->link_stat->share_count ) ) {
                $shares += $data_fb->link_stat->share_count;
            }

            // Cache count value for two hours
            set_transient( get_the_ID() . '_fb_share_count', $shares, $this->cache_hrs );
        }
        else {
            $shares = get_transient( get_the_ID() . '_fb_share_count' );
        }
        return $shares;
	}

	/**
	 * Counts Twitter shares
	 * @return int Number of shares
	 */
	public function tkss_twitter_count() {

        /*if ( false === get_transient( get_the_ID() . '_tw_share_count' ) ) {
    		$url_tw  = "http://urls.api.twitter.com/1/urls/count.json?url=" . get_permalink();
    		$data_tw = json_decode( file_get_contents( $url_tw ) );
    		$shares  = 0;

            if ( isset( $data_tw->count ) ) {
                $shares = $shares + $data_tw->count;
            }

            // Cache count value for two hours
            set_transient( get_the_ID() . '_tw_share_count', $shares, $this->cache_hrs );
        }
        else {
            $shares = get_transient( get_the_ID() . '_tw_share_count' );
        }
        return $shares;*/

        return 0;
    }

    /**
	 * Counts Google Plus shares
	 * @return int Number of shares
	 */
    public function tkss_google_count() {
        if ( false === get_transient( get_the_ID() . '_gl_share_count' ) ) {
        	$curl = curl_init();
            curl_setopt( $curl, CURLOPT_URL, "https://clients6.google.com/rpc" );
            curl_setopt( $curl, CURLOPT_POST, 1 );
            curl_setopt( $curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . get_permalink() . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]' );
            curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
            @curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, true );
            @curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, 1 );
            curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-type: application/json' ) );
            $curl_results = curl_exec( $curl );
            curl_close ( $curl );

            $json   = json_decode( $curl_results, true );
            $shares = intval( $json[0]['result']['metadata']['globalCounts']['count'] );

            // Cache count value for two hours
            set_transient( get_the_ID() . '_gl_share_count', $shares, $this->cache_hrs );
        }
        else {
            $shares = get_transient( get_the_ID() . '_gl_share_count' );
        }

        return $shares;
    }

    /**
	 * Counts LinkedIn shares
	 * @return int Number of shares
	 */
    public function tkss_linkedin_count() {
        if ( false === get_transient( get_the_ID() . '_li_share_count' ) ) {
    		$url_ln  = "http://www.linkedin.com/countserv/count/share?url=" . get_permalink() . "&format=json";
    		$data_ln = json_decode( file_get_contents( $url_ln ) );
    		$shares  = 0;
            if ( isset( $data_ln->count ) ) {
                $shares += $data_ln->count;
            }

            // Cache count value for two hours
            set_transient( get_the_ID() . '_li_share_count', $shares, $this->cache_hrs );
        }
        else {
            $shares = get_transient( get_the_ID() . '_li_share_count' );
        }

        return $shares;
    }

    /**
     * Counts Pinterest shares
     * @return int Number of shares
     */
    public function tkss_pinterest_count() {
        if ( false === get_transient( get_the_ID() . '_pin_share_count' ) ) {
            $url_ln  = "https://api.pinterest.com/v1/urls/count.json?callback=jsonp&url=" . get_permalink();
            $data_ln = json_decode( file_get_contents( $url_ln ) );
            $shares  = 0;
            if ( isset( $data_ln->count ) ) {
                $shares += $data_ln->count;
            }

            // Cache count value for two hours
            set_transient( get_the_ID() . '_pin_share_count', $shares, $this->cache_hrs );
        }
        else {
            $shares = get_transient( get_the_ID() . '_pin_share_count' );
        }

        return $shares;
    }

    /**
     * Counts StumbleUpon shares
     * @return int Number of shares
     */
    public function tkss_stumbleupon_count() {
        if ( false === get_transient( get_the_ID() . '_su_share_count' ) ) {
            $url = 'http://www.stumbleupon.com/services/1.01/badge.getinfo?url=' . get_permalink();
            $ch  = curl_init();

            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'] );
            curl_setopt( $ch, CURLOPT_FAILONERROR, 1);
            @curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
            @curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER,1 );
            curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );

            $cont = curl_exec( $ch );
            $json = json_decode( $cont, true );

            $shares = isset( $json['result']['views'] ) ? intval( $json['result']['views'] ) : 0;

            // Cache count value for two hours
            set_transient( get_the_ID() . '_su_share_count', $shares, $this->cache_hrs );
        }
        else {
            $shares = get_transient( get_the_ID() . '_su_share_count' );
        }

        return $shares;
    }

    /**
     * Counts Reddit shares
     * @return int Number of shares
     */
    public function tkss_reddit_count() {
        if ( false === get_transient( get_the_ID() . '_rd_share_count' ) ) {
            $url   = 'http://www.reddit.com/api/info.json?url='. get_permalink();
            $score = 0; //initialize
            $ch    = curl_init();

            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'] );
            curl_setopt( $ch, CURLOPT_FAILONERROR, 1);
            @curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
            @curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER,1 );
            curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );

            $cont = curl_exec( $ch );
            $json = json_decode( $cont, true );

            if ( is_array( $json ) ) {
                foreach( $json['data']['children'] as $child ) { // we want all children for this example
                    $score+= (int) $child['data']['score']; //if you just want to grab the score directly
                }
            }
            $shares = $score;

            // Cache count value for two hours
            set_transient( get_the_ID() . '_rd_share_count', $shares, $this->cache_hrs );
        }
        else {
            $shares = get_transient( get_the_ID() . '_rd_share_count' );
        }

        return $shares;
    }

}

