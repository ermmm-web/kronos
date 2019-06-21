<?php

namespace Francysk\Framework\Decorator;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

class Files {

    private $uploadDir;

    public function __construct() {
        $this->uploadDir = \COption::GetOptionString("main", "upload_dir", "upload");
    }

    public function decorateElement($row) {
        $row["SRC"] = "/$this->uploadDir/" . $row["SUBDIR"] . "/" . $row["FILE_NAME"];
        return $row;
    }

}
