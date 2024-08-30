<?php

namespace Yasumi\Provider;

use Yasumi\Holiday;
use Yasumi\Provider\AbstractProvider;
use Yasumi\Exception\InvalidDateException;
use DateTime;
use DateTimeZone;

/**
 * Provider for all holidays in Israel.
 */
class Israel extends AbstractProvider
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective country or sub-region.
     */
    public const ID = 'IL';

    /**
     * Initialize holidays for Israel.
     *
     * @throws InvalidDateException
     */
    public function initialize(): void
    {
        $this->timezone = 'Asia/Jerusalem';

        // Add fixed-date holidays
        $this->addNewYear();
        $this->addIndependenceDay();

        // Add Hebrew calendar holidays (example: Rosh Hashanah)
        $this->addRoshHashanah();
        $this->addYomKippur();
        $this->addPassover();
        $this->addSukkot();
        $this->addPurim();
        $this->addShavuot();
    }

    /**
     * Adds New Year's Day (Gregorian calendar).
     */
    private function addNewYear(): void
    {
        $this->addHoliday(new Holiday(
            'newYearsDay',
            ['en' => 'New Year\'s Day', 'he' => 'ראש השנה הלועזי'],
            new DateTime("{$this->year}-01-01", new DateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Adds Israel Independence Day.
     */
    private function addIndependenceDay(): void
    {
        // Independence Day (Yom Ha'atzmaut) is on the 5th of Iyar in the Hebrew calendar.
        // This may require additional logic for conversion, depending on the year.

        // Example date - needs to be replaced with Hebrew to Gregorian conversion logic.
        $independenceDay = new DateTime("{$this->year}-04-15", new DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday(
            'independenceDay',
            ['en' => 'Independence Day', 'he' => 'יום העצמאות'],
            $independenceDay,
            $this->locale
        ));
    }

    /**
     * Adds Rosh Hashanah.
     */
    private function addRoshHashanah(): void
    {
        // Example date - needs to be replaced with Hebrew to Gregorian conversion logic.
        $roshHashanah = new DateTime("{$this->year}-09-15", new DateTimeZone($this->timezone));

        $this->addHoliday(new Holiday(
            'roshHashanah',
            ['en' => 'Rosh Hashanah', 'he' => 'ראש השנה'],
            $roshHashanah,
            $this->locale
        ));
    }

    /**
     * Adds

