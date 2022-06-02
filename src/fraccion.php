<?php

/**
 * Clase fraccion, incluye metodos de suma, resta, multiplicación y division de fracciones
 */
class fraccion{
    private int $numerador;
    private int $denominador;

    /**
     * Crea un objeto fraccion
     *
     * @param int $numerador
     * Numerador de la fracción
     * @param int $denominador
     * Denominador de la fracción
     * @return void
     */
    public function __constructor(int $numerador, int $denominador){
        $this->setNumerador($numerador);
        $this->setDenominador($denominador);
    }

    public function getNumerador():int{
        return $this->numerador;
    }

    public function getDenominador():int{
        return $this->denominador;
    }

    public function setNumerador(int $numerador){
        $this->numerador = $numerador;
    }

    public function setDenominador(int $denominador){
        $this->denominador = $denominador;
    }

    /**
     * Suma la fracción pasada por parametro a la funcion pasada por $this
     *
     * @param fraccion $sumando
     * Fracción a sumar
     * @param bool $reducirResultado
     * Por defecto es false, al ser true reduce la fraccion resultado de la suma
     * @return fraccion
     */
    public function sumarFraccion(fraccion $sumando, bool $reducirResultado=false):fraccion{
        if($this->mismoDenominador($sumando)){
            return new fraccion($this->sumaNumerador($sumando), $this->getDenominador());
        }
        return self::reducirResultado($reducirResultado,$this->sumaFraccioneDistintoDenominador());
    }

    /**
     * Logica interna para la suma de fracciones de distinto denominador
     *
     * @param fraccion $sumando
     * @return fraccion
     */
    private function sumaFraccioneDistintoDenominador(fraccion $sumando):fraccion{
        $numerador = $this->numeradorPorDenominador($sumando) + $sumando->numeradorPorDenominador($this);
        $denominador =  $this->denominadorPorDenominador($sumando);
        return new fraccion($numerador, $denominador);
    }

    /**
     * Resta la fracción pasada por parametro a la funcion pasada por $this
     *
     * @param fraccion $restando
     * Fracción a restar
     * @param bool $reducirResultado
     * Por defecto es false, al ser true reduce la fraccion resultado de la resta
     * @return fraccion
     */
    public function restarFraccion(fraccion $restando, bool $reducirResultado=false):fraccion{
        if($this->mismoDenominador($restando)){
            return new fraccion($this->restaNumerador($restando), $this->getDenominador());
        }
        return self::reducirResultado($reducirResultado,$this->restaFraccioneDistintoDenominador());
    }


    /**
     * Logica interna para la resta de fracciones de distinto denominador
     *
     * @param fraccion $sumando
     * @return fraccion
     */
    private function restaFraccioneDistintoDenominador(fraccion $restando):fraccion{
        $numerador = $this->numeradorPorDenominador($restando) - $restando->numeradorPorDenominador($this);
        $denominador =  $this->denominadorPorDenominador($restando);
        return new fraccion($numerador, $denominador);
    }

    /**
     * Multiplica la fracción pasada por parametro a la funcion pasada por $this
     *
     * @param fraccion $factor
     * Fracción a multiplicar
     * @param bool $reducirResultado
     * Por defecto es false, al ser true reduce la fraccion resultado de la multiplicacion
     * @return fraccion
     */
    public function multiplicarFraccion(fraccion $factor, bool $reducirResultado=false):fraccion{
        $newNumerador = $this->getNumerador() *  $factor->getNumerador();
        $newDenominador = $this->getDenominador() *  $factor->getDenominador();
        return self::reducirResultado($reducirResultado,new fraccion($newNumerador,$newDenominador));
    }

    /**
     * Divide la fracción pasada por $this a la funcion pasada por parametro
     *
     * @param fraccion $consciente
     * Fracción con la que dividir
     * @param bool $reducirResultado
     * Por defecto es false, al ser true reduce la fraccion resultado de la division
     * @return fraccion
     */
    public function dividirFraccion(fraccion $consciente, bool $reducirResultado=false):fraccion{
        $newNumerador = $this->getNumerador() *  $consciente->getDenominador();
        $newDenominador = $consciente->getNumerador() *  $this->getDenominador();
        return self::reducirResultado($reducirResultado,new fraccion($newNumerador,$newDenominador));
    }

