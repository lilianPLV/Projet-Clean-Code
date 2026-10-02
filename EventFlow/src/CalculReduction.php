<?php

interface CalculReduction {
    public function calcul(float $total) : float;
}
class CalculReductionVIP implements CalculReduction
{
    public function calcul(float $total) : float {
        if ($total < 100) { return $total*=0.95 ;}
        if ($total <299) { return $total*=0.9 ;}
        
        return $total*=0.85;
    }
}

class CalculReductionPassType implements CalculReduction
{
    public function calcul(float $total) : float {
        return $total-=20;
    }
}