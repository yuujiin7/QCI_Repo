<?php

namespace App\Imports;

use App\Models\MaintenanceAgreement;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; // This skips the header row
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class MaintenanceAgreementsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Check if the coverage key exists
        if (!isset($row['coverage'])) {
            Log::error('Coverage key missing in the row', $row);
            return null; // Skip this row if coverage is missing
        }

        // Assuming the coverage date is in column L (coverage)
        $coverageDate = trim($row['coverage']); // Column 'L'

        // Split coverage date into start and end dates
        if (strpos($coverageDate, ' - ') !== false) {
            list($startDate, $endDate) = explode(' - ', $coverageDate);

            // Use Carbon for date formatting
            $startDate = Carbon::parse($startDate)->format('Y-m-d');
            $endDate = Carbon::parse($endDate)->format('Y-m-d');
        } else {
            Log::error('Coverage date format is incorrect in the row', $row);
            return null; // Skip the row if coverage date is invalid
        }

        // Set status depending on the current date
        $status = Carbon::now()->between($startDate, $endDate) ? 'active' : 'expired';

        // Check if other required fields are set before creating the model
        // if (!isset($row['serial_numbers']) || !isset($row['distributor']) || !isset($row['po_number'])) {
        //     Log::error('Required fields are missing in the row', $row);
        //     return null; // Skip this row if required fields are missing
        // }

        // account manager and account manager id are non-nullable fields
        // If they are not set, add default values
        $account_manager = $row['account_manager'] ?? 'N/A'; // Column 'M'
        $account_manager_id = $row['account_manager_id'] ?? 'N/A'; // Column 'N'

        return new MaintenanceAgreement([
            'serial_number'       => $row['serial_numbers'] ?? 'N/A', // Column 'H'
            'date_history'        => json_encode([
                'coverage_start' => $startDate,
                'coverage_end'   => $endDate,
            ]), // Store as JSON
            'start_date'          => $startDate, // Start date
            'end_date'            => $endDate,   // End date
            'distributor'         => $row['distributor'] ?? 'N/A', // Column 'A'
            'PO_number'           => $row['po_number'] ?? 'N/A', // Column 'B'
            'company_name'        => $row['company_name'] ?? 'N/A', // Column 'C'
            'project_name'        => $row['project_name'] ?? 'N/A', // Column 'D'
            'supp_acc_ref'        => $row['support_account_reference'] ?? 'N/A', // Column 'E'
            'service_agreement'   => $row['service_agreement_id'] ?? 'N/A', // Column 'F'
            'model_description'   => $row['model_description'] ?? 'N/A', // Column 'G'
            'product_number'      => $row['product_number'] ?? 'N/A', // Column 'I'
            'service_level'       => $row['sla'] ?? 'N/A', // Column 'J'
            'location'            => $row['location'] ?? 'N/A', // Column 'K'
            'status'              => $status, // Set the status
            'account_manager'     => $account_manager, // Column 'M'
            'account_manager_id'  => $account_manager_id, // Column 'N'
        ]);
    }
}
