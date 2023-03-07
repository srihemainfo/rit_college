<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'tool_access',
            ],
            [
                'id'    => 20,
                'title' => 'tools_degree_type_create',
            ],
            [
                'id'    => 21,
                'title' => 'tools_degree_type_edit',
            ],
            [
                'id'    => 22,
                'title' => 'tools_degree_type_show',
            ],
            [
                'id'    => 23,
                'title' => 'tools_degree_type_delete',
            ],
            [
                'id'    => 24,
                'title' => 'tools_degree_type_access',
            ],
            [
                'id'    => 25,
                'title' => 'academic_year_create',
            ],
            [
                'id'    => 26,
                'title' => 'academic_year_edit',
            ],
            [
                'id'    => 27,
                'title' => 'academic_year_show',
            ],
            [
                'id'    => 28,
                'title' => 'academic_year_delete',
            ],
            [
                'id'    => 29,
                'title' => 'academic_year_access',
            ],
            [
                'id'    => 30,
                'title' => 'batch_create',
            ],
            [
                'id'    => 31,
                'title' => 'batch_edit',
            ],
            [
                'id'    => 32,
                'title' => 'batch_show',
            ],
            [
                'id'    => 33,
                'title' => 'batch_delete',
            ],
            [
                'id'    => 34,
                'title' => 'batch_access',
            ],
            [
                'id'    => 35,
                'title' => 'tools_course_create',
            ],
            [
                'id'    => 36,
                'title' => 'tools_course_edit',
            ],
            [
                'id'    => 37,
                'title' => 'tools_course_show',
            ],
            [
                'id'    => 38,
                'title' => 'tools_course_delete',
            ],
            [
                'id'    => 39,
                'title' => 'tools_course_access',
            ],
            [
                'id'    => 40,
                'title' => 'tools_department_create',
            ],
            [
                'id'    => 41,
                'title' => 'tools_department_edit',
            ],
            [
                'id'    => 42,
                'title' => 'tools_department_show',
            ],
            [
                'id'    => 43,
                'title' => 'tools_department_delete',
            ],
            [
                'id'    => 44,
                'title' => 'tools_department_access',
            ],
            [
                'id'    => 45,
                'title' => 'section_create',
            ],
            [
                'id'    => 46,
                'title' => 'section_edit',
            ],
            [
                'id'    => 47,
                'title' => 'section_show',
            ],
            [
                'id'    => 48,
                'title' => 'section_delete',
            ],
            [
                'id'    => 49,
                'title' => 'section_access',
            ],
            [
                'id'    => 50,
                'title' => 'semester_create',
            ],
            [
                'id'    => 51,
                'title' => 'semester_edit',
            ],
            [
                'id'    => 52,
                'title' => 'semester_show',
            ],
            [
                'id'    => 53,
                'title' => 'semester_delete',
            ],
            [
                'id'    => 54,
                'title' => 'semester_access',
            ],
            [
                'id'    => 55,
                'title' => 'course_enroll_master_create',
            ],
            [
                'id'    => 56,
                'title' => 'course_enroll_master_edit',
            ],
            [
                'id'    => 57,
                'title' => 'course_enroll_master_show',
            ],
            [
                'id'    => 58,
                'title' => 'course_enroll_master_delete',
            ],
            [
                'id'    => 59,
                'title' => 'course_enroll_master_access',
            ],
            [
                'id'    => 60,
                'title' => 'toolssyllabus_year_create',
            ],
            [
                'id'    => 61,
                'title' => 'toolssyllabus_year_edit',
            ],
            [
                'id'    => 62,
                'title' => 'toolssyllabus_year_show',
            ],
            [
                'id'    => 63,
                'title' => 'toolssyllabus_year_delete',
            ],
            [
                'id'    => 64,
                'title' => 'toolssyllabus_year_access',
            ],
            [
                'id'    => 65,
                'title' => 'academic_detail_create',
            ],
            [
                'id'    => 66,
                'title' => 'academic_detail_edit',
            ],
            [
                'id'    => 67,
                'title' => 'academic_detail_show',
            ],
            [
                'id'    => 68,
                'title' => 'academic_detail_delete',
            ],
            [
                'id'    => 69,
                'title' => 'academic_detail_access',
            ],
            [
                'id'    => 70,
                'title' => 'personal_detail_create',
            ],
            [
                'id'    => 71,
                'title' => 'personal_detail_edit',
            ],
            [
                'id'    => 72,
                'title' => 'personal_detail_show',
            ],
            [
                'id'    => 73,
                'title' => 'personal_detail_delete',
            ],
            [
                'id'    => 74,
                'title' => 'personal_detail_access',
            ],
            [
                'id'    => 75,
                'title' => 'educational_detail_create',
            ],
            [
                'id'    => 76,
                'title' => 'educational_detail_edit',
            ],
            [
                'id'    => 77,
                'title' => 'educational_detail_show',
            ],
            [
                'id'    => 78,
                'title' => 'educational_detail_delete',
            ],
            [
                'id'    => 79,
                'title' => 'educational_detail_access',
            ],
            [
                'id'    => 80,
                'title' => 'nationality_create',
            ],
            [
                'id'    => 81,
                'title' => 'nationality_edit',
            ],
            [
                'id'    => 82,
                'title' => 'nationality_show',
            ],
            [
                'id'    => 83,
                'title' => 'nationality_delete',
            ],
            [
                'id'    => 84,
                'title' => 'nationality_access',
            ],
            [
                'id'    => 85,
                'title' => 'religion_create',
            ],
            [
                'id'    => 86,
                'title' => 'religion_edit',
            ],
            [
                'id'    => 87,
                'title' => 'religion_show',
            ],
            [
                'id'    => 88,
                'title' => 'religion_delete',
            ],
            [
                'id'    => 89,
                'title' => 'religion_access',
            ],
            [
                'id'    => 90,
                'title' => 'blood_group_create',
            ],
            [
                'id'    => 91,
                'title' => 'blood_group_edit',
            ],
            [
                'id'    => 92,
                'title' => 'blood_group_show',
            ],
            [
                'id'    => 93,
                'title' => 'blood_group_delete',
            ],
            [
                'id'    => 94,
                'title' => 'blood_group_access',
            ],
            [
                'id'    => 95,
                'title' => 'community_create',
            ],
            [
                'id'    => 96,
                'title' => 'community_edit',
            ],
            [
                'id'    => 97,
                'title' => 'community_show',
            ],
            [
                'id'    => 98,
                'title' => 'community_delete',
            ],
            [
                'id'    => 99,
                'title' => 'community_access',
            ],
            [
                'id'    => 100,
                'title' => 'mother_tongue_create',
            ],
            [
                'id'    => 101,
                'title' => 'mother_tongue_edit',
            ],
            [
                'id'    => 102,
                'title' => 'mother_tongue_show',
            ],
            [
                'id'    => 103,
                'title' => 'mother_tongue_delete',
            ],
            [
                'id'    => 104,
                'title' => 'mother_tongue_access',
            ],
            [
                'id'    => 105,
                'title' => 'education_board_create',
            ],
            [
                'id'    => 106,
                'title' => 'education_board_edit',
            ],
            [
                'id'    => 107,
                'title' => 'education_board_show',
            ],
            [
                'id'    => 108,
                'title' => 'education_board_delete',
            ],
            [
                'id'    => 109,
                'title' => 'education_board_access',
            ],
            [
                'id'    => 110,
                'title' => 'student_create',
            ],
            [
                'id'    => 111,
                'title' => 'student_edit',
            ],
            [
                'id'    => 112,
                'title' => 'student_show',
            ],
            [
                'id'    => 113,
                'title' => 'student_delete',
            ],
            [
                'id'    => 114,
                'title' => 'student_access',
            ],
            [
                'id'    => 115,
                'title' => 'education_type_create',
            ],
            [
                'id'    => 116,
                'title' => 'education_type_edit',
            ],
            [
                'id'    => 117,
                'title' => 'education_type_show',
            ],
            [
                'id'    => 118,
                'title' => 'education_type_delete',
            ],
            [
                'id'    => 119,
                'title' => 'education_type_access',
            ],
            [
                'id'    => 120,
                'title' => 'scholarship_create',
            ],
            [
                'id'    => 121,
                'title' => 'scholarship_edit',
            ],
            [
                'id'    => 122,
                'title' => 'scholarship_show',
            ],
            [
                'id'    => 123,
                'title' => 'scholarship_delete',
            ],
            [
                'id'    => 124,
                'title' => 'scholarship_access',
            ],
            [
                'id'    => 125,
                'title' => 'subject_create',
            ],
            [
                'id'    => 126,
                'title' => 'subject_edit',
            ],
            [
                'id'    => 127,
                'title' => 'subject_show',
            ],
            [
                'id'    => 128,
                'title' => 'subject_delete',
            ],
            [
                'id'    => 129,
                'title' => 'subject_access',
            ],
            [
                'id'    => 130,
                'title' => 'mediumof_studied_create',
            ],
            [
                'id'    => 131,
                'title' => 'mediumof_studied_edit',
            ],
            [
                'id'    => 132,
                'title' => 'mediumof_studied_show',
            ],
            [
                'id'    => 133,
                'title' => 'mediumof_studied_delete',
            ],
            [
                'id'    => 134,
                'title' => 'mediumof_studied_access',
            ],
            [
                'id'    => 135,
                'title' => 'address_create',
            ],
            [
                'id'    => 136,
                'title' => 'address_edit',
            ],
            [
                'id'    => 137,
                'title' => 'address_show',
            ],
            [
                'id'    => 138,
                'title' => 'address_delete',
            ],
            [
                'id'    => 139,
                'title' => 'address_access',
            ],
            [
                'id'    => 140,
                'title' => 'parent_detail_create',
            ],
            [
                'id'    => 141,
                'title' => 'parent_detail_edit',
            ],
            [
                'id'    => 142,
                'title' => 'parent_detail_show',
            ],
            [
                'id'    => 143,
                'title' => 'parent_detail_delete',
            ],
            [
                'id'    => 144,
                'title' => 'parent_detail_access',
            ],
            [
                'id'    => 145,
                'title' => 'bank_account_detail_create',
            ],
            [
                'id'    => 146,
                'title' => 'bank_account_detail_edit',
            ],
            [
                'id'    => 147,
                'title' => 'bank_account_detail_show',
            ],
            [
                'id'    => 148,
                'title' => 'bank_account_detail_delete',
            ],
            [
                'id'    => 149,
                'title' => 'bank_account_detail_access',
            ],
            [
                'id'    => 150,
                'title' => 'experience_detail_create',
            ],
            [
                'id'    => 151,
                'title' => 'experience_detail_edit',
            ],
            [
                'id'    => 152,
                'title' => 'experience_detail_show',
            ],
            [
                'id'    => 153,
                'title' => 'experience_detail_delete',
            ],
            [
                'id'    => 154,
                'title' => 'experience_detail_access',
            ],
            [
                'id'    => 155,
                'title' => 'teaching_staff_create',
            ],
            [
                'id'    => 156,
                'title' => 'teaching_staff_edit',
            ],
            [
                'id'    => 157,
                'title' => 'teaching_staff_show',
            ],
            [
                'id'    => 158,
                'title' => 'teaching_staff_delete',
            ],
            [
                'id'    => 159,
                'title' => 'teaching_staff_access',
            ],
            [
                'id'    => 160,
                'title' => 'non_teaching_staff_create',
            ],
            [
                'id'    => 161,
                'title' => 'non_teaching_staff_edit',
            ],
            [
                'id'    => 162,
                'title' => 'non_teaching_staff_show',
            ],
            [
                'id'    => 163,
                'title' => 'non_teaching_staff_delete',
            ],
            [
                'id'    => 164,
                'title' => 'non_teaching_staff_access',
            ],
            [
                'id'    => 165,
                'title' => 'teaching_type_create',
            ],
            [
                'id'    => 166,
                'title' => 'teaching_type_edit',
            ],
            [
                'id'    => 167,
                'title' => 'teaching_type_show',
            ],
            [
                'id'    => 168,
                'title' => 'teaching_type_delete',
            ],
            [
                'id'    => 169,
                'title' => 'teaching_type_access',
            ],
            [
                'id'    => 170,
                'title' => 'examstaff_create',
            ],
            [
                'id'    => 171,
                'title' => 'examstaff_edit',
            ],
            [
                'id'    => 172,
                'title' => 'examstaff_show',
            ],
            [
                'id'    => 173,
                'title' => 'examstaff_delete',
            ],
            [
                'id'    => 174,
                'title' => 'examstaff_access',
            ],
            [
                'id'    => 175,
                'title' => 'add_conference_create',
            ],
            [
                'id'    => 176,
                'title' => 'add_conference_edit',
            ],
            [
                'id'    => 177,
                'title' => 'add_conference_show',
            ],
            [
                'id'    => 178,
                'title' => 'add_conference_delete',
            ],
            [
                'id'    => 179,
                'title' => 'add_conference_access',
            ],
            [
                'id'    => 180,
                'title' => 'entrance_exam_create',
            ],
            [
                'id'    => 181,
                'title' => 'entrance_exam_edit',
            ],
            [
                'id'    => 182,
                'title' => 'entrance_exam_show',
            ],
            [
                'id'    => 183,
                'title' => 'entrance_exam_delete',
            ],
            [
                'id'    => 184,
                'title' => 'entrance_exam_access',
            ],
            [
                'id'    => 185,
                'title' => 'guest_lecture_create',
            ],
            [
                'id'    => 186,
                'title' => 'guest_lecture_edit',
            ],
            [
                'id'    => 187,
                'title' => 'guest_lecture_show',
            ],
            [
                'id'    => 188,
                'title' => 'guest_lecture_delete',
            ],
            [
                'id'    => 189,
                'title' => 'guest_lecture_access',
            ],
            [
                'id'    => 190,
                'title' => 'industrial_training_create',
            ],
            [
                'id'    => 191,
                'title' => 'industrial_training_edit',
            ],
            [
                'id'    => 192,
                'title' => 'industrial_training_show',
            ],
            [
                'id'    => 193,
                'title' => 'industrial_training_delete',
            ],
            [
                'id'    => 194,
                'title' => 'industrial_training_access',
            ],
            [
                'id'    => 195,
                'title' => 'intern_create',
            ],
            [
                'id'    => 196,
                'title' => 'intern_edit',
            ],
            [
                'id'    => 197,
                'title' => 'intern_show',
            ],
            [
                'id'    => 198,
                'title' => 'intern_delete',
            ],
            [
                'id'    => 199,
                'title' => 'intern_access',
            ],
            [
                'id'    => 200,
                'title' => 'industrial_experience_create',
            ],
            [
                'id'    => 201,
                'title' => 'industrial_experience_edit',
            ],
            [
                'id'    => 202,
                'title' => 'industrial_experience_show',
            ],
            [
                'id'    => 203,
                'title' => 'industrial_experience_delete',
            ],
            [
                'id'    => 204,
                'title' => 'industrial_experience_access',
            ],
            [
                'id'    => 205,
                'title' => 'iv_create',
            ],
            [
                'id'    => 206,
                'title' => 'iv_edit',
            ],
            [
                'id'    => 207,
                'title' => 'iv_show',
            ],
            [
                'id'    => 208,
                'title' => 'iv_delete',
            ],
            [
                'id'    => 209,
                'title' => 'iv_access',
            ],
            [
                'id'    => 210,
                'title' => 'online_course_create',
            ],
            [
                'id'    => 211,
                'title' => 'online_course_edit',
            ],
            [
                'id'    => 212,
                'title' => 'online_course_show',
            ],
            [
                'id'    => 213,
                'title' => 'online_course_delete',
            ],
            [
                'id'    => 214,
                'title' => 'online_course_access',
            ],
            [
                'id'    => 215,
                'title' => 'document_create',
            ],
            [
                'id'    => 216,
                'title' => 'document_edit',
            ],
            [
                'id'    => 217,
                'title' => 'document_show',
            ],
            [
                'id'    => 218,
                'title' => 'document_delete',
            ],
            [
                'id'    => 219,
                'title' => 'document_access',
            ],
            [
                'id'    => 220,
                'title' => 'seminar_create',
            ],
            [
                'id'    => 221,
                'title' => 'seminar_edit',
            ],
            [
                'id'    => 222,
                'title' => 'seminar_show',
            ],
            [
                'id'    => 223,
                'title' => 'seminar_delete',
            ],
            [
                'id'    => 224,
                'title' => 'seminar_access',
            ],
            [
                'id'    => 225,
                'title' => 'sabotical_create',
            ],
            [
                'id'    => 226,
                'title' => 'sabotical_edit',
            ],
            [
                'id'    => 227,
                'title' => 'sabotical_show',
            ],
            [
                'id'    => 228,
                'title' => 'sabotical_delete',
            ],
            [
                'id'    => 229,
                'title' => 'sabotical_access',
            ],
            [
                'id'    => 230,
                'title' => 'sponser_create',
            ],
            [
                'id'    => 231,
                'title' => 'sponser_edit',
            ],
            [
                'id'    => 232,
                'title' => 'sponser_show',
            ],
            [
                'id'    => 233,
                'title' => 'sponser_delete',
            ],
            [
                'id'    => 234,
                'title' => 'sponser_access',
            ],
            [
                'id'    => 235,
                'title' => 'sttp_create',
            ],
            [
                'id'    => 236,
                'title' => 'sttp_edit',
            ],
            [
                'id'    => 237,
                'title' => 'sttp_show',
            ],
            [
                'id'    => 238,
                'title' => 'sttp_delete',
            ],
            [
                'id'    => 239,
                'title' => 'sttp_access',
            ],
            [
                'id'    => 240,
                'title' => 'workshop_create',
            ],
            [
                'id'    => 241,
                'title' => 'workshop_edit',
            ],
            [
                'id'    => 242,
                'title' => 'workshop_show',
            ],
            [
                'id'    => 243,
                'title' => 'workshop_delete',
            ],
            [
                'id'    => 244,
                'title' => 'workshop_access',
            ],
            [
                'id'    => 245,
                'title' => 'patent_create',
            ],
            [
                'id'    => 246,
                'title' => 'patent_edit',
            ],
            [
                'id'    => 247,
                'title' => 'patent_show',
            ],
            [
                'id'    => 248,
                'title' => 'patent_delete',
            ],
            [
                'id'    => 249,
                'title' => 'patent_access',
            ],
            [
                'id'    => 250,
                'title' => 'award_create',
            ],
            [
                'id'    => 251,
                'title' => 'award_edit',
            ],
            [
                'id'    => 252,
                'title' => 'award_show',
            ],
            [
                'id'    => 253,
                'title' => 'award_delete',
            ],
            [
                'id'    => 254,
                'title' => 'award_access',
            ],
            [
                'id'    => 255,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 256,
                'title' => 'asset_category_create',
            ],
            [
                'id'    => 257,
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => 258,
                'title' => 'asset_category_show',
            ],
            [
                'id'    => 259,
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => 260,
                'title' => 'asset_category_access',
            ],
            [
                'id'    => 261,
                'title' => 'asset_location_create',
            ],
            [
                'id'    => 262,
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => 263,
                'title' => 'asset_location_show',
            ],
            [
                'id'    => 264,
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => 265,
                'title' => 'asset_location_access',
            ],
            [
                'id'    => 266,
                'title' => 'asset_status_create',
            ],
            [
                'id'    => 267,
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => 268,
                'title' => 'asset_status_show',
            ],
            [
                'id'    => 269,
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => 270,
                'title' => 'asset_status_access',
            ],
            [
                'id'    => 271,
                'title' => 'asset_create',
            ],
            [
                'id'    => 272,
                'title' => 'asset_edit',
            ],
            [
                'id'    => 273,
                'title' => 'asset_show',
            ],
            [
                'id'    => 274,
                'title' => 'asset_delete',
            ],
            [
                'id'    => 275,
                'title' => 'asset_access',
            ],
            [
                'id'    => 276,
                'title' => 'assets_history_access',
            ],
            [
                'id'    => 277,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 278,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 279,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 280,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 281,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 282,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 283,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 284,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 285,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 286,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 287,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 288,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 289,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 290,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 291,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 292,
                'title' => 'task_create',
            ],
            [
                'id'    => 293,
                'title' => 'task_edit',
            ],
            [
                'id'    => 294,
                'title' => 'task_show',
            ],
            [
                'id'    => 295,
                'title' => 'task_delete',
            ],
            [
                'id'    => 296,
                'title' => 'task_access',
            ],
            [
                'id'    => 297,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 298,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 299,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 300,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 301,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 302,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 303,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 304,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 305,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 306,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 307,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 308,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 309,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 310,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 311,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 312,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 313,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 314,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 315,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 316,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 317,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 318,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 319,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 320,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 321,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 322,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 323,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 324,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 325,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 326,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 327,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 328,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 329,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 330,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 331,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 332,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 333,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 334,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 335,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 336,
                'title' => 'expense_create',
            ],
            [
                'id'    => 337,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 338,
                'title' => 'expense_show',
            ],
            [
                'id'    => 339,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 340,
                'title' => 'expense_access',
            ],
            [
                'id'    => 341,
                'title' => 'income_create',
            ],
            [
                'id'    => 342,
                'title' => 'income_edit',
            ],
            [
                'id'    => 343,
                'title' => 'income_show',
            ],
            [
                'id'    => 344,
                'title' => 'income_delete',
            ],
            [
                'id'    => 345,
                'title' => 'income_access',
            ],
            [
                'id'    => 346,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 347,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 348,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 349,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 350,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 351,
                'title' => 'course_create',
            ],
            [
                'id'    => 352,
                'title' => 'course_edit',
            ],
            [
                'id'    => 353,
                'title' => 'course_show',
            ],
            [
                'id'    => 354,
                'title' => 'course_delete',
            ],
            [
                'id'    => 355,
                'title' => 'course_access',
            ],
            [
                'id'    => 356,
                'title' => 'lesson_create',
            ],
            [
                'id'    => 357,
                'title' => 'lesson_edit',
            ],
            [
                'id'    => 358,
                'title' => 'lesson_show',
            ],
            [
                'id'    => 359,
                'title' => 'lesson_delete',
            ],
            [
                'id'    => 360,
                'title' => 'lesson_access',
            ],
            [
                'id'    => 361,
                'title' => 'test_create',
            ],
            [
                'id'    => 362,
                'title' => 'test_edit',
            ],
            [
                'id'    => 363,
                'title' => 'test_show',
            ],
            [
                'id'    => 364,
                'title' => 'test_delete',
            ],
            [
                'id'    => 365,
                'title' => 'test_access',
            ],
            [
                'id'    => 366,
                'title' => 'question_create',
            ],
            [
                'id'    => 367,
                'title' => 'question_edit',
            ],
            [
                'id'    => 368,
                'title' => 'question_show',
            ],
            [
                'id'    => 369,
                'title' => 'question_delete',
            ],
            [
                'id'    => 370,
                'title' => 'question_access',
            ],
            [
                'id'    => 371,
                'title' => 'question_option_create',
            ],
            [
                'id'    => 372,
                'title' => 'question_option_edit',
            ],
            [
                'id'    => 373,
                'title' => 'question_option_show',
            ],
            [
                'id'    => 374,
                'title' => 'question_option_delete',
            ],
            [
                'id'    => 375,
                'title' => 'question_option_access',
            ],
            [
                'id'    => 376,
                'title' => 'test_result_create',
            ],
            [
                'id'    => 377,
                'title' => 'test_result_edit',
            ],
            [
                'id'    => 378,
                'title' => 'test_result_show',
            ],
            [
                'id'    => 379,
                'title' => 'test_result_delete',
            ],
            [
                'id'    => 380,
                'title' => 'test_result_access',
            ],
            [
                'id'    => 381,
                'title' => 'test_answer_create',
            ],
            [
                'id'    => 382,
                'title' => 'test_answer_edit',
            ],
            [
                'id'    => 383,
                'title' => 'test_answer_show',
            ],
            [
                'id'    => 384,
                'title' => 'test_answer_delete',
            ],
            [
                'id'    => 385,
                'title' => 'test_answer_access',
            ],
            [
                'id'    => 386,
                'title' => 'hrm_access',
            ],
            [
                'id'    => 387,
                'title' => 'leave_type_create',
            ],
            [
                'id'    => 388,
                'title' => 'leave_type_edit',
            ],
            [
                'id'    => 389,
                'title' => 'leave_type_show',
            ],
            [
                'id'    => 390,
                'title' => 'leave_type_delete',
            ],
            [
                'id'    => 391,
                'title' => 'leave_type_access',
            ],
            [
                'id'    => 392,
                'title' => 'leave_staff_allocation_create',
            ],
            [
                'id'    => 393,
                'title' => 'leave_staff_allocation_edit',
            ],
            [
                'id'    => 394,
                'title' => 'leave_staff_allocation_show',
            ],
            [
                'id'    => 395,
                'title' => 'leave_staff_allocation_delete',
            ],
            [
                'id'    => 396,
                'title' => 'leave_staff_allocation_access',
            ],
            [
                'id'    => 397,
                'title' => 'college_block_create',
            ],
            [
                'id'    => 398,
                'title' => 'college_block_edit',
            ],
            [
                'id'    => 399,
                'title' => 'college_block_show',
            ],
            [
                'id'    => 400,
                'title' => 'college_block_delete',
            ],
            [
                'id'    => 401,
                'title' => 'college_block_access',
            ],
            [
                'id'    => 402,
                'title' => 'scholorship_create',
            ],
            [
                'id'    => 403,
                'title' => 'scholorship_edit',
            ],
            [
                'id'    => 404,
                'title' => 'scholorship_show',
            ],
            [
                'id'    => 405,
                'title' => 'scholorship_delete',
            ],
            [
                'id'    => 406,
                'title' => 'scholorship_access',
            ],
            [
                'id'    => 407,
                'title' => 'leave_status_create',
            ],
            [
                'id'    => 408,
                'title' => 'leave_status_edit',
            ],
            [
                'id'    => 409,
                'title' => 'leave_status_show',
            ],
            [
                'id'    => 410,
                'title' => 'leave_status_access',
            ],
            [
                'id'    => 411,
                'title' => 'od_master_create',
            ],
            [
                'id'    => 412,
                'title' => 'od_master_edit',
            ],
            [
                'id'    => 413,
                'title' => 'od_master_show',
            ],
            [
                'id'    => 414,
                'title' => 'od_master_delete',
            ],
            [
                'id'    => 415,
                'title' => 'od_master_access',
            ],
            [
                'id'    => 416,
                'title' => 'class_room_create',
            ],
            [
                'id'    => 417,
                'title' => 'class_room_edit',
            ],
            [
                'id'    => 418,
                'title' => 'class_room_show',
            ],
            [
                'id'    => 419,
                'title' => 'class_room_delete',
            ],
            [
                'id'    => 420,
                'title' => 'class_room_access',
            ],
            [
                'id'    => 421,
                'title' => 'email_setting_create',
            ],
            [
                'id'    => 422,
                'title' => 'email_setting_edit',
            ],
            [
                'id'    => 423,
                'title' => 'email_setting_show',
            ],
            [
                'id'    => 424,
                'title' => 'email_setting_delete',
            ],
            [
                'id'    => 425,
                'title' => 'email_setting_access',
            ],
            [
                'id'    => 426,
                'title' => 'sms_setting_create',
            ],
            [
                'id'    => 427,
                'title' => 'sms_setting_edit',
            ],
            [
                'id'    => 428,
                'title' => 'sms_setting_show',
            ],
            [
                'id'    => 429,
                'title' => 'sms_setting_delete',
            ],
            [
                'id'    => 430,
                'title' => 'sms_setting_access',
            ],
            [
                'id'    => 431,
                'title' => 'sms_template_create',
            ],
            [
                'id'    => 432,
                'title' => 'sms_template_edit',
            ],
            [
                'id'    => 433,
                'title' => 'sms_template_show',
            ],
            [
                'id'    => 434,
                'title' => 'sms_template_delete',
            ],
            [
                'id'    => 435,
                'title' => 'sms_template_access',
            ],
            [
                'id'    => 436,
                'title' => 'setting_create',
            ],
            [
                'id'    => 437,
                'title' => 'setting_edit',
            ],
            [
                'id'    => 438,
                'title' => 'setting_show',
            ],
            [
                'id'    => 439,
                'title' => 'setting_delete',
            ],
            [
                'id'    => 440,
                'title' => 'setting_access',
            ],
            [
                'id'    => 441,
                'title' => 'take_attentance_student_create',
            ],
            [
                'id'    => 442,
                'title' => 'take_attentance_student_edit',
            ],
            [
                'id'    => 443,
                'title' => 'take_attentance_student_show',
            ],
            [
                'id'    => 444,
                'title' => 'take_attentance_student_delete',
            ],
            [
                'id'    => 445,
                'title' => 'take_attentance_student_access',
            ],
            [
                'id'    => 446,
                'title' => 'email_template_create',
            ],
            [
                'id'    => 447,
                'title' => 'email_template_edit',
            ],
            [
                'id'    => 448,
                'title' => 'email_template_show',
            ],
            [
                'id'    => 449,
                'title' => 'email_template_delete',
            ],
            [
                'id'    => 450,
                'title' => 'email_template_access',
            ],
            [
                'id'    => 451,
                'title' => 'od_request_create',
            ],
            [
                'id'    => 452,
                'title' => 'od_request_edit',
            ],
            [
                'id'    => 453,
                'title' => 'od_request_show',
            ],
            [
                'id'    => 454,
                'title' => 'od_request_delete',
            ],
            [
                'id'    => 455,
                'title' => 'od_request_access',
            ],
            [
                'id'    => 456,
                'title' => 'internship_request_create',
            ],
            [
                'id'    => 457,
                'title' => 'internship_request_edit',
            ],
            [
                'id'    => 458,
                'title' => 'internship_request_show',
            ],
            [
                'id'    => 459,
                'title' => 'internship_request_delete',
            ],
            [
                'id'    => 460,
                'title' => 'internship_request_access',
            ],
            [
                'id'    => 461,
                'title' => 'college_calender_create',
            ],
            [
                'id'    => 462,
                'title' => 'college_calender_edit',
            ],
            [
                'id'    => 463,
                'title' => 'college_calender_show',
            ],
            [
                'id'    => 464,
                'title' => 'college_calender_delete',
            ],
            [
                'id'    => 465,
                'title' => 'college_calender_access',
            ],
            [
                'id'    => 466,
                'title' => 'hrm_request_permission_create',
            ],
            [
                'id'    => 467,
                'title' => 'hrm_request_permission_edit',
            ],
            [
                'id'    => 468,
                'title' => 'hrm_request_permission_show',
            ],
            [
                'id'    => 469,
                'title' => 'hrm_request_permission_delete',
            ],
            [
                'id'    => 470,
                'title' => 'hrm_request_permission_access',
            ],
            [
                'id'    => 471,
                'title' => 'hrm_request_leaf_create',
            ],
            [
                'id'    => 472,
                'title' => 'hrm_request_leaf_edit',
            ],
            [
                'id'    => 473,
                'title' => 'hrm_request_leaf_show',
            ],
            [
                'id'    => 474,
                'title' => 'hrm_request_leaf_delete',
            ],
            [
                'id'    => 475,
                'title' => 'hrm_request_leaf_access',
            ],
            [
                'id'    => 476,
                'title' => 'payment_gateway_create',
            ],
            [
                'id'    => 477,
                'title' => 'payment_gateway_edit',
            ],
            [
                'id'    => 478,
                'title' => 'payment_gateway_show',
            ],
            [
                'id'    => 479,
                'title' => 'payment_gateway_delete',
            ],
            [
                'id'    => 480,
                'title' => 'payment_gateway_access',
            ],
            [
                'id'    => 481,
                'title' => 'staff_transfer_info_create',
            ],
            [
                'id'    => 482,
                'title' => 'staff_transfer_info_edit',
            ],
            [
                'id'    => 483,
                'title' => 'staff_transfer_info_show',
            ],
            [
                'id'    => 484,
                'title' => 'staff_transfer_info_delete',
            ],
            [
                'id'    => 485,
                'title' => 'staff_transfer_info_access',
            ],
            [
                'id'    => 486,
                'title' => 'fundingdetali_create',
            ],
            [
                'id'    => 487,
                'title' => 'fundingdetali_edit',
            ],
            [
                'id'    => 488,
                'title' => 'fundingdetali_show',
            ],
            [
                'id'    => 489,
                'title' => 'fundingdetali_delete',
            ],
            [
                'id'    => 490,
                'title' => 'fundingdetali_access',
            ],
            [
                'id'    => 491,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
