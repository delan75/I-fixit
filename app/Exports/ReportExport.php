<?php

namespace App\Exports;

use App\Models\Report;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithStyles, ShouldAutoSize
{
    protected $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Return data based on report type
        switch ($this->report->reportType->slug) {
            case 'profitability-analysis':
                return $this->getProfitabilityData();
            case 'repair-cost-analysis':
                return $this->getRepairCostData();
            case 'sales-performance':
                return $this->getSalesPerformanceData();
            case 'time-at-dealership':
                return $this->getTimeAtDealershipData();
            case 'investment-summary':
                return $this->getInvestmentSummaryData();
            default:
                return collect([]);
        }
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Return headings based on report type
        switch ($this->report->reportType->slug) {
            case 'profitability-analysis':
                return [
                    'Car', 'Purchase Price', 'Repair Cost', 'Selling Price', 'Profit', 'ROI (%)'
                ];
            case 'repair-cost-analysis':
                return [
                    'Car', 'Parts Cost', 'Labor Cost', 'Painting Cost', 'Total Repair Cost', 'Estimated Cost', 'Difference'
                ];
            case 'sales-performance':
                return [
                    'Car', 'Sale Date', 'Asking Price', 'Selling Price', 'Days at Dealership'
                ];
            case 'time-at-dealership':
                return [
                    'Car', 'Days at Dealership', 'Status'
                ];
            case 'investment-summary':
                return [
                    'Car', 'Status', 'Days Owned', 'Purchase Price', 'Repair Cost', 'Total Investment', 'Value', 'Profit/Loss'
                ];
            default:
                return [];
        }
    }

    /**
     * @param mixed $row
     * @return array
     */
    public function map($row): array
    {
        // Map data based on report type
        switch ($this->report->reportType->slug) {
            case 'profitability-analysis':
                return [
                    $row['year'] . ' ' . $row['make'] . ' ' . $row['model'],
                    $row['purchase_price'],
                    $row['repair_cost'],
                    $row['selling_price'],
                    $row['profit'],
                    $row['roi']
                ];
            case 'repair-cost-analysis':
                return [
                    $row['year'] . ' ' . $row['make'] . ' ' . $row['model'],
                    $row['parts_cost'],
                    $row['labor_cost'],
                    $row['painting_cost'],
                    $row['total_repair_cost'],
                    $row['estimated_cost'],
                    $row['difference']
                ];
            case 'sales-performance':
                return [
                    $row['year'] . ' ' . $row['make'] . ' ' . $row['model'],
                    $row['sale_date'],
                    $row['asking_price'],
                    $row['selling_price'],
                    $row['days_at_dealership']
                ];
            case 'time-at-dealership':
                return [
                    $row['year'] . ' ' . $row['make'] . ' ' . $row['model'],
                    $row['days_at_dealership'],
                    $row['is_sold'] ? 'Sold' : 'At Dealership'
                ];
            case 'investment-summary':
                return [
                    $row['year'] . ' ' . $row['make'] . ' ' . $row['model'],
                    $row['status'],
                    $row['days_owned'] ?? 0,
                    $row['purchase_price'] ?? 0,
                    $row['repair_cost'] ?? 0,
                    $row['total_investment'],
                    $row['value'],
                    $row['profit']
                ];
            default:
                return [];
        }
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->report->reportType->name;
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row (headings)
            1 => ['font' => ['bold' => true]],
        ];
    }

    /**
     * Get profitability data for export
     */
    private function getProfitabilityData()
    {
        if (isset($this->report->data['cars'])) {
            return collect($this->report->data['cars']);
        }
        return collect([]);
    }

    /**
     * Get repair cost data for export
     */
    private function getRepairCostData()
    {
        // If cars data is not available, create a simple summary
        $data = $this->report->data;

        // Create a single row with summary data
        $summaryRow = [
            'year' => date('Y'),
            'make' => 'Summary',
            'model' => '',
            'parts_cost' => $data['cost_by_category']['parts'] ?? 0,
            'labor_cost' => $data['cost_by_category']['labor'] ?? 0,
            'painting_cost' => $data['cost_by_category']['painting'] ?? 0,
            'total_repair_cost' => ($data['cost_by_category']['parts'] ?? 0) +
                                  ($data['cost_by_category']['labor'] ?? 0) +
                                  ($data['cost_by_category']['painting'] ?? 0),
            'estimated_cost' => $data['estimated_vs_actual']['estimated'] ?? 0,
            'difference' => $data['estimated_vs_actual']['difference'] ?? 0
        ];

        return collect([$summaryRow]);
    }

    /**
     * Get sales performance data for export
     */
    private function getSalesPerformanceData()
    {
        if (isset($this->report->data['cars'])) {
            return collect($this->report->data['cars']);
        }
        return collect([]);
    }

    /**
     * Get time at dealership data for export
     */
    private function getTimeAtDealershipData()
    {
        if (isset($this->report->data['cars'])) {
            return collect($this->report->data['cars']);
        }
        return collect([]);
    }

    /**
     * Get investment summary data for export
     */
    private function getInvestmentSummaryData()
    {
        $data = $this->report->data;

        // Check if we have car details
        if (isset($data['cars']) && count($data['cars']) > 0) {
            return collect($data['cars']);
        }

        // If monthly trends are available, return those instead
        if (isset($data['monthly_trends']) && count($data['monthly_trends']) > 0) {
            $monthlyData = collect($data['monthly_trends'])->map(function($month) {
                return [
                    'year' => substr($month['month_name'], -4),
                    'make' => 'Month',
                    'model' => substr($month['month_name'], 0, 3),
                    'status' => $month['cars_purchased'] . ' purchased, ' . $month['cars_sold'] . ' sold',
                    'purchase_price' => $month['investment'],
                    'repair_cost' => 0,
                    'total_investment' => $month['investment'],
                    'value' => $month['revenue'],
                    'profit' => $month['net_flow']
                ];
            });

            return $monthlyData;
        }

        // If investment by make is available, return those
        if (isset($data['investment_by_make']) && count($data['investment_by_make']) > 0) {
            $makeData = collect();

            foreach ($data['investment_by_make'] as $make => $makeInfo) {
                $makeData->push([
                    'year' => date('Y'),
                    'make' => $make,
                    'model' => 'All Models',
                    'status' => $makeInfo['sold_count'] . ' sold, ' . $makeInfo['unsold_count'] . ' unsold',
                    'purchase_price' => 0,
                    'repair_cost' => 0,
                    'total_investment' => $makeInfo['total_investment'],
                    'value' => $makeInfo['potential_value'],
                    'profit' => $makeInfo['potential_profit']
                ]);
            }

            return $makeData;
        }

        // Fallback to summary data
        $summaryRow = [
            'year' => date('Y'),
            'make' => 'Summary',
            'model' => 'All Cars',
            'status' => $data['sold_cars'] . ' sold, ' . $data['unsold_cars'] . ' unsold',
            'purchase_price' => $data['investment_by_category']['purchase'] ?? 0,
            'repair_cost' => ($data['investment_by_category']['parts'] ?? 0) +
                            ($data['investment_by_category']['labor'] ?? 0) +
                            ($data['investment_by_category']['painting'] ?? 0),
            'total_investment' => $data['total_investment'] ?? 0,
            'value' => $data['potential_value'] ?? 0,
            'profit' => $data['potential_profit'] ?? 0
        ];

        return collect([$summaryRow]);
    }
}
