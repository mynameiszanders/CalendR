<?php

    namespace CalendR\Event;

    class Registry
    {

        /**
         * @static
         * @access private
         * @var array $events
         */
        private static $events = array();

        /**
         * Register Event
         *
         * @static
         * @access public
         * @param EventInterface $event
         * @return EventInterface
         */
        public static function registerEvent(EventInterface $event)
        {
            if(isset(self::$events[$event->getUid()])) {
                if(self::$events[$event->getUid()] != $event) {
                    throw new Exception\DuplicateEventUid;
                }
            }
            else {
                self::$events[$event->getUid()] = $event;
            }
            return self::$events[$event->getUid()];
        }

        /**
         * Get Event
         *
         * @static
         * @access public
         * @param string $uid
         * @return EventInterface
         */
        public static function getEvent($uid)
        {
            return self::$events[$uid];
        }

        /**
         * Reset
         *
         * @access public
         * @return void
         */
        public static function reset()
        {
            self::$events = array();
        }

    }
