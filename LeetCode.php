<?php

namespace Algorithms;

/**
 * Задачки с литкода
 */
class LeetCode
{
    /**
     * 1768. Merge Strings Alternately.
     *
     * Вам даны две строки word1 и word2. Объедините строки, добавляя буквы в алфавитном порядке, начиная с word1.
     * Если одна строка длиннее другой, добавьте дополнительные буквы в конец объединённой строки.
     *
     * Возвращает объединенную строку.
     */
    public static function mergeAlternately(string $word1 = 'abcd', string $word2 = 'pq'): string
    {
        $firstPointer = 0;
        $secondPointer = 0;

        $firstLength = strlen($word1);
        $secondLength = strlen($word2);

        $result = '';

        while ($firstPointer < $firstLength || $secondPointer < $secondLength) {
            if ($firstPointer < $firstLength) {
                $result .= $word1[$firstPointer];
                $firstPointer++;
            }

            if ($secondPointer < $secondLength) {
                $result .= $word2[$secondPointer];
                $secondPointer++;
            }
        }

        return $result;
    }

    /**
     * 1071. Greatest Common Divisor of Strings.
     *
     * Для двух строк s и t мы говорим, что t делит s тогда и только тогда, когда s = t + t + t + ... + t + t (т. е. t повторяется один или несколько раз).
     *
     * Учитывая две строки str1 и str2, верните самую большую строку x такую, которая x разделяет обе str1 и str2.
     *
     * Должен вернуть TAUXX.
     */
    public static function gcdOfStrings(string $str1 = 'TAUXXTAUXXTAUXXTAUXXTAUXX', string $str2 = 'TAUXXTAUXXTAUXXTAUXXTAUXXTAUXXTAUXXTAUXXTAUXX'): string
    {
        $minLength = min(strlen($str1), strlen($str2));
        $chars = [];
        $firstChar = '';

        // Определил строку которая является подстрокой
        for ($i = 0; $i < $minLength; $i++) {
            if ($str1[$i] === $firstChar) {
                break;
            }

            if ($i === 0) {
                $firstChar = $str1[$i];
            }

            $chars[] = $str1[$i];
        }

        $index = 0;
        $countChars = count($chars);

        for ($i = 0; $i < strlen($str1); $i++) {
            if ($str1[$i] !== $chars[$index]) {
                return '';
            }

            if ($index === $countChars - 1) {
                $index = 0;
            } else {
                $index++;
            }
        }

        for ($i = 0; $i < strlen($str2); $i++) {
            if ($str2[$i] !== $chars[$index]) {
                return '';
            }

            if ($index === $countChars - 1) {
                $index = 0;
            } else {
                $index++;
            }
        }

        $result = implode('', $chars);

        return $result;
    }

    /**
     * 1431. Kids With the Greatest Number of Candies.
     *
     * У n детей есть конфеты. Вам дан целочисленный массив candies, где каждое candies[i] обозначает количество конфет у ith ребёнка, и целое число extraCandies, обозначающее количество дополнительных конфет, которые есть у вас.
     *
     * Верните булевский массив result длиной n, где result[i] — true если после того, как вы отдадите ith ребёнку все extraCandies, у него будет наибольшее количество конфет среди всех детей, или false в противном случае.
     *
     * Обратите внимание, что несколько детей могут получить наибольшее количество конфет.
     */
    public static function kidsWithCandies(array $candies = [2,3,5,1,3], int $extraCandies = 3): array
    {
        $max = max($candies);
        $result = [];

        foreach ($candies as $candy) {
            if ($candy + $extraCandies >= $max) {
                $result[] = true;
            } else {
                $result[] = false;
            }
        }

        return $result;
    }

    /**
     * 605. Can Place Flowers.
     *
     * У вас есть длинная клумба, на которой некоторые участки засажены, а некоторые нет. Однако цветы нельзя сажать на соседних участках.
     *
     * Учитывая целочисленный массив flowerbed, содержащий 0 и 1's, где 0 означает «пусто»,а 1 — «не пусто», а также целое число n,
     * верните true если n новые цветы можно посадить в flowerbed не нарушая правило отсутствия соседних цветов и false в противном случае.
     */
    public static function canPlaceFlowers(array $flowerbed = [1,0,0,0,1], int $n = 2): bool
    {
        // Счетчик кол-ва свободных участков
        $counter = 0;
        $count = count($flowerbed);

        for ($i = 0; $i < $count; $i++) {
            if ($flowerbed[$i] === 1) {
                continue;
            }

            if (
                ($i === 0 || $flowerbed[$i - 1] === 0)
                && ($i === $count - 1 || $flowerbed[$i + 1] === 0)
            ) {
                $flowerbed[$i] = 1;
                $counter++;
            }
        }

        return $counter >= $n;
    }

    /**
     * 345. Reverse Vowels of a String.
     *
     * Дана строка s. Обратить вспять только гласные в строке и вернуть её в исходное состояние.
     *
     * Гласные — это 'a', 'e', 'i', 'o' и 'u', и они могут встречаться как в нижнем, так и в верхнем регистре, причём неоднократно.
     */
    public static function reverseVowels(string $s = 'leetcode'): string
    {
        if (strlen($s) === 1) {
            return $s;
        }

        $vowels = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'];
        $leftPointer = 0;
        $rightPointer = strlen($s) - 1;

        while ($leftPointer < $rightPointer) {
            if (in_array($s[$leftPointer], $vowels) && in_array($s[$rightPointer], $vowels)) {
                $temp = $s[$leftPointer];
                $s[$leftPointer] = $s[$rightPointer];
                $s[$rightPointer] = $temp;
                $leftPointer++;
                $rightPointer--;
            }

            if (!in_array($s[$leftPointer], $vowels)) {
                $leftPointer++;
            }

            if (!in_array($s[$rightPointer], $vowels)) {
                $rightPointer--;
            }
        }

        return $s;
    }

    /**
     * Дан целочисленный массив nums. Переместите все элементы 0 в конец массива, сохранив относительный порядок ненулевых элементов.
     *
     * Обратите внимание, что вы должны делать это на месте, не создавая копию массива.
     */
    public static function moveZeroes(array &$nums = [4,2,4,0,0,3,0,5,1,0]): void
    {
        $writeOffset = 0;

        foreach($nums as $i => $num) {
            if ($num !== 0) {
                $nums[$i] = 0;
                $nums[$writeOffset++] = $num;
            }
        }
    }
}