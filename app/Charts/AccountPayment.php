<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
// use PhpOffice\PhpSpreadsheet\Reader\Xlsx\Chart;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Chartisan\PHP\Chartisan;

class AccountPayment extends BaseChart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function handler(Request $request): Chartisan
    {
        return Chartisan::build()
            ->labels(['First', 'Second', 'Third'])
            ->dataset('Sample', [1, 2, 3])
            ->dataset('Sample 2', [3, 2, 1]);
    }
}

