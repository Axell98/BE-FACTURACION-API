<?php

if (!function_exists('isSuperAdmin')) {
    function isSuperAdmin(): bool
    {
        return auth()->check() && auth()->user()->hasRole('super-admin');
    }
}

if (!function_exists('generateUsername')) {
    function generateUsername(string $fullName): string
    {
        $nameClean = strtolower(trim($fullName));
        $nameClean = iconv('UTF-8', 'ASCII//TRANSLIT', $nameClean);
        $partsName = preg_split('/\s+/', $nameClean, -1, PREG_SPLIT_NO_EMPTY);
        if (count($partsName) < 2) {
            return preg_replace('/[^a-z0-9]/', '', $fullName);
        }
        $nameInit = $partsName[0][0];
        $lastNameInit = $partsName[1];
        $userNameBase = $nameInit . $lastNameInit;
        $userNameFinal = preg_replace('/[^a-z0-9]/', '', $userNameBase);
        return $userNameFinal;
    }
}
