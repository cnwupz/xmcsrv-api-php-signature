<?php
class TimeMillisUtil
{
    private static $timMillis;
    private static $counter = 1;

    private static function getCounter()
    {
        self::$counter = self::$counter++;
        if (self::$counter < 10) {
            return "000000" . self::$counter;
        } else if (self::$counter < 100) {
            return '00000' . self::$counter;
        } else if (self::$counter < 1000) {
            return '0000' . self::$counter;
        } else if (self::$counter < 10000) {
            return '000' . self::$counter;
        } else if (self::$counter < 100000) {
            return '00' . self::$counter;
        } else if (self::$counter < 1000000) {
            return '0' . self::$counter;
        } else if (self::$counter < 10000000) {
            return self::$counter;
        } else {
            self::$counter = 1;
            return '000000' . self::$counter;
        }
    }

    public static function getTimMillis()
    {
        return self::getCounter() . time();
    }
}
