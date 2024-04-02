<?php declare(strict_types=1);
namespace System\DataBase\Entities;

class Conditionals{
    const TYPE_OR = 1;
    const TYPE_AND = 2;

    protected array $wheres = [];

      /**
     * 
     * @param string $field
     * @param string $operator
     * @param string $value
     * @param bool $quotes
     * @return $this
     */
    public function where(string $field, string $operator, string $value, bool $quotes = true): self {
        $this->wheres[] = ["field" => $field, "operator" => $operator, "value" => $value, "quotes" => $quotes, "type" => self::TYPE_AND];
        return $this;
    }

    /**
     * 
     * @param string $field
     * @param string $operator
     * @param string $value
     * @param bool $quotes
     * @return $this
     */
    public function orWhere(string $field, string $operator, string $value, bool $quotes = true): self {
        $this->wheres[] = ["field" => $field, "operator" => $operator, "value" => $value, "quotes" => $quotes, "type" => self::TYPE_OR];
        return $this;
    }

    /**
     * 
     * @param string $field
     * @param array $values
     * @param bool $quotes
     * @return $this
     */
    public function whereIn(string $field, array $values): self {
        $this->wheres[] = ["field" => $field, "operator" => "IN", "values" => $values,  "type" => self::TYPE_AND];
        return $this;
    }

    /**
     * 
     * @param string $field
     * @param array $values
     * @param bool $quotes
     * @return $this
     */
    public function whereNotIn(string $field, array $values): self {
        $this->wheres[] = ["field" => $field, "operator" => "NOT IN", "values" => $values,  "type" => self::TYPE_AND];
        return $this;
    }

    /**
     * 
     * @param string $field
     * @param array $values
     * @param bool $quotes
     * @return $this
     */
    public function orWhereIn(string $field, array $values): self {
        $this->wheres[] = ["field" => $field, "operator" => "IN", "values" => $values,  "type" => self::TYPE_OR];
        return $this;
    }

    /**
     * 
     * @param string $field
     * @param array $values
     * @param bool $quotes
     * @return $this
     */
    public function orWhereNotIn(string $field, array $values): self {
        $this->wheres[] = ["field" => $field, "operator" => "NOT IN", "values" => $values,  "type" => self::TYPE_OR];
        return $this;
    }

    /**
     * 
     * @param string $field
     * @param string $value
     * @param bool $quotes
     * @return $this
     */
    public function like(string $field, string $value, bool $quotes = true): self {
        $this->wheres[] = ["field" => $field, "operator" => "LIKE", "value" => $value, "quotes" => $quotes, "type" => self::TYPE_AND];
        return $this;
    }

    /**
     * 
     * @param string $field
     * @param string $value
     * @param bool $quotes
     * @return $this
     */
    public function orLike(string $field, string $value, bool $quotes = true): self {
        $this->wheres[] = ["field" => $field, "operator" => "LIKE", "value" => $value, "quotes" => $quotes, "type" => self::TYPE_OR];
        return $this;
    }

    /**
     * 
     * @param string $field
     * @param string $value
     * @param bool $quotes
     * @return $this
     */
    public function notLike(string $field, string $value, bool $quotes = true): self {
        $this->wheres[] = ["field" => $field, "operator" => "NOT LIKE", "value" => $value, "quotes" => $quotes, "type" => self::TYPE_AND];
        return $this;
    }

    /**
     * 
     * @param string $field
     * @param string $value
     * @param bool $quotes
     * @return $this
     */
    public function orNotLike(string $field, string $value, bool $quotes = true): self {
        $this->wheres[] = ["field" => $field, "operator" => "NOT LIKE", "value" => $value, "quotes" => $quotes, "type" => self::TYPE_OR];
        return $this;
    }

    /**
     * 
     * @param \System\DataBase\Entities\Conditionals $conditionals
     * @return $this
     */
    public function group(Conditionals $conditionals): self {
        $this->wheres[] = ["operator" => "GROUP", "conditionals" => $conditionals, "type" => self::TYPE_AND];
        return $this;
    }

    /**
     * 
     * @param \System\DataBase\Entities\Conditionals $conditionals
     * @return $this
     */
    public function orGroup(Conditionals $conditionals): self {
        $this->wheres[] = ["operator" => "GROUP", "conditionals" => $conditionals, "type" => self::TYPE_OR];
        return $this;
    }

    /**
     * 
     * @return array
     */
    public function getWheres(): array {
        return $this->wheres;
    }

    public function clear():self{
        $this->wheres = [];
        return $this;
    }
}