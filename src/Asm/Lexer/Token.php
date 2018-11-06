<?php

declare(strict_types=1);

namespace win0err\PhpSic\Asm\Lexer;

class Token
{
    /** @var int End of input */
    public const EOI = 0;

    /** @var int Unknown */
    public const UNKNOWN = -1;

    /** @var int Skip */
    public const SKIP = -2;

    /** @var int */
    protected $id;

    /** @var string|null */
    protected $value;

    /** @var array */
    protected $attributes = [];

    /**
     * Token constructor.
     *
     * @param int    $id
     * @param string $value
     * @param array  $attributes
     */
    public function __construct(int $id, ?string $value = null, array $attributes = [])
    {
        $this->id = $id;
        $this->value = $value;
        $this->attributes = $attributes;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            'Token <%d, "%s">',
            $this->getId(),
            str_replace(
                ["\0", "\r", "\n", "\f", "\t", '"'],
                ['\\0', '\\r', '\\n', '\\f', '\\t', '\\"'],
                (string) $this->getValue()
            )
        );
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasAttribute(string $name): bool
    {
        return isset($this->attributes[$name]);
    }

    /**
     * @param string $name
     *
     * @return mixed|null
     */
    public function getAttribute(string $name)
    {
        return $this->attributes[$name] ?? null;
    }

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return mixed
     */
    public function addAttribute(string $name, $value)
    {
        $this->attributes[$name] = $value;
    }
}
