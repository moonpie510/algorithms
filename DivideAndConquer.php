<?php

namespace Algorithms;

use MongoDB\BSON\PackedArray;

/**
 * Разделяй и властвуй (Divide and Conquer)
 * Разделяй и властвуй (Divide and Conquer) — это подход к решению задач, который заключается в разбиении большой задачи на несколько меньших, которые решаются отдельно, а потом результаты этих меньших задач объединяются в решение исходной задачи.
 *
 * Представь, что у тебя есть огромная гора работы, и ты решаешь ее разобрать на маленькие части. Каждую часть ты решаешь по отдельности, а затем все собрал и получил решение.
 *
 * Как это работает?
 * - Разделение: Разбиваем исходную задачу на несколько меньших, идентичных, но более простых подзадач.
 * - Решение: Каждую из этих подзадач решаем независимо.
 * - Объединение: Объединяем решения подзадач в итоговое решение задачи.
 */
class DivideAndConquer
{
    /**
     * Как это работает?
     *
     * Мы разбиваем массив на две части до тех пор, пока не получим массивы из одного элемента.
     *
     * Каждый из этих маленьких массивов уже отсортирован (по сути, из одного элемента).
     *
     * Сливаем их в два отсортированных массива, повторяя этот процесс на каждом уровне.
     */
    public static function mergeSort(array $array = [38, 27, 43, 3, 9, 82, 10]): array
    {
        if (count($array) < 2) {
            return $array;
        }

        // Разделяем массив на две половины
        $middle = (int) (count($array) / 2);
        $left = array_slice($array, 0, $middle);
        $right = array_slice($array, $middle);

        // Рекурсивно сортируем каждую половину
        $left = self::mergeSort($left);
        $right = self::mergeSort($right);

        // Объединяем отсортированные половины
        return self::merge($left, $right);
    }

    public static function merge(array $left, array $right): array
    {
        $result = [];
        $leftIndex = 0;
        $rightIndex = 0;

        while ($leftIndex < count($left) && $rightIndex < count($right)) {
            if ($left[$leftIndex] < $right[$rightIndex]) {
                $result[] = $left[$leftIndex];
                $leftIndex++;
            } else {
                $result[] = $right[$rightIndex];
                $rightIndex++;
            }
        }

        // Добавляем оставшиеся элементы из левого массива
        while ($leftIndex < count($left)) {
            $result[] = $left[$leftIndex];
            $leftIndex++;
        }

        // Добавляем оставшиеся элементы из правого массива
        while ($rightIndex < count($right)) {
            $result[] = $right[$rightIndex];
            $rightIndex++;
        }

        return $result;
    }

    /**
     * Пример 2: Быстрая сортировка (Quick Sort)
     *
     * Алгоритм сортировки массива, который выбирает опорный элемент и сортирует элементы вокруг него.
     *
     * Как это работает?
     * - Разделение: Мы выбираем опорный элемент, а затем делим массив на три части: меньшие, равные и большие опорному элементу.
     * - Решение: Рекурсивно применяем сортировку к подмассивам.
     * - Объединение: Объединяем отсортированные части, что дает нам итоговый отсортированный массив.
     */
    public static function quickSort(array $array = [38, 27, 43, 3, 9, 82, 10]): array
    {
        if (count($array) <= 1) {
            return $array;
        }

        // Выбираем опорный элемент
        $pivot = $array[(int) (count($array) / 2)];
        $left = [];
        $right = [];

        foreach ($array as $value) {
            if ($value < $pivot) {
                $left[] = $value;
            }

            if ($value > $pivot) {
                $right[] = $value;
            }
        }

        return array_merge(self::quickSort($left), [$pivot], self::quickSort($right));
    }

    /**
     * Пример 3: Поиск максимального элемента в массиве.
     *
     * Как это работает?
     * - Разбиваем массив на две части.
     * - Находим максимальные элементы в обеих частях.
     * - Возвращаем наибольшее из двух найденных максимумов.
     */
    public static function findMax(array $array = [2, 5, 1, 8, 3, 7]): int
    {
        if (count($array) <= 1) {
            return $array[0];
        }

        $pivot = (int) (count($array) / 2);

        $leftArray = array_slice($array, 0, $pivot);
        $leftMax = self::findMax($leftArray);

        $rightArray = array_slice($array, $pivot);
        $rightMax = self::findMax($rightArray);

        return max($leftMax, $rightMax);
    }
}