<?php

namespace Algorithms;

/**
 * Два указателя (Two Pointers).
 *
 * Два указателя — это техника, которая помогает обрабатывать массив за один проход или уменьшить количество ненужных проверок.
 *
 * Мы используем два индекса (указателя), которые двигаются по массиву разными способами:
 * - Один медленный, другой быстрый
 * - Один с начала, другой с конца
 * - Два указателя по разным массивам
 */
class TwoPointers
{
    /**
     * Два указателя с концов
     * Когда один указатель с начала, другой с конца, и они сходятся в середине.
     *
     * Где это ипользуется?
     * - Поиск пар чисел, дающих нужную сумму.
     * - Переворот массива in-place.
     *
     * Пример: Найти два числа, сумма которых равна target (в отсортированном массиве)
     */
    public static function twoSum(array $array = [1, 2, 3, 4, 6], int $targetSum = 6): ?array
    {
        $leftPointer = 0;
        $rightPointer = count($array) - 1;

        while ($leftPointer < $rightPointer) {
            $currentSum = $array[$leftPointer] + $array[$rightPointer];

            if ($currentSum === $targetSum) {
                return [$array[$leftPointer], $array[$rightPointer]];
            }

            if ($currentSum < $targetSum) {
                $leftPointer++;
            } else {
                $rightPointer--;
            }
        }

        return null;
    }

    /**
     * Два указателя по разным массивам
     * Когда у нас два отсортированных массива, и мы хотим их обработать быстрее, чем за O(N*M).
     *
     * Где это используется?
     * - Слияние двух отсортированных массивов.
     * - Поиск пересечений двух массивов.
     *
     * Пример: Найти общие элементы двух отсортированных массивов.
     * Обычный перебор был бы O(N*M), а тут всего O(N + M).
     */
    public static function commonElements(array $firstArray = [1, 3, 4, 6], array $secondArray = [1, 2, 3, 6, 8]): array
    {
        $firstArrayPointer = 0;
        $secondArrayPointer = 0;
        $commonElements = [];

        while ($firstArrayPointer < count($firstArray) && $secondArrayPointer < count($secondArray)) {
            if ($firstArray[$firstArrayPointer] === $secondArray[$secondArrayPointer]) {
                $commonElements[] = $firstArray[$firstArrayPointer];
                $firstArrayPointer++;
                $secondArrayPointer++;
                continue;
            }

            if ($firstArray[$firstArrayPointer] < $secondArray[$secondArrayPointer]) {
                $firstArrayPointer++;
            } else {
                $secondArrayPointer++;
            }
        }

        return $commonElements;
    }
}