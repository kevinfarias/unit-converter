<?php

use Skoyah\Converter\Pressure;
use PHPUnit\Framework\TestCase;

class PressureConvertionTest extends TestCase
{
    /** @test */
    public function it_has_pascal_unit_as_the_base_unit_for_convertions()
    {
        $pressure = new Pressure(1, 'bar');

        $this->assertEquals('pascals', $pressure->base());
    }

    /** @test */
    public function it_converts_from_pascals_to_different_pressure_units()
    {
        $pressure = new Pressure(1, 'pa');

        $this->assertEquals(0.00001, $pressure->to('bar'));
        $this->assertEquals(0.01, $pressure->to('mbar'));
        $this->assertEquals(1000, $pressure->to('mpa'));
        $this->assertEquals(1, $pressure->to('pa'));
        $this->assertEquals(1000, $pressure->to('kpa'));
        $this->assertEquals(0.00014503773772954367, $pressure->to('psi'));
        $this->assertEquals(1.4503773772954366E-7, $pressure->to('ksi'));
        $this->assertEquals(9.869232667160129E-6, $pressure->to('atm'));
    }
}
