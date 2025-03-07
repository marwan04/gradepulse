<?php

namespace App\Imports;

use App\Models\Enrollment;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; // <-- أضف هذا السطر

class EnrollmentImport implements ToModel, WithHeadingRow // أضف WithHeadingRow هنا
{
    public function model(array $row)
    {
        return new Enrollment([
            // انتبه أن المفاتيح هنا تُطابق عناوين الأعمدة في ملف إكسل
            'StudentID'   => $row['studentid'],
            'SectionID'   => $row['sectionid'],
            'NumericMark' => $row['numericmark'],
            'AlphaMark'   => $row['alphamark'],
            'Completed'   => $row['completed'],
        ]);
    }
}