    /**
     * Reduce la fracción pasada
     *
     * @param bool $sobreEscribir
     * Por defecto es falso y genera una nueva fracción, al ser true sobreescribe la fancion pasada por $this
     * @return fraccion
     */
    public function reducirFraccion(bool $sobreEscribir=false):fraccion{
        $divisor = maximoComunDivisor($this->getNumerador(),$this->getDenominador());
        $newNumerador = $this->getNumerador()/$divisor;
        $newDenominador = $this->getDenominador()/$divisor;
        if(!$sobreEscribir){
            return new fraccion($newNumerador, $newDenominador);
        }
        $this->setNumerador($numerador);
        $this->setDenominador($denominador);  
    }

    /**
     * Realiza el maximo comun divisor de los numeros pasador por parametro
     *
     * @param int $num1
     * @param int $num2
     * @return integer
     */
    static public function maximoComunDivisor(int $num1, int $num2):int{
        return gmp_gcd($num1,$num2);
    }

    /**
     * Obtiene los divisores de un numero pasado por parametro
     *
     * @param int $numero
     * @return array
     */
    private static function divisores(int $numero):array{
        $divisores=[];
        for($n=1;$n<$numero;$n++){
            if($numero%$n==0)array_push($divisores, $n);
        }
        return $divisores;
    }

    /**
     * Suma los numeradores de la fraccion $this y la pasada por parametro
     *
     * @param fraccion $sumando
     * Fraccion cuyo numerador sumar
     * @return int
     */
    private function sumaNumerador(fraccion $sumando):int{
        return $this->getNumerador() + $sumando->getNumerador();
    }


    /**
     * Resta al numerador $this el numerador de la fraccion pasada por parametro
     *
     * @param fraccion $sumando
     * Fraccion cuyo numerador restar
     * @return int
     */
    private function restaNumerador(fraccion $restando):int{
        return $this->getNumerador() + $restando->getNumerador();
    }

    /**
     * Multiplica los numeradores de la fraccion $this y la pasada por parametro
     *
     * @param fraccion $sumando
     * Fraccion cuyo numerador multiplicar
     * @return int
     */
    private function numeradorPorNumerador(fraccion $fraccionNumerador):int{
        return $this->getNumerador() * $fracciónDenominador->getNumerador();
    }

    /**
     * Multiplica los numeradores de la fraccion $this y el denominador de la pasada por parametro
     *
     * @param fraccion $sumando
     * Fraccion cuyo denominador multiplicar
     * @return int
     */
    private function numeradorPorDenominador(fraccion $fracciónDenominador):int{
        return $this->getNumerador() * $fracciónDenominador->getDenominador();
    }

    /**
     * Multiplica los denominadores de la fraccion $this y la pasada por parametro
     *
     * @param fraccion $sumando
     * Fraccion cuyo denominador multiplicar
     * @return int
     */
    private function denominadorPorDenominador(fraccion $fracciónDenominador):int{
        return $this->getDenominador() * $fracciónDenominador->getDenominador();
    }

    /**
     * Comprueba si la fraccion $this y la pasada por parametro tienen el mismo denominador
     *
     * @param fraccion $comparativa
     * Fraccion con la que comparar denominadores
     * @return bool
     */
    private function mismoDenominador(fraccion $comparativa):bool{
        return $this->getDenominador() == $comparativa->getDenominador();
    }

    /**
     * Logica interna para reducir resultados de operaciones con fracciones
     *
     * @param bool $reducir
     * @param fracion $fraccion
     * @return fracion 
     */
    private static function reducirResultado(bool $reducir, fracion $fraccion):fracion{
        return $reducir?reducirFraccion($fraccion):$fraccion;
    }
}