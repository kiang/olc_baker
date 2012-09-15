<?php

class scatter_line
{
    public function scatter_line( $colour )
    {
        $this->type      = "scatter_line";
        $this->set_colour( $colour );
    }

    public function set_default_dot_style( $style )
    {
        $tmp = 'dot-style';
        $this->$tmp = $style;
    }

    public function set_colour( $colour )
    {
        $this->colour = $colour;
    }

    public function set_values( $values )
    {
        $this->values = $values;
    }

    public function set_step_horizontal()
    {
        $this->stepgraph = 'horizontal';
    }

    public function set_step_vertical()
    {
        $this->stepgraph = 'vertical';
    }

    public function set_key( $text, $font_size )
    {
        $this->text      = $text;
        $tmp = 'font-size';
        $this->$tmp = $font_size;
    }
}
