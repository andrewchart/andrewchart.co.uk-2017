<?php

    /**
     * map-svcs.php
     * 
     * Services to generate static images of a map
     * location based upon latitude and longitude.
     * 
     * Map tiles are cached using their DMS (degrees
     * minutes seconds notation with hyphens and underscores
     * replacing symbols e.g:
     * 
     * 41°24'12.2"N 2°10'26.5"E => `41-24-12.2-N_2-10-26.5-E`
     * )
     * 
     */

    class MapSvcs {

        /**
         * Fetches a map tile image from an API
         */
        private function create_map_img($map_path, $lat_lng) {

            define("API_BASE", "https://atlas.microsoft.com/map/static/png?");

            $secrets = parse_ini_file("map-svcs.ini");

            $params = array(
                "api-version" => "1.0",
                "style" => "dark",
                "zoom" => "12",
                'center' => $lat_lng[1] . "," . $lat_lng[0],
                "pins" => "default|sc1.8|al0.57|coFF2F00||" . $lat_lng[1] . " " . $lat_lng[0],
                "height" => "600",
                "width" => "600",
                "language" => "en-GB",
                "subscription-key" => $secrets['azure_maps_subscription_key']
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, API_BASE . http_build_query($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('x-ms-client-id: ' . $secrets['azure_maps_ms_client_id']));

            $out = curl_exec($ch);
            curl_close($ch);

            $fp = fopen($map_path, 'w');
            fwrite($fp, $out);
            fclose($fp);

        }

        /**
         * Converts a Lat/Lng from DMS arrays to decimal degrees
         */
        public static function exif_dms_to_decimal_degrees($lat_dms, $lat_ref, $lng_dms, $lng_ref) {
            
            if( !$lat_dms || !$lng_dms || !$lat_ref || !$lng_ref ) {
                return false;
            }

            $lat_deg = explode("/", $lat_dms[0]);
            $lat_min = explode("/", $lat_dms[1]);
            $lat_sec = explode("/", $lat_dms[2]);

            $lng_deg = explode("/", $lng_dms[0]);
            $lng_min = explode("/", $lng_dms[1]);
            $lng_sec = explode("/", $lng_dms[2]);

            $lat_dms_calcd = array(
                $lat_deg[0] / $lat_deg[1],
                $lat_min[0] / $lat_min[1],
                $lat_sec[0] / $lat_sec[1]
            );

            $lng_dms_calcd = array(
                $lng_deg[0] / $lng_deg[1],
                $lng_min[0] / $lng_min[1],
                $lng_sec[0] / $lng_sec[1]
            );

            $lat_decimal = $lat_dms_calcd[0] + $lat_dms_calcd[1]/60 + $lat_dms_calcd[2]/3600; 
            $lng_decimal = $lng_dms_calcd[0] + $lng_dms_calcd[1]/60 + $lng_dms_calcd[2]/3600;

            if($lat_ref === "S") { $lat_decimal *= -1; }
            if($lng_ref === "W") { $lng_decimal *= -1; }

            $lat_lng = array($lat_decimal, $lng_decimal);

            return $lat_lng;

        }

        /**
         * Determines the url of the requested map based upon the location 
         * of the wp uploads folder and the [lat, lng] of the map.
         */
        public static function get_map_url($wp_upload_dir, $lat_lng) {

            $map_dir_path = $wp_upload_dir['basedir'] . "/map-tiles/";
            $map_dir_url  = $wp_upload_dir['baseurl'] . "/map-tiles/";

            $dir_exists = is_dir($map_dir_path) || mkdir($map_dir_path);

            $map_filename = self::lat_lng_to_filename($lat_lng);
            $map_path = $map_dir_path . $map_filename;
            $map_url  = $map_dir_url  . $map_filename;

            if(!file_exists($map_path)) {
                self::create_map_img($map_path, $lat_lng);
            }

            return $map_url;

        }

        /**
         * Converts an array consisting of [lat, lng] in decimal degrees, to a
         * filename-friendly string.
         */
        private function lat_lng_to_filename($lat_lng) {
            $filename = $lat_lng[0] . "_" . $lat_lng[1] . ".png";
            return $filename;
        }

    }

?>