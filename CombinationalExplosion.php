<?php

class Explode {

    private $x      = 0;
    private $y      = 0;
    private $size   = 0;
    private $dest   = 0;
    private $line = array();

    function __construct($arg) {
        $this->size = (int)$arg;
        $this->x = (int)$arg - 1;
        $this->y = (int)$arg - 1;
        for ($i = 0; $i < $this->size; $i++) {
            for ($j = 0; $j < $this->size; $j++) {
                $this->line[$i][$j] = 0;
            }
        }
    }
        
    function setGoOn($x, $y) {
        $this->line[$x][$y] = 1;
    }

    function walk($x, $y) {
        $this->line[$x][$y] = 1;
        if ($x == $this->x && $y == $this->y) {
            $this->dest++;
        } else {
            if ($x < $this->size -1 && $this->line[$x + 1][$y] === 0) {
                $this->walk($x + 1, $y);
            }
            if ($x > 0 && $y < $this->size -1 && $y != 0 && $this->line[$x - 1][$y] === 0) {
                $this->walk($x - 1, $y);
            }
            if ($y < $this->size - 1 && $this->line[$x][$y + 1] == 0) {
                $this->walk($x, $y + 1);
            }
            if ($y > 0 && $x > 0 && $x < $this->size - 1 && $this->line[$x][$y - 1] === 0) {
                $this->walk($x, $y - 1);
            }
        }
        $this->line[$x][$y] = 0;
    }

    function getCount() {
        return $this->dest;
    }
}  
$arg  = intval($argv[1]) + 1;
$oneisan = new Explode($arg);
$oneisan->setGoOn(0, 0);
$oneisan->walk(1, 0);
echo $oneisan->getCount() * 2;
