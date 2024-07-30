<?php

declare(strict_types=1);

namespace App\Repositories\Database;

use Illuminate\Support\Facades\DB;
use stdClass;

class SearchByName
{
    private static int $limitResults = 5;

    /**
     * @return array<string, array<stdClass>>
     */
    public static function search(string $searchTerm): array
    {
        $results['products'] = self::query('products', $searchTerm, self::$limitResults);

        if (count($results['products']) < self::$limitResults) {
            $results['complements'] = self::query('product_complements', $searchTerm, self::$limitResults - count($results['products']));
        }

        if (
            count($results['products']) < self::$limitResults ||
            isset($results['complements']) &&
            count($results['products']) + count($results['complements']) < self::$limitResults
        ) {
            $results['spare-parts'] = self::query(
                'product_spare_parts',
                $searchTerm,
                self::$limitResults - (count($results['products']) + count($results['complements'])) // @phpstan-ignore-line
            );
        }

        if (
            count($results['products']) === 0 &&
            (isset($results['complements']) && count($results['complements']) === 0) &&
            (isset($results['spare-parts']) && count($results['spare-parts']) === 0)
        ) {
            $results = [];
        }

        return $results;
    }

    /**
     * @return array<stdClass>
     */
    private static function query(string $table, string $searchTerm, int $limitResults): array
    {
        return DB::select('SELECT name, slug, main_image FROM '.$table.' WHERE name LIKE :searchTerm LIMIT '.$limitResults, ['searchTerm' => '%'.$searchTerm.'%']);
    }
}
