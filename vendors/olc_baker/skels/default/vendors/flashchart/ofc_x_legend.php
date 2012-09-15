<?php

class x_legend
{
    public function x_legend( $text='' )
    {
        $this->text = $text;
    }

    public function set_style( $css )
    {
        $this->style = $css;
        //"{font-size: 20px; color:#0000ff; font-family: Verdana; text-align: center;}";
    }
}
