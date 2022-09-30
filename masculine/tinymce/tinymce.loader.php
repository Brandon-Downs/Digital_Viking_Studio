<?php

/*-----------------------------------------------------------------------------------*/
/*	Paths Defenitions
/*-----------------------------------------------------------------------------------*/

define('COL_TINYMCE_PATH', COL_FILEPATH . '/tinymce');
define('COL_TINYMCE_URI', COL_DIRECTORY . '/tinymce');


/*-----------------------------------------------------------------------------------*/
/*	Load TinyMCE dialog
/*-----------------------------------------------------------------------------------*/

require_once( COL_TINYMCE_PATH . '/tinymce.class.php' );		// TinyMCE wrapper class
new col_tinymce();											// do the magic

?>