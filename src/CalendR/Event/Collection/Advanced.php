<?php

/*
 * This file is part of CalendR, a Fréquence web project.
 *
 * (c) 2012 Fréquence web
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CalendR\Event\Collection;

use CalendR\Event\EventInterface;
use CalendR\Period\PeriodInterface;

/**
 * Basic event collection.
 * Juste stores event as an array, and iterate over the array for retrieving.
 *
 * @author Yohan Giarelli <yohan@giarel.li>
 */
class Advanced extends \SplObjectStorage implements CollectionInterface
{

    /**
     * Add All
     *
     * Adds all the events from another collection that extends from SplObjectStorage.
     *
     * @access public
     * @param CollectionInterface $collection
     * @return void
     */
    public function addAll(CollectionInterface $collection)
    {
        parent::addAll($collection);
    }

    /**
     * Attach Event
     *
     * Add an event to the collection, and optionally add some associated data.
     *
     * @access public
     * @param EventInterface $event
     * @param mixed $data
     * @return void
     */
    public function attach(EventInterface $event, $data = null)
    {
        parent::attach($event, $data);
    }

    /**
     * Contains Event
     *
     * @access public
     * @param EventInterface $event
     * @return boolean
     */
    public function contains(EventInterface $event)
    {
        return parent::contains($event);
    }

    /**
     * Number of Events in Collection
     *
     * @access public
     * @return integer
     */
    public function count()
    {
        return parent::count();
    }

    /**
     * Current Event Entry
     *
     * @access public
     * @return EventInterface
     */
    public function current()
    {
        return parent::current();
    }

    /**
     * Detach Event
     *
     * @access public
     * @param EventInterface $event
     * @return void
     */
    public function detach(EventInterface $event)
    {
        parent::detach($event);
    }

    /**
     * Get Hash
     *
     * @access public
     * @return string
     */
    public function getHash(EventInterface $event)
    {
        return parent::getHash($event);
    }

    /**
     * Get Info
     *
     * Returns the data associated with event at the current iterator entry.
     *
     * @access public
     * @return mixed
     */
    public function getInfo()
    {
        return parent::getInfo();
    }

    /**
     * Iterator Key
     *
     * @access public
     * @return integer
     */
    public function key()
    {
        return parent::key();
    }













    /**
     * The events
     *
     * @var array<EventInterface>
     */
    protected $events;

    /**
     * @param array $events
     */
    public function __construct(array $events = array())
    {
        foreach($events as $event) {
            $this->attach($event);
        }
    }

    /**
     * Adds an event to the collection
     *
     * @param EventInterface $event
     */
    public function add(EventInterface $event)
    {
        $this->attach($event);
    }

    /**
     * Removes an event from the collection
     *
     * @param EventInterface $event
     */
    public function remove(EventInterface $event)
    {
        $this->detach($event);
    }

    /**
     * Return all events;
     *
     * @return array<EventInterface>
     */
    public function all()
    {
        return $this->events;
    }

    /**
     * Returns if there is events corresponding to $index period
     *
     * @param mixed $index
     *
     * @return bool
     */
    public function has($index)
    {
        return count($this->find($index)) > 0;
    }

    /**
     * Find events in the collection
     *
     * @param mixed $index
     *
     * @return array<EventInterface>
     */
    public function find($index)
    {
        $result = array();
        foreach ($this->events as $event) {
            if ($index instanceof PeriodInterface && $index->containsEvent($event)) {
                $result[] = $event;
            } elseif ($index instanceof \DateTime && $event->contains($index)) {
                $result[] = $event;
            }
        }

        return $result;
    }
}
