<?php

namespace Algorithms;

/**
 * Обход в глубину (DFS — Depth First Search)
 * Обход в глубину (DFS) — это способ обхода графа или дерева, при котором мы идем как можно глубже по одной ветке, прежде чем вернуться назад и попробовать другую.
 *
 * Представь, что ты заблудился в лабиринте, но у тебя есть правило:
 *
 * Всегда иди вперед, пока не упрешься в тупик.
 *
 * Если уперся — откатывайся назад и пробуй другую дорогу.
 *
 * Где применяется?
 * - Обход графов и деревьев (например, в поисковых алгоритмах).
 * - Поиск пути в лабиринтах.
 * - Проверка связности графа (есть ли путь между узлами).
 * - Поиск компоненты связности.
 * - Генерация лабиринтов.
 */
class DepthFirstSearch
{
    public static array $graph = [
        'a' => ['b', 'c'],
        'b' => ['a', 'd', 'e'],
        'c' => ['a', 'f'],
        'd' => ['b'],
        'e' => ['b', 'f'],
        'f' => ['c', 'e'],
    ];

    /**
     * Пример 1: DFS для графа (рекурсия)
     */
    public static function dfsRecursive(string $start, array &$visited = []): array
    {
        if (!in_array($start, $visited)) {
            $visited[] = $start;
            $neighbours = self::$graph[$start];

            foreach ($neighbours as $neighbour) {
                if (!in_array($neighbour, $visited)) {
                    self::dfsRecursive($neighbour, $visited);
                }
            }
        }

        return $visited;
    }

    /**
     * Пример 2: DFS для графа (итеративный вариант со стеком)
     *
     * Почему итеративный DFS иногда лучше?
     * - В глубоких деревьях и графах рекурсия может привести к переполнению стека.
     * - Здесь мы используем явный стек, поэтому управляем процессом вручную.
     */
    public static function dfsIterative(string $start): array
    {
        $visited = [];
        $stack = [$start];

        while (!empty($stack)) {
            $node = array_pop($stack);

            if (!in_array($node, $visited)) {
                $visited[] = $node;
                $neighbours = self::$graph[$node];

                foreach ($neighbours as $neighbour) {
                    if (!in_array($neighbour, $visited)) {
                        $stack[] = $neighbour;
                    }
                }
            }
        }

        return $visited;
    }
}