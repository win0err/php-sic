<?php

declare(strict_types=1);

namespace win0err\PhpSic\Asm\Lexer;

use Doctrine\Common\Lexer\AbstractLexer;

class Lexer extends AbstractLexer
{
    public const T_STRING = 1;
    public const T_SHARP = 2;
    public const T_COMMA = 3;
    public const T_INTEGER = 4;
    public const T_FLOAT = 5;
    public const T_NL = 50;

    /**
     * Lexical catchable patterns.
     *
     * @return array
     */
    protected function getCatchablePatterns(): array
    {
        return ['(?:[0-9]+(?:[\.][0-9]+)*)(?:e[+-]?[0-9]+)?', '\w+', '#', ',', '\n|\r\n'];
    }

    /**
     * Lexical non-catchable patterns.
     *
     * @return array
     */
    protected function getNonCatchablePatterns(): array
    {
        return ['\\s+', '(.)'];
    }

    /**
     * Retrieve token type. Also processes the token value if necessary.
     *
     * @param string $value
     *
     * @return int
     */
    protected function getType(&$value): int
    {
        switch (true) {
            case "\n" === $value || "\r\n" === $value:
                return static::T_NL;
            case ',' === $value:
                return static::T_COMMA;
            case '#' === $value:
                return static::T_SHARP;
            case is_numeric($value):
                return (false !== strpos($value, '.') || false !== stripos($value, 'e'))
                    ? self::T_FLOAT : self::T_INTEGER;
            case \is_string($value):
                return static::T_STRING;
        }
    }

    /**
     * Get Token from raw token.
     *
     * @param array|null $rawToken
     *
     * @return Token
     */
    public function getToken(?array $rawToken = null): Token
    {
        $rawToken = $rawToken ?? $this->token;

        $line =
            0 === $rawToken['position']
                ? 1
                : substr_count($this->getInputUntilPosition((int) $rawToken['position']), "\n", 0);

        return new Token($rawToken['type'], $rawToken['value'], ['offset' => $rawToken['position'], 'line' => $line]);
    }
}
