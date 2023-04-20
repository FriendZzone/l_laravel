<?php

use App\Models\Groups;

function helloWorld() {
    echo "Hello world!";
}

function getAllGroups () {
    $groups = new Groups();
    return $groups->getAll();
}
