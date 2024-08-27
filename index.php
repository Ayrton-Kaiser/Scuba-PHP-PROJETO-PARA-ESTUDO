<?php

session_start();
include 'boot.php';

if (auth_user()) {
    auth_routes();
} else {
    guest_routes();
}
