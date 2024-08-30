<?php

namespace Yasumi\Provider;

use Yasumi\Holiday;
use Yasumi\Provider\AbstractProvider;
use Yasumi\Exception\InvalidDateException;
use DateTime;
use DateTimeZone;
use IntlCalendar;

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

        // Add Hebrew calendar holidays
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
        $hebrewYear = $this->getHebrewYear();
        $independenceDay = $this->convertHebrewToGregorian($hebrewYear, 8, 5); // 5th of Iyar

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
        $hebrewYear = $this->getHebrewYear();
        $roshHashanah = $this->convertHebrewToGregorian($hebrewYear, 7, 1); // 1st of Tishrei

        $this->addHoliday(new Holiday(
            'roshHashanah',
            ['en' => 'Rosh Hashanah', 'he' => 'ראש השנה'],
            $roshHashanah,
            $this->locale
        ));
    }

    /**
     * Adds Yom Kippur.
     */
    private function addYomKippur(): void
    {
        $hebrewYear = $this->getHebrewYear();
        $yomKippur = $this->convertHebrewToGregorian($hebrewYear, 7, 10); // 10th of Tishrei

        $this->addHoliday(new Holiday(
            'yomKippur',
            ['en' => 'Yom Kippur', 'he' => 'יום כיפור'],
            $yomKippur,
            $this->locale
        ));
    }

    /**
     * Adds Passover (Pesach).
     */
    private function addPassover(): void
    {
        $hebrewYear = $this->getHebrewYear();
        $passover = $this->convertHebrewToGregorian($hebrewYear, 1, 15); // 15th of Nisan

        $this->addHoliday(new Holiday(
            'passover',
            ['en' => 'Passover', 'he' => 'פסח'],
            $passover,
            $this->locale
        ));
    }

    /**
     * Adds Sukkot.
     */
    private function addSukkot(): void
    {
        $hebrewYear = $this->getHebrewYear();
        $sukkot = $this->convertHebrewToGregorian($hebrewYear, 7, 15); // 15th of Tishrei

        $this->addHoliday(new Holiday(
            'sukkot',
            ['en' => 'Sukkot', 'he' => 'סוכות'],
            $sukkot,
            $this->locale
        ));
    }

    /**
     * Adds Purim.
     */
    private function addPurim(): void
    {
        $hebrewYear = $this->getHebrewYear();
        $purim = $this->convertHebrewToGregorian($hebrewYear, 12, 14); // 14th of Adar (or Adar II in a leap year)

        $this->addHoliday(new Holiday(
            'purim',
            ['en' => 'Purim', 'he' => 'פורים'],
            $purim,
            $this->locale
        ));
    }

    /**
     * Adds Shavuot.
     */
    private function addShavuot(): void
    {
        $hebrewYear = $this->getHebrewYear();
        $shavuot = $this->convertHebrewToGregorian($hebrewYear, 3, 6); // 6th of Sivan

        $this->addHoliday(new Holiday(
            'shavuot',
            ['en' => 'Shavuot', 'he' => 'שבועות'],
            $shavuot,
            $this->locale
        ));
    }

    /**
     * Converts a Hebrew date to the Gregorian calendar.
     *
     * @param int $year Hebrew year
     * @param int $month Hebrew month
     * @param int $day Hebrew day
     * @return DateTime Gregorian date corresponding to the Hebrew date
     */
    private function convertHebrewToGregorian(int $year, int $month, int $day): DateTime
    {
        $intlCalendar = IntlCalendar::createInstance('Asia/Jerusalem', 'hebrew');
        $intlCalendar->set(IntlCalendar::FIELD_YEAR, $year);
        $intlCalendar->set(IntlCalendar::FIELD_MONTH, $month - 1); // IntlCalendar months start from 0
        $intlCalendar->set(IntlCalendar::FIELD_DAY_OF_MONTH, $day);

        return DateTime::createFromImmutable($intlCalendar->toDateTime());
    }

    /**
     * Gets the current Hebrew year for conversion purposes.
     *
     * @return int Hebrew year corresponding to the current Gregorian year
     */
    private function getHebrewYear(): int
    {
        $intlCalendar = IntlCalendar::createInstance('Asia/Jerusalem', 'hebrew');
        $intlCalendar->set($this->year, 0, 1); // Set to the beginning of the Gregorian year
        return $intlCalendar->get(IntlCalendar::FIELD_YEAR);
    }
}
