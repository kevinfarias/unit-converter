<?php

namespace Skoyah\Converter;

use Skoyah\Converter\Exceptions\InvalidUnitException;

abstract class Unit
{
    /**
     * Array of convertion formulas.
     *
     * @var array $formulas
     */
    protected $formulas;

    /**
     * Array of units and its aliases.
     *
     * @var array $aliases
     */
    protected $aliases;

    /**
     * The unit quantity.
     *
     * @var int $quantity
     */
    protected $quantity;

    /**
     * The type of unit defined upon instantiation.
     *
     * @var string $unit
     */
    protected $unit;

    /**
     * The base unit value used for all conversions.
     *
     * @var int $base
     */
    protected $base;

    /**
     * Sets the core properties.
     *
     * @param integer $quantity
     * @param string $unit
     */
    public function __construct($quantity, $unit)
    {
        $this->loadConfigFile();
        $this->quantity = $this->validateQuantity($quantity);
        $this->unit = $this->validateUnit($unit);
        $this->base = $this->calculateBaseUnit();
    }

    /**
     * Gets the configuration settings for the specified unit type.
     */
    private function loadConfigFile()
    {
        $config = require __DIR__ . "/config/{$this->configKey}.php";

        $this->aliases = $config['aliases'];
        $this->formulas = $config['formulas'];
    }

    public function getFormulas(): array
    {
        return $this->formulas;
    }

    /**
     * Validates and formats the unit type provided during instantiation.
     *
     * @param string $unit
     * @return string
     */
    private function validateUnit($unit)
    {
        $unit = strtolower($unit);

        if (!$this->isAlias($unit) && !array_key_exists($unit, $this->formulas)) {
            throw new InvalidUnitException(sprintf('Unknown unit type: [%s] in [%s.php] configuration file.', $unit, $this->configKey));
        }

        return $this->isAlias($unit) ? $this->aliases[$unit] : $unit;
    }

    /**
     * Validates the quantity provided during instantiation.
     *
     * @param integer $quantity
     * @return integer $quantity
     */
    private function validateQuantity($quantity)
    {
        if (!is_int($quantity) && !is_float($quantity) || $quantity < 0) {
            throw new \InvalidArgumentException(sprintf('The quantity must be a positive number: %s given (%s).', gettype($quantity), $quantity));
        }

        return $quantity;
    }

    /**
     * Executes the convertion.
     *
     * @param string $unit
     * @return integer|float
     */
    public function to($unit, $precision = null)
    {
        if ($this->isAlias($unit)) {
            $unit = $this->aliases[$unit];
        }

        return $this->calculate($unit, $precision);
    }

    /**
     * Sets the unit to be used for all conversions.
     *
     * @return integer|float
     */
    private function calculateBaseUnit()
    {
        if (is_callable($this->formulas[$this->unit])) {
            return $this->formulas[$this->unit]($this->quantity, true);
        }

        return $this->quantity * $this->formulas[$this->unit];
    }

    /**
     * Verifies if intended unit belongs has an abbreviation.
     *
     * @param string $unit
     * @return boolean
     */
    private function isAlias($unit)
    {
        return array_key_exists($unit, $this->aliases);
    }

    /**
     * Calculates the convertion.
     *
     * @param string $unit
     * @param integer|null $precision
     * @return integer|float
     */
    private function calculate($unit, $precision)
    {
        if (is_callable($this->formulas[$unit])) {
            return $this->formulas[$unit]($this->base);
        }

        if ($precision) {
            return round($this->base / $this->formulas[$unit], $precision, PHP_ROUND_HALF_UP);
        }

        return $this->base / $this->formulas[$unit];
    }

    /**
     * Gets the base unit to be used on convertions for the current unit type.
     *
     * @return string
     */
    public function base()
    {
        $bases = require 'config/bases.php';

        return $bases[$this->configKey];
    }
}
