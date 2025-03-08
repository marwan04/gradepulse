<?php

namespace App\Imports;

use App\Models\Enrollment;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class EnrollmentImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Log the imported row for debugging
        Log::info("🔹 Imported Row Data: " . json_encode($row));

        // Ensure the key exists and is properly retrieved
        $numericMark = isset($row['numericmark']) ? $row['numericmark'] : null;
        $alphaMark = isset($row['alphamark']) ? $row['alphamark'] : null;

        Log::info("🔍 Extracted NumericMark: " . $numericMark);
        Log::info("🔍 Extracted AlphaMark Before Calculation: " . ($alphaMark ?? 'NULL'));

        // If AlphaMark is missing, calculate it
        if (empty($alphaMark)) {
            Log::info("⚠ AlphaMark is missing. Calculating...");
            $alphaMark = $this->calculateAlphaMark($numericMark);
            Log::info("✅ Calculated AlphaMark: " . $alphaMark);
        }

        // Log the final data before inserting it
        Log::info("🟢 Final Data for Database Insert: " . json_encode([
            'StudentID'   => $row['studentid'],
            'SectionID'   => $row['sectionid'],
            'NumericMark' => $numericMark,
            'AlphaMark'   => $alphaMark,
            'Completed'   => $row['completed'],
        ]));

        return new Enrollment([
            'StudentID'   => $row['studentid'],
            'SectionID'   => $row['sectionid'],
            'NumericMark' => $numericMark,
            'AlphaMark'   => $alphaMark,
            'Completed'   => $row['completed'],
        ]);
    }

    /**
     * Convert NumericMark to AlphaMark based on grading scale.
     */
    private function calculateAlphaMark($numericMark)
    {
        if ($numericMark >= 90) {
            return 'A';
        } elseif ($numericMark >= 80) {
            return 'B';
        } elseif ($numericMark >= 70) {
            return 'C';
        } elseif ($numericMark >= 60) {
            return 'D';
        } else {
            return 'F';
        }
    }
}
