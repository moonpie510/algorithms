<?php

namespace Algorithms;

class TestTask
{
    /**
     * Подсчитать кол-во каждого символа в строке и вернуть массив символов и их кол-во.
     */
    public static function countChar(string $text = 'hello world'): array
    {
        $result = [];

        for ($i = 0; $i < strlen($text); $i++) {
            if (!isset($result[$text[$i]])) {
                $result[$text[$i]] = 1;
            } else {
                $result[$text[$i]]++;
            }
        }

        return $result;
    }

    /**
     * Найти k-ый уникальный элемент. Если такой элемент отсутствует вернуть null
     */
    public static function findKUniqueElem(array $array = ['a', 'b', 'c', 'a', 'c', 'a', 'x'], int $k = 2): ?string
    {
        $hash = [];

        for ($i = 0; $i < count($array); $i++) {
            if (!isset($hash[$array[$i]])) {
                $hash[$array[$i]] = 1;
            } else {
                $hash[$array[$i]]++;
            }
        }

        $counter = 1;

        foreach ($hash as $key => $value) {
            if ($value === 1) {
                if ($counter === $k) {
                    return $key;
                } else {
                    $counter++;
                }
            }
        }

        return null;
    }

    /**
     * Найти сколько слов можно составить из слов "balloon". Вернуть число слов.
     */
    public static function numbersOfBalloon(string $text = 'balloonballoonballoon'): int
    {
        $hash = [];

        for ($i = 0; $i < strlen($text); $i++) {
            if (!isset($hash[$text[$i]])) {
                $hash[$text[$i]] = 1;
            } else {
                $hash[$text[$i]]++;
            }
        }

        $word = [
            'b' => 1,
            'a' => 1,
            'l' => 2,
            'o' => 2,
            'n' => 1,
        ];

        $wordsCounter = PHP_INT_MAX;

        foreach ($word as $char => $count) {
            if (!isset($hash[$char])) {
                return 0;
            }

            $counter = floor($hash[$char] / $count);
            $wordsCounter = min($wordsCounter, $counter);
        }

        if ($wordsCounter === PHP_INT_MAX) {
            return 0;
        }

        return $wordsCounter;
    }

    /**
     * Определение количества чисел меньше каждого элемента массива.
     */
    public static function countSmallerNumbersNaive(array $array = [5, 2, 6, 1]): array
    {
        $result = [];

        foreach ($array as $value) {
            $count = 0;

            foreach ($array as $v) {
                if ($v < $value) {
                    $count++;
                }
            }

            $result[] = $count;
        }

        return $result;
    }

    /**
     * Определение количества чисел меньше каждого элемента массива.
     *
     * Более быстрое решение.
     */
    public static function countSmallerNumbers(array $array = [5, 2, 6, 1, 5, 2]): array
    {
        sort($array);
        $result = [];
        $count = 0;

        if (count($array) < 2) {
            return [0];
        }

        $result[] = 0;

        for($i = 1; $i < count($array); $i++) {
            if ($array[$i] > $array[$i - 1]) {
                $count++;
            }

            $result[] = $count;
        }

        return [$array, $result];
    }

    /**
     * Определить является ли строка анаграммой.
     *
     * Анаграмма - это строка, которая может быть получена из другой строки перестановкой символов.
     */
    public static function isAnagram(string $firstText = 'hello', string $secondText = 'olleh'): bool
    {
        $firstTextLength = strlen($firstText);
        $secondTextLength = strlen($secondText);

        if ($firstTextLength !== $secondTextLength) {
            return false;
        }

        $length = $firstTextLength;
        $hash = [];

        for ($i = 0; $i < $length; $i++) {
            $hash[$firstText[$i]] = $hash[$firstText[$i]] ?? 0;
            $hash[$firstText[$i]]++;
        }

        for ($i = 0; $i < $length; $i++) {
            if (!isset($hash[$secondText[$i]])) {
                return false;
            }

            $hash[$secondText[$i]]--;

            if ($hash[$secondText[$i]] < 0) {
                return false;
            }
        }

        return true;
    }

    public static function findGoodPairs(array $array = [1, 2, 3, 1, 1, 3]): int
    {
        $counter = 0;

        for ($i = 0; $i < count($array); $i++) {
            for ($j = $i + 1; $j < count($array); $j++) {
                if ($array[$i] === $array[$j]) {
                    $counter++;
                }
            }
        }

        return $counter;
    }

    public static function findGoodPairsOptimize(array $array = [1, 2, 3, 1, 1, 3, 2]): int
    {
        $hash = [];

        foreach ($array as $value) {
            $hash[$value] = $hash[$value] ?? 0;
            $hash[$value]++;
        }

        $counter = 0;

        foreach ($hash as $count) {
            $counter += $count * ($count - 1) / 2;
        }

        return $counter;
    }

    /**
     * Определить является ли строка палиндромом.
     */
    public static function isPalindrome(string $text = 'go dog'): bool
    {
        $leftPointer = 0;
        $rightPointer = strlen($text) - 1;

        while ($leftPointer < $rightPointer) {
            if ($text[$leftPointer] === ' ') {
                $leftPointer++;
                continue;
            }

            if ($text[$rightPointer] === ' ') {
                $rightPointer--;
                continue;
            }

            if ($text[$leftPointer] !== $text[$rightPointer]) {
                return false;
            }

            $leftPointer++;
            $rightPointer--;
        }

        return true;
    }
}