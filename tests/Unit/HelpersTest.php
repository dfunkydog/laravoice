<?php

namespace Tests\Unit;

use Tests\TestCase;

class helpers extends TestCase
{
/**
     * Test to ensure the proper ordinal indicator is applied to values passed
     * to the str_ordinal helper function.
     * @test
     *
     * @return void
     */
    public function string_ordinal_helper_displays_correct_suffix()
    {
        $this->assertEquals('0th', str_ordinal('foo'));
        $this->assertEquals('0th', str_ordinal(0));
        $this->assertEquals('0th', str_ordinal('0'));
        $this->assertEquals('1st', str_ordinal('1'));
        $this->assertEquals('2nd', str_ordinal('2'));
        $this->assertEquals('3rd', str_ordinal('3'));
        $this->assertEquals('4th', str_ordinal('4'));
        $this->assertEquals('11th', str_ordinal('11'));
        $this->assertEquals('112th', str_ordinal('112'));
        $this->assertEquals('1,113th', str_ordinal('1113'));
        $this->assertEquals('1,000<sup>th</sup>', str_ordinal('1000', true));
    }
}
