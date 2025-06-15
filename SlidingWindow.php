<?php

namespace Algorithms;

/**
 * Скользящее окно (Sliding Window)
 * Представь, что у тебя есть массив чисел, и тебе надо найти максимальную сумму подмассива фиксированной длины или самую длинную подстроку, удовлетворяющую условиям.
 *
 * Перебирать все возможные подмассивы (O(N²)).
 *
 * Использовать "скользящее окно" и проходить по массиву всего один раз (O(N)).
 *
 * Как это работает?
 *
 * Представь, что у тебя есть "окно" (например, подмассив длины k).
 *
 * Ты сначала заполняешь это окно, суммируя k элементов.
 *
 * Затем "скользишь" по массиву, убирая старый элемент (который вышел за границу окна) и добавляя новый элемент (который входит в окно).
 */
class SlidingWindow
{
    /**
     * Пример 1: Найти максимальную сумму k подряд идущих элементов в массиве
     *
     * Дан массив чисел и k. Найти подмассив длины k с максимальной суммой.
     *
     * Почему это круто?
     * - Без скользящего окна: Надо проверять все подмассивы (O(N²)).
     * - Со скользящим окном: Мы просто убираем старый элемент и добавляем новый (O(N)).
     */
    public static function maxSumSubarray(array $array = [2, 1, 5, 1, 3, 2], int $windowLength = 3): int
    {
        // Сумма элементов в окне
        $currentSum = array_sum(array_slice($array, 0, $windowLength));
        $sum = $currentSum;

        for ($i = 0; $i < count($array) - $windowLength; $i++) {
            $currentSum = $currentSum - $array[$i] + $array[$i + $windowLength];
            $sum = max($sum, $currentSum);
        }

        return $sum;
    }

    /**
     * Пример 2: Найти длину самой длинной подстроки с уникальными символами
     *
     * Даная строка. Найти самую длинную подстроку, в которой нет повторяющихся символов.
     *
     * Как это работает?
     * - Окно сдвигается вправо по строке.
     * - Если символ повторяется, сдвигаем левую границу окна, пока повтор не исчезнет.
     *
     * Итоговая сложность O(N), потому что каждый символ обрабатывается максимум 2 раза (когда заходит в окно и когда выходит).
     */
    public static function longestUniqueSubstring(string $string = 'abcabcdab'): int
    {
        $uniqueChars = [];
        $maxLength = 0;
        $leftIndex = 0;

        for ($rightIndex = 0; $rightIndex < strlen($string); $rightIndex++) {
            $currentChar = $string[$rightIndex];

            // Если символ уже есть в окне, сдвигаем левую границу окна
            if (isset($uniqueChars[$currentChar]) && $uniqueChars[$currentChar] >= $leftIndex) {
                $leftIndex = $uniqueChars[$currentChar] + 1;
            }

            $uniqueChars[$currentChar] = $rightIndex;

            $currentLength = $rightIndex - $leftIndex + 1;

            $maxLength = max($maxLength, $currentLength);
        }

        return $maxLength;
    }

    /**
     * Пример 3: Минимальная длина подмассива с суммой >= target
     *
     * Найти самый короткий подмассив, сумма которого ≥ target.
     *
     * Почему это круто?
     * - Без скользящего окна: Надо проверять все возможные подмассивы (O(N²)).
     * - Со скользящим окном: Мы не перезапускаем поиск сначала, а просто сдвигаем левую границу (O(N)).
     */
    public static function minSubarrayLen(array $array = [2, 3, 1, 2, 4, 3], int $target = 7): array
    {
        $leftIndex = 0;
        $windowSum = 0;
        $minLength = PHP_INT_MAX;
        $windowArray = [];

        for ($rightIndex = 0; $rightIndex < count($array); $rightIndex++) {
            $windowSum += $array[$rightIndex];

            // Пока сумма в окне >= target, пытаемся уменьшить окно слева
            while ($windowSum >= $target) {
                $windowSum -= $array[$leftIndex];
                $currentLength = $rightIndex - $leftIndex + 1;

                if ($currentLength < $minLength) {
                    $windowArray = array_slice($array, $leftIndex, $currentLength);
                }

                $leftIndex++;
            }
        }

        return $windowArray;
    }
}