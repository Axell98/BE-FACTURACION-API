<?php

namespace App\Enums;

enum DataSistemaEnum: string
{
    case TIPOS_COMPROBANTES = '001';
    case TIPOS_DOCUMENTOS_IDENTIDAD = '002';

    public function label(): string
    {
        return match ($this) {
            self::TIPOS_COMPROBANTES => 'tipos_comprobantes',
            self::TIPOS_DOCUMENTOS_IDENTIDAD => 'tipos_documentos_identidad',
        };
    }
}
