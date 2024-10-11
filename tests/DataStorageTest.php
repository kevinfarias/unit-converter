<?php

use Skoyah\Converter\DataStorage;
use PHPUnit\Framework\TestCase;

class DataStorageConvertionTest extends TestCase
{
    /** @test */
    public function it_sets_mega_bytes_as_base_unit()
    {
        $dataStorage = new DataStorage(1, 'mb');
        
        $this->assertEquals('mb', $dataStorage->base());
    }

    /** @test */
    public function it_converts_from_mega_bytes_to_different_data_storage_units()
    {
        $dataStorage = new DataStorage(1, 'mb');

        $this->assertEquals(1024, $dataStorage->to('kb'));
        $this->assertEquals(1 , $dataStorage->to('mb'));
        $this->assertEquals(0.0009765625 , $dataStorage->to('gb'));
        $this->assertEquals(0.00000095367431640625 , $dataStorage->to('tb'));

        die(var_dump($dataStorage));
    }
}
