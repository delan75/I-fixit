<?php

namespace Database\Seeders;

use App\Models\ReportType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ReportTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reportTypes = [
            [
                'name' => 'Profitability Analysis',
                'slug' => 'profitability-analysis',
                'description' => 'Analyze profitability across different car makes, models, and time periods',
                'icon' => 'fa-chart-line',
                'chart_type' => 'bar',
            ],
            [
                'name' => 'Repair Cost Analysis',
                'slug' => 'repair-cost-analysis',
                'description' => 'Analyze repair costs by category and compare against estimates',
                'icon' => 'fa-wrench',
                'chart_type' => 'pie',
            ],
            [
                'name' => 'Sales Performance',
                'slug' => 'sales-performance',
                'description' => 'Track sales performance over time and by vehicle type',
                'icon' => 'fa-dollar-sign',
                'chart_type' => 'line',
            ],
            [
                'name' => 'Time at Dealership',
                'slug' => 'time-at-dealership',
                'description' => 'Analyze how long vehicles spend at the dealership before sale',
                'icon' => 'fa-clock',
                'chart_type' => 'bar',
            ],
            [
                'name' => 'Investment Summary',
                'slug' => 'investment-summary',
                'description' => 'Overview of all investments, costs, and returns',
                'icon' => 'fa-file-invoice-dollar',
                'chart_type' => 'bar',
            ],
        ];

        foreach ($reportTypes as $reportType) {
            // Check if report type already exists
            $exists = ReportType::where('slug', $reportType['slug'])->exists();
            if (!$exists) {
                ReportType::create($reportType);
            }
        }
    }
}
