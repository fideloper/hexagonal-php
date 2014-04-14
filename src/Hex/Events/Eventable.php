<?php namespace Hex\Events;


trait Eventable {

    protected $queuedEvents;

    public function flushEvents()
    {
        $events = $this->queuedEvents;
        $this->queuedEvents = [];

        return $events;
    }

    public function raise($event)
    {
        $this->queuedEvents[] = $event;
    }
} 