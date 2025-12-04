<?php

namespace Kristapsv\Enumhelpers\Tests;

use Kristapsv\Enumhelpers\HasHelpers;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class EnumHelpersTest extends TestCase
{
    #[DataProvider('concatenated')]
    public function testCanConcatenateWithDelimiters(string $delimiter, string $expected): void
    {
        $this->assertSame($expected, TestingEnum::all($delimiter));
    }

    #[DataProvider('keyValue')]
    public function testCanSplitByKeyValue(string $expectedKey, string $expectedValue): void
    {
        $keyValueCollection = TestingEnum::keyValue();
        $this->assertTrue($keyValueCollection->has($expectedKey));
        $this->assertSame($expectedValue, $keyValueCollection->get($expectedKey));
    }

    /**
     * @return array<int, array<string, string[]>>
     */
    public static function concatenated(): array
    {
        return [
            'comma' => [',', 'caseOne,caseTwo,caseThree'],
            'pipe' => ['|', 'caseOne|caseTwo|caseThree'],
            'space' => [' ', 'caseOne caseTwo caseThree'],
            'dot' => ['.', 'caseOne.caseTwo.caseThree'],
        ];
    }

    /**
     * @return array<int, array<int, string>>
     */
    public static function keyValue(): array
    {
        return [
            ['Case1', 'caseOne'],
            ['Case2', 'caseTwo'],
            ['Case3', 'caseThree'],
        ];
    }
}

enum TestingEnum: string
{
    use HasHelpers;

    case Case1 = 'caseOne';
    case Case2 = 'caseTwo';
    case Case3 = 'caseThree';

}