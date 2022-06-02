<?php

use PHPUnit\Framework\TestCase;

final class fraccionTest extends TestCase{
    public function testsumarFraccion(){
        $fracion1 = new fraccion(4,7);
        $fracion2 = new fraccion(2,7);
        $resultadoSuma = new fraccion(6,7);
        $this->assertEquals($fracion1->sumarFraccion($fracion2),$resultadoSuma);
    }
}