<?php

namespace Tests\Feature;

use Tests\TestCase;

class PartoneTest extends TestCase
{
    public function test_array_sum_command()
    {
        $this->artisan('run:array_sum', [
            'data' => '[1,2,[3,4,[5,6,[7]]]]',
        ])->assertExitCode(0)
          ->expectsOutput('28');

        $this->artisan('run:array_sum', [
            'data' => 'invalid',
        ])->assertExitCode(0)
          ->expectsOutput('Invalid input: The argument is not a valid array.');


        $this->artisan('run:array_sum', [
            'data' => '[1,2,[3,4,[5,6,[true]]]]',
        ])->assertExitCode(0)
          ->expectsOutput('Invalid input:Invalid array element.1');


        $this->artisan('run:array_sum', [
            'data' => '[]',
        ])->assertExitCode(0)
          ->expectsOutput('0');
    }

    public function test_string_replace_command()
    {

        $this->artisan('run:string_replace', [
            'template' => '{1}_{0}',
            'arguments' => ['hello', 'world'],
        ])->assertExitCode(0)
          ->expectsOutput('world_hello');


        $this->artisan('run:string_replace', [
            'template' => '{1}_hello_{0}',
            'arguments' => ['test', 'world'],
        ])->assertExitCode(0)
          ->expectsOutput('world_hello_test');


        $this->artisan('run:string_replace', [
            'template' => '{1}_{2}_{0}',
            'arguments' => ['test', 'tree'],
        ])->assertExitCode(0)
          ->expectsOutput('tree_{2}_test');


        $this->artisan('run:string_replace', [
            'template' => '{0}_{1}',
            'arguments' => ['a', 'b', 'c'],
        ])->assertExitCode(0)
          ->expectsOutput('a_b');
    }
    }
