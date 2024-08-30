<?php

namespace Yasumi\tests\Provider;

use Yasumi\Holiday;
use Yasumi\tests\YasumiTestCaseInterface;
use Yasumi\Provider\Israel;

class IsraelTest extends \Yasumi\tests\YasumiTestCase implements YasumiTestCaseInterface
{
    /**
     * Tests if all official holidays in Israel are defined by the provider class.
     */
    public function testOfficialHolidays()
    {
        $year = 2024;
        $holidays = Yasumi::create(Israel::ID, $year);

        $this->assertTrue($holidays->isHoliday('newYearsDay'));
        $this->assertTrue($holidays->isHoliday('independenceDay'));
        $this->assertTrue($holidays->isHoliday('roshHashanah'));
        $this->assertTrue($holidays->isHoliday('yomKippur'));
        $this->assertTrue($holidays->isHoliday('passover'));
        $this->assertTrue($holidays->isHoliday('sukkot'));
        $this->assertTrue($holidays->isHoliday('purim'));
        $this->assertTrue($holidays->isHoliday('shavuot'));
    }

    /**
     * Tests if Independence Day is correctly calculated.
     */
    public function testIndependenceDay()
    {
        $year = 2024;
        $holidays = Yasumi::create(Israel::ID, $year);

        $this->assertInstanceOf(Holiday::class, $holidays->getHoliday('independenceDay'));
        $this->assertEquals('2024-04-15', $holidays->getHoliday('independenceDay')->format('Y-m-d'));
    }

    // Add more tests for each holiday and edge cases
}
