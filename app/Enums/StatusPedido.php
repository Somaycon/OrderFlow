<?php

namespace App\Enums;

enum StatusPedido: string
{
    case PENDENTE = "pendente";
    case EM_PROCESSAMENTO = "em_processamento";
    case CONFIRMADO = "confirmado";
    case ENVIADO = "enviado";
    case ENTREGUE = "entregue";
    case CANCELADO = "cancelado";
}
