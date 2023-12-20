<?php

namespace App\Domains\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait FilterableBuilder
{
    public static function queryFilter(
        array $filters,
        array $options = []
    ): Builder {
        $filterCollect = collect($filters);
        $defaultOptions = [
            'separator' => '_',
            'fail' => true,
            ...$options,
        ];

        $builder = self::query();

        $filterCollect->each(function ($value, $key) use ($options, $builder, $defaultOptions) {
            if ($key !== 'perPage' && $key !== 'page' && $key !== 'hash' && $key !== 'endHash') {
                $exploded = collect(explode($options['separator'] ?? $defaultOptions['separator'], $key));
                $operator = $exploded->last();
                $columnName = $exploded->slice(0, -1)->join('_');
                self::getExpression($operator, $builder, $columnName, $value, $defaultOptions);
            }
        });

        return $builder;
    }

    private static function getExpression(string $operator, Builder $builder, string $columnName, $value, array $options): Builder
    {
        $unaccent_filter = false;

        if (defined('self::UNACCENT_FILTER') && self::UNACCENT_FILTER === true) {
            $unaccent_filter = true;
        }

        if (
            defined('self::FILTERABLE_COLUMNS') &&
            ! in_array($columnName, self::FILTERABLE_COLUMNS, true) &&
            ! empty($columnName)
        ) {
            if ($options['fail']) {
                throw new \InvalidArgumentException(
                    __('validation.invalid_filter ', [
                        'attribute' => __('validation.attributes.'.$columnName),
                    ])
                );
            }

            return $builder;
        }

        if (defined('self::COLUMN_ALIASES') && isset(self::COLUMN_ALIASES[$columnName])) {
            $columnName = self::COLUMN_ALIASES[$columnName];
        }

        $fullColumnName = $columnName;
        if (strpos($columnName, '.') === false && defined('self::DEFAULT_TABLE_NAME')) {
            $fullColumnName = self::DEFAULT_TABLE_NAME.'.'.$columnName;
        }

        return match ($operator) {
            'eq' => $unaccent_filter ? $builder->where(DB::raw('unaccent('.$fullColumnName.')'), $value)->orWhere($fullColumnName, $value)
                : $builder->where($fullColumnName, $value),
            'lt' => $builder->where($fullColumnName, '<', $value),
            'gt' => $builder->where($fullColumnName, '>', $value),
            'like' => $unaccent_filter ? $builder->where(DB::raw('unaccent('.$fullColumnName.')'), 'ilike', '%'.$value.'%')->orWhere($fullColumnName, 'ilike', '%'.$value.'%')
                : $builder->where($fullColumnName, 'ilike', '%'.$value.'%'),
            'reg' => $builder->where($fullColumnName, DB::raw('regexp'), $value),
            'in' => $builder->whereIn($fullColumnName, explode(',', str_replace(' ', '', $value))),
            'noteq' => $builder->whereNot($fullColumnName, $value),
            'between' => $builder->whereBetween($fullColumnName, explode(',', $value)),
            'orderby' => $builder->orderBy($fullColumnName, $value),
            'null' => $builder->whereNull($fullColumnName),
            'notnull' => $builder->whereNotNull($fullColumnName),
            'asc' => $builder->orderBy($fullColumnName),
            'desc' => $builder->orderBy($fullColumnName, 'desc'),
            default => (
                defined('self::CUSTOM_COLUMN_FILTERS') &&
                ! in_array($columnName, self::CUSTOM_COLUMN_FILTERS, true) &&
                ! empty($columnName)
            ) ? throw new \InvalidArgumentException("$operator is not a valid operator to $columnName column")
              : $builder,
        };
    }
}
