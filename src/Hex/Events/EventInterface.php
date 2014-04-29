<?php  namespace Hex\Events; 

interface EventInterface {

    /**
     * Return the event name
     * @return string
     */
    public function name();
} 