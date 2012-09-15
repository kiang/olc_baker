<?php

class shape_point
{
    public function shape_point( $x, $y )
    {
        $this->x = $x;
        $this->y = $y;
    }
}

class shape
{
    public function shape( $colour )
    {
        $this->type		= "shape";
        $this->colour	= $colour;
        $this->values	= array();
    }

    public function append_value( $p )
    {
        $this->values[] = $p;
    }
}
