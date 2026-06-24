<?php

namespace App\Arknox;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Arknox\ArknoxBuilder table(string $table)
 * @method static array                       select(string $sql, array $bindings = [])
 * @method static bool                        statement(string $sql, array $bindings = [])
 * @method static int                         affectingStatement(string $sql, array $bindings = [])
 * @method static int                         lastInsertId()
 *
 * @see \App\Arknox\ArknoxDb
 */
class ArknoxFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'arknox';
    }
}
