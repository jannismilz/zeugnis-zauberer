<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\AssignmentType;
use App\Models\FinalGrade;
use App\Models\FinalGradeType;
use App\Models\Grade;
use App\Models\Location;
use App\Models\SchoolClass;
use App\Models\SchoolClassType;
use App\Models\Subject;
use App\Models\SubjectType;
use App\Models\User;
use App\Models\UserSchoolClass;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create locations
        $locations = [
            Location::create(['name' => 'Bern']),
            Location::create(['name' => 'Zürich']),
            Location::create(['name' => 'Basel']),
        ];
        
        // Create users
        $users = [
            User::create([
                'name' => 'Zeugnis Zauberer',
                'username' => 'zauberer',
                'email' => 'zauberer@bsiag.com',
                'password' => Hash::make('test1234'),
                'apprentice_start' => Carbon::parse("2022-08-01"),
                'location_id' => $locations[0]->id
            ]),
            User::create([
                'name' => 'Max Muster',
                'username' => 'max.muster',
                'email' => 'max.muster@bsiag.com',
                'password' => Hash::make('test1234'),
                'apprentice_start' => Carbon::parse("2023-08-01"),
                'location_id' => $locations[1]->id
            ]),
            User::create([
                'name' => 'Anna Schmidt',
                'username' => 'anna.schmidt',
                'email' => 'anna.schmidt@bsiag.com',
                'password' => Hash::make('test1234'),
                'apprentice_start' => Carbon::parse("2024-08-01"),
                'location_id' => $locations[2]->id
            ]),
            User::create([
                'name' => 'Visitor User',
                'username' => 'visitor',
                'email' => 'visitor@bsiag.com',
                'password' => Hash::make('test1234'),
                'apprentice_start' => null,
                'location_id' => $locations[0]->id
            ]),
        ];
        
        // Create school class types
        $schoolClassTypes = [
            SchoolClassType::create(['name' => 'BMS']),
            SchoolClassType::create(['name' => 'Berufsschule']),
            SchoolClassType::create(['name' => 'ABU']),
        ];
        
        // Create school classes
        $schoolClasses = [
            SchoolClass::create([
                'name' => '6MT22k',
                'school_class_type_id' => $schoolClassTypes[0]->id
            ]),
            SchoolClass::create([
                'name' => '5IA22b',
                'school_class_type_id' => $schoolClassTypes[1]->id
            ]),
            SchoolClass::create([
                'name' => '5II22b',
                'school_class_type_id' => $schoolClassTypes[2]->id
            ]),
        ];
        
        // Create user-school class relationships
        UserSchoolClass::create([
            'user_id' => $users[0]->id,
            'school_class_id' => $schoolClasses[0]->id
        ]);
        UserSchoolClass::create([
            'user_id' => $users[1]->id,
            'school_class_id' => $schoolClasses[1]->id
        ]);
        UserSchoolClass::create([
            'user_id' => $users[2]->id,
            'school_class_id' => $schoolClasses[2]->id
        ]);
        
        // Create subject types
        $subjectTypes = [
            SubjectType::create(['name' => 'Allgemeinbildung']),
            SubjectType::create(['name' => 'Fachkunde']),
            SubjectType::create(['name' => 'Sport']),
        ];
        
        // Create subjects
        $subjects = [
            Subject::create([
                'name' => 'Mathematik',
                'subject_type_id' => $subjectTypes[0]->id
            ]),
            Subject::create([
                'name' => 'Programmierung',
                'subject_type_id' => $subjectTypes[1]->id
            ]),
            Subject::create([
                'name' => 'Datenbanken',
                'subject_type_id' => $subjectTypes[1]->id
            ]),
            Subject::create([
                'name' => 'Sport',
                'subject_type_id' => $subjectTypes[2]->id
            ]),
        ];
        
        // Create assignment types
        $assignmentTypes = [
            AssignmentType::create(['name' => 'Prüfung']),
            AssignmentType::create(['name' => 'Projekt']),
            AssignmentType::create(['name' => 'Hausaufgabe']),
        ];
        
        // Create assignments
        $assignments = [
            Assignment::create([
                'name' => 'Mathematik Prüfung 1',
                'school_class_id' => $schoolClasses[0]->id,
                'subject_id' => $subjects[0]->id,
                'assignment_type_id' => $assignmentTypes[0]->id,
                'weight' => 1.0
            ]),
            Assignment::create([
                'name' => 'Programmierung Projekt',
                'school_class_id' => $schoolClasses[0]->id,
                'subject_id' => $subjects[1]->id,
                'assignment_type_id' => $assignmentTypes[1]->id,
                'weight' => 2.0
            ]),
            Assignment::create([
                'name' => 'Datenbank Hausaufgabe',
                'school_class_id' => $schoolClasses[1]->id,
                'subject_id' => $subjects[2]->id,
                'assignment_type_id' => $assignmentTypes[2]->id,
                'weight' => 0.5
            ]),
        ];
        
        // Create grades
        Grade::create([
            'user_id' => $users[0]->id,
            'assignment_id' => $assignments[0]->id,
            'grade' => 5.5
        ]);
        Grade::create([
            'user_id' => $users[0]->id,
            'assignment_id' => $assignments[1]->id,
            'grade' => 6.0
        ]);
        Grade::create([
            'user_id' => $users[1]->id,
            'assignment_id' => $assignments[2]->id,
            'grade' => 4.5
        ]);
        
        // Create final grade types
        $finalGradeTypes = [
            FinalGradeType::create(['name' => 'Semesterzeugnis']),
            FinalGradeType::create(['name' => 'Jahreszeugnis']),
            FinalGradeType::create(['name' => 'Abschlusszeugnis']),
        ];
        
        // Create final grades
        FinalGrade::create([
            'user_id' => $users[0]->id,
            'subject_id' => $subjects[0]->id,
            'final_grade_type_id' => $finalGradeTypes[0]->id,
            'grade' => 5.5,
            'weight' => 1.0
        ]);
        FinalGrade::create([
            'user_id' => $users[0]->id,
            'subject_id' => $subjects[1]->id,
            'final_grade_type_id' => $finalGradeTypes[0]->id,
            'grade' => 5.8,
            'weight' => 2.0
        ]);
        FinalGrade::create([
            'user_id' => $users[1]->id,
            'subject_id' => $subjects[2]->id,
            'final_grade_type_id' => $finalGradeTypes[1]->id,
            'grade' => 4.8,
            'weight' => 1.5
        ]);
    }
}
