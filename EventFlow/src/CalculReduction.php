<?php

interface CalculReduction {
    
    public function calcul(float $total) : float;
}
class CalculReductionVIP implements CalculReduction
{
    public function __construct(
        private array $reduction,
        private array $stepReduction
    ) {}

    public function calcul(float $total) : float {
        if ($total < $this->stepReduction["FirstStepReduction"] ) 
            { 
                return $total*$this->reduction['TotalLowerThan100'] ;
            }

        if ($total <$this->stepReduction["SecondStepReduction"]) 
            { 
                return $total*=$this->reduction['TotalLowerThan300'] ;
            }
        
        return $total*=$this->reduction['TotalSuperiorThan300'];
    }
}

class CalculReductionPassType implements CalculReduction
{
    public function __construct(
        private array $reduction
    ) {}

    public function calcul(float $total) : float {
        return $total-=$this->reduction['Reduction20'];
    }
}

class CalculTotalReduction implements CalculReduction
{
    public function __construct(
        private array $reduction
    ) {}

    public function calcul(float $total) : float {
        if ($total > 0 ) { return $total ; }
        return 0;
    }
}