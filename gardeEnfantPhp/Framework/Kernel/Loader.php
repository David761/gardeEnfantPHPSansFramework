
<?php


class Loader
{
    public function library($library)
    {
        include LIB_PATH . "$library.php";
    }

}