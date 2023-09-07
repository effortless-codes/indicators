<?php

namespace Winata\Core\Indicator\Sessions;

interface SessionStoreInterface
{
    /**
     * Flash some data into the session.
     *
     * @param $name
     * @param $data
     */
    public function flash($name, $data);
}
