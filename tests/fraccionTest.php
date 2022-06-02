<?php

use PHPUnit\Framework\TestCase;

final class fraccionTest extends TestCase{
    public function testsumarFraccion(){
        $fracion1 = new fraccion(4,7);
        $fracion2 = new fraccion(2,7);
        $resultadoSuma1 = new fraccion(6,7);
        $this->assertEquals($fracion1->sumarFraccion($fracion2),$resultadoSuma1);

        $fracion3 = new fraccion(3,2);
        $fracion4 = new fraccion(7,3);
        $resultadoSuma2 = new fraccion(23,6);
        $this->assertEquals($fracion3->sumarFraccion($fracion4),$resultadoSuma2);
    }

    public function testrestarFraccion(){
        $fracion1 = new fraccion(4,7);
        $fracion2 = new fraccion(2,7);
        $resultadoSuma1 = new fraccion(2,7);
        $this->assertEquals($fracion1->restarFraccion($fracion2),$resultadoSuma1);

        $fracion3 = new fraccion(3,5);
        $fracion4 = new fraccion(2,4);
        $resultadoSuma2 = new fraccion(2,20);
        $this->assertEquals($fracion3->restarFraccion($fracion4),$resultadoSuma2);
    }

    public function testmultiplicarFraccion(){
        $fracion1 = new fraccion(3,2);
        $fracion2 = new fraccion(7,4);
        $resultadoSuma1 = new fraccion(21,8);
        $this->assertEquals($fracion1->multiplicarFraccion($fracion2),$resultadoSuma1);
    }

    public function testdividirFraccion(){
        $fracion1 = new fraccion(4,5);
        $fracion2 = new fraccion(3,9);
        $resultadoSuma1 = new fraccion(36,15);
        $this->assertEquals($fracion1->dividirFraccion($fracion2),$resultadoSuma1);
    }
}