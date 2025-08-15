<?php

if (!function_exists('is_super_admin')) {
    function is_super_admin(): bool
    {
        return auth()->check() && auth()->user()->hasRole('super-admin');
    }
}