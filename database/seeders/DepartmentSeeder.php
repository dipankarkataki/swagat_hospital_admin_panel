<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $departments = [
            'GENERAL SURGERY LAPAROSCOPIC & MINIMAL ACCESS SURGERY, BARIATRIC AND ROBOTIC SURGERY', 
            'DEPARTMENT OF GASTROENTEROLOGY& GI SURGERY', 'ONCOSURGERY (CANCER)', 'ENT AND HEAD & NECK SURGERY', 
            'ANESTHESIOLOGY & CRITICAL CARE', 'NEURO- SCIENCES', 'ORTHOPAEDICS', 'UROLOGY & NEPHROLOGY', 
            'CARDIOLOGY & CTVS', 'PLASTIC SURGERY', 'GENERAL MEDICINE, PULMONARY MEDICINE, DIABETOLOGY & ENDOCRINOLOGY', 
            'OBSTETRICS and GYNAECOLOGY', 'PAEDIATRICS', 'PSYCHIATRY & MENTAL HEALTH', 'DERMATOLOGY & AESTHETIC', 
            'RHEUMATOLOGY & HAEMATOLOGY', 'PATHOLOGY', 'RADIOLOGY', 'DENTISTRY', 'SUPERINTENDENT', 
            'RESIDENT MEDICAL OFFICER'
        ];

        foreach($departments as $department){
            Department::create([
                'name' => $department
            ]);
        }
        
    }
}