<?php

namespace App\Imports;

use App\Models\Enrollment;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EnrollmentImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // ✅ Log the received data from Excel
        Log::info("📥 Imported Row: " . json_encode($row));

        // ✅ Check if AlphaMark is missing and calculate it
        $alphaMark = $row['alphamark'] ?? $this->convertToAlpha($row['numericmark']);

        // ✅ Log the computed AlphaMark
        Log::info("🔠 Converted Alpha Mark: " . $alphaMark);

        return new Enrollment([
            'StudentID'   => $row['studentid'],
            'SectionID'   => $row['sectionid'],
            'NumericMark' => $row['numericmark'],
            'AlphaMark'   => $alphaMark,
            'Completed'   => $row['completed'],
        ]);
    }

    /**
     * 📌 Convert Numeric Mark to Alpha Mark
     */
    private function convertToAlpha($numericMark)
    {
        if ($numericMark >= 90) return 'A';
        if ($numericMark >= 80) return 'B';
        if ($numericMark >= 70) return 'C';
        if ($numericMark >= 60) return 'D';
        return 'F';
    }
}
