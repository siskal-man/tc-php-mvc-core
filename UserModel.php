<?php

namespace tarum\phpmvc;

use tarum\phpmvc\db\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
}