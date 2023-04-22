<?php

namespace Tests\Feature;

use App\src\Core\Command;
use Tests\TestCase;

class CommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testDadoQueEuTenhaRulesDeveRetornarArray()
    {
        $mock = new mock();

        self::assertIsArray($mock->rules());
    }
}

class mock extends Command
{
}
