<?php

if( !class_exists( 'Templates')) {
class Templates {
        public $linkID;

        function __construct($linkID){ $this->linkID = $linkID; }

        /*
        The function is set to only allow mysql calls to be driven
        from inside this class.
        */

        public function new_mysql($sql) {
                $result = $this->linkID->query($sql) or die($this->linkID->error.__LINE__);
                return $result;
        }

        public static function load_template($file,$result) {
                if (file_exists($file)) {
                        include "$file";
                } else {
                        include "templates/error.phtml";
                }

        }


	public function isMobile() {
		return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
	}


}
}
?>
