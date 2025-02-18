<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\Provider\Canada;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\Canada;
use Yasumi\Provider\DateTimeZoneFactory;

/**
 * Provider for all holidays in Prince Edward Island (Canada).
 *
 * Prince Edward Island is a province of Canada.
 *
 * @see https://en.wikipedia.org/wiki/Prince_Edward_Island
 */
class PrinceEdwardIsland extends Canada
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CA-PE';

    /**
     * Initialize holidays for Prince Edward Island (Canada).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->timezone = 'America/Halifax';

        $this->calculateIslanderDay();
        $this->calculateGoldCupParadeDay();
        $this->calculateVictoriaDay();
    }

    /**
     * Islander Day.
     *
     * @see https://en.wikipedia.org/wiki/Family_Day_(Canada)
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateIslanderDay(): void
    {
        if ($this->year < 2009) {
            return;
        }

        $this->addHoliday(new Holiday(
            'islanderDay',
            [],
            new \DateTime("third monday of february {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }

    /**
     * Gold Cup Parade Day.
     *
     * @see https://en.wikipedia.org/wiki/Public_holidays_in_Canada#Statutory_holidays
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateGoldCupParadeDay(): void
    {
        if ($this->year < 1962) {
            return;
        }

        $this->addHoliday(new Holiday(
            'goldCupParadeDay',
            [],
            new \DateTime("third friday of august {$this->year}", DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale
        ));
    }
}
