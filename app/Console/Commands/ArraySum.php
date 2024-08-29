<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ArraySum extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:array_sum {data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate the sum of Nested array';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = $this->argument('data');
        $decodedData = json_decode($data, true);
        if (json_last_error() !== JSON_ERROR_NONE ||!is_array($decodedData)) {
            $this->error("Invalid input: The argument is not a valid array.");
            return;
        }
        $sum = $this->sumArray($decodedData);
        $this->info($sum);
    }
    private function sumArray($array)
    {
        $sum = 0;

        foreach ($array as $item) {
            if (is_array($item)) {
                $sum += $this->sumArray($item);
            } elseif (is_numeric($item)) {
                $sum += $item;
            }
            else {
                $this->error("Invalid input:Invalid array element.{$item}");
                return;
            }
        }
        return $sum;
    }
}
