<?php

namespace Imerfanahmed\WpLogLens;

class WpLogLensClass
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'addAdminMenu']);
    }

}
