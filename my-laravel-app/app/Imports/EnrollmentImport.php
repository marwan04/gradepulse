<?php

namespace App\Imports;

use App\Models\Enrollment;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EnrollmentImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
\Log::info('Imported Row: ', $row);
        return new Enrollment([
            'StudentID'   => (int) $row['studentid'],
            'SectionID'   => (int) $row['sectionid'],
            'NumericMark' => (float) $row['numericmark'],
            'AlphaMark'   => strtoupper($row['alphamark']),
            'Completed'   => (int) $row['completed'],
        ]);
    }
}

