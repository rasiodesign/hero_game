<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use War\Magic;

final class MagicTest extends TestCase
{
    public function testStartBattleWithEmptyValues(): void
    {
        $this->assertInstanceOf(
            Magic::class,
            Magic::class
        );
    }
}





