<?php

namespace Kristapsv\Enumhelpers;
use Illuminate\Support\Collection;

trait HasHelpers
{
    public static function all(string $delimiter = ','): string
    {
        return implode($delimiter, self::values());
    }

    /**
     * @return Collection<string, string>
     */
    public static function keyValue(): Collection
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $value): array => [$value->name => $value->value]);
    }

    /**
     * @return array<int, int|string>
     */
    private static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}