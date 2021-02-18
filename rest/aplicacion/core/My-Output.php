<?php
class MY_Output extends CI_Output {

    function _display_cache(&$CFG, &$URI)
    {
        /* Disable Globally */
        return FALSE;
        /* Call the parent function */
        return parent::_display_cache($CFG,$URI);
    }
    ?>