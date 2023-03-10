<?php

// Route::view('/', 'welcome');
Auth::routes(['register' => false]);

Route::get('/', function () {
    return redirect('/login');
});


Route::get('/test', function () {

    return view('test');

});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Tools Degree Type
    Route::delete('tools-degree-types/destroy', 'ToolsDegreeTypeController@massDestroy')->name('tools-degree-types.massDestroy');
    Route::resource('tools-degree-types', 'ToolsDegreeTypeController');

    // Academic Year
    Route::delete('academic-years/destroy', 'AcademicYearController@massDestroy')->name('academic-years.massDestroy');
    Route::resource('academic-years', 'AcademicYearController');

    // Batch
    Route::delete('batches/destroy', 'BatchController@massDestroy')->name('batches.massDestroy');
    Route::resource('batches', 'BatchController');

    // Tools Mainscreen
   // Route::delete('tools/destroy', 'ToolsController@massDestroy')->name('tools-courses.massDestroy');
    Route::resource('tools', 'ToolsController');

    // Tools Course
    Route::delete('tools-courses/destroy', 'ToolsCourseController@massDestroy')->name('tools-courses.massDestroy');
    Route::resource('tools-courses', 'ToolsCourseController');

    // Tools Department
    Route::delete('tools-departments/destroy', 'ToolsDepartmentController@massDestroy')->name('tools-departments.massDestroy');
    Route::resource('tools-departments', 'ToolsDepartmentController');

    // Section
    Route::delete('sections/destroy', 'SectionController@massDestroy')->name('sections.massDestroy');
    Route::resource('sections', 'SectionController');

    // Semester
    Route::delete('semesters/destroy', 'SemesterController@massDestroy')->name('semesters.massDestroy');
    Route::resource('semesters', 'SemesterController');

    // Course Enroll Master
    Route::delete('course-enroll-masters/destroy', 'CourseEnrollMasterController@massDestroy')->name('course-enroll-masters.massDestroy');
    Route::post('course-enroll-masters/parse-csv-import', 'CourseEnrollMasterController@parseCsvImport')->name('course-enroll-masters.parseCsvImport');
    Route::post('course-enroll-masters/process-csv-import', 'CourseEnrollMasterController@processCsvImport')->name('course-enroll-masters.processCsvImport');
    Route::resource('course-enroll-masters', 'CourseEnrollMasterController');

    // Toolssyllabus Year
    Route::delete('toolssyllabus-years/destroy', 'ToolssyllabusYearController@massDestroy')->name('toolssyllabus-years.massDestroy');
    Route::resource('toolssyllabus-years', 'ToolssyllabusYearController');

    // Academic Details
    Route::delete('academic-details/destroy', 'AcademicDetailsController@massDestroy')->name('academic-details.massDestroy');
    Route::post('academic-details/parse-csv-import', 'AcademicDetailsController@parseCsvImport')->name('academic-details.parseCsvImport');
    Route::post('academic-details/process-csv-import', 'AcademicDetailsController@processCsvImport')->name('academic-details.processCsvImport');
    Route::resource('academic-details', 'AcademicDetailsController');

    // Personal Details
    Route::delete('personal-details/destroy', 'PersonalDetailsController@massDestroy')->name('personal-details.massDestroy');
    Route::post('personal-details/parse-csv-import', 'PersonalDetailsController@parseCsvImport')->name('personal-details.parseCsvImport');
    Route::post('personal-details/process-csv-import', 'PersonalDetailsController@processCsvImport')->name('personal-details.processCsvImport');
    Route::resource('personal-details', 'PersonalDetailsController');

    // Educational Details
    Route::delete('educational-details/destroy', 'EducationalDetailsController@massDestroy')->name('educational-details.massDestroy');
    Route::post('educational-details/parse-csv-import', 'EducationalDetailsController@parseCsvImport')->name('educational-details.parseCsvImport');
    Route::post('educational-details/process-csv-import', 'EducationalDetailsController@processCsvImport')->name('educational-details.processCsvImport');
    Route::resource('educational-details', 'EducationalDetailsController');

    // Nationality
    Route::delete('nationalities/destroy', 'NationalityController@massDestroy')->name('nationalities.massDestroy');
    Route::resource('nationalities', 'NationalityController');

    // Religion
    Route::delete('religions/destroy', 'ReligionController@massDestroy')->name('religions.massDestroy');
    Route::resource('religions', 'ReligionController');

    // Blood Group
    Route::delete('blood-groups/destroy', 'BloodGroupController@massDestroy')->name('blood-groups.massDestroy');
    Route::resource('blood-groups', 'BloodGroupController');

    // Community
    Route::delete('communities/destroy', 'CommunityController@massDestroy')->name('communities.massDestroy');
    Route::resource('communities', 'CommunityController');

    // Mother Tongue
    Route::delete('mother-tongues/destroy', 'MotherTongueController@massDestroy')->name('mother-tongues.massDestroy');
    Route::resource('mother-tongues', 'MotherTongueController');

    // Education Board
    Route::delete('education-boards/destroy', 'EducationBoardController@massDestroy')->name('education-boards.massDestroy');
    Route::resource('education-boards', 'EducationBoardController');

    // Student
    Route::delete('students/destroy', 'StudentController@massDestroy')->name('students.massDestroy');
    Route::post('students/parse-csv-import', 'StudentController@parseCsvImport')->name('students.parseCsvImport');
    Route::post('students/process-csv-import', 'StudentController@processCsvImport')->name('students.processCsvImport');
    Route::resource('students', 'StudentController');

    // Education Type
    Route::delete('education-types/destroy', 'EducationTypeController@massDestroy')->name('education-types.massDestroy');
    Route::resource('education-types', 'EducationTypeController');

    // Scholarship
    Route::delete('scholarships/destroy', 'ScholarshipController@massDestroy')->name('scholarships.massDestroy');
    Route::resource('scholarships', 'ScholarshipController');

    // Subject
    Route::delete('subjects/destroy', 'SubjectController@massDestroy')->name('subjects.massDestroy');
    Route::resource('subjects', 'SubjectController');

    // Mediumof Studied
    Route::delete('mediumof-studieds/destroy', 'MediumofStudiedController@massDestroy')->name('mediumof-studieds.massDestroy');
    Route::resource('mediumof-studieds', 'MediumofStudiedController');

    // Address
    Route::delete('addresses/destroy', 'AddressController@massDestroy')->name('addresses.massDestroy');
    Route::post('addresses/parse-csv-import', 'AddressController@parseCsvImport')->name('addresses.parseCsvImport');
    Route::post('addresses/process-csv-import', 'AddressController@processCsvImport')->name('addresses.processCsvImport');
    Route::resource('addresses', 'AddressController');

    // Parent Details
    Route::delete('parent-details/destroy', 'ParentDetailsController@massDestroy')->name('parent-details.massDestroy');
    Route::post('parent-details/parse-csv-import', 'ParentDetailsController@parseCsvImport')->name('parent-details.parseCsvImport');
    Route::post('parent-details/process-csv-import', 'ParentDetailsController@processCsvImport')->name('parent-details.processCsvImport');
    Route::resource('parent-details', 'ParentDetailsController');

    // Bank Account Details
    Route::delete('bank-account-details/destroy', 'BankAccountDetailsController@massDestroy')->name('bank-account-details.massDestroy');
    Route::post('bank-account-details/parse-csv-import', 'BankAccountDetailsController@parseCsvImport')->name('bank-account-details.parseCsvImport');
    Route::post('bank-account-details/process-csv-import', 'BankAccountDetailsController@processCsvImport')->name('bank-account-details.processCsvImport');
    Route::resource('bank-account-details', 'BankAccountDetailsController');

    // Experience Details
    Route::delete('experience-details/destroy', 'ExperienceDetailsController@massDestroy')->name('experience-details.massDestroy');
    Route::post('experience-details/parse-csv-import', 'ExperienceDetailsController@parseCsvImport')->name('experience-details.parseCsvImport');
    Route::post('experience-details/process-csv-import', 'ExperienceDetailsController@processCsvImport')->name('experience-details.processCsvImport');
    Route::resource('experience-details', 'ExperienceDetailsController');

    // Teaching Staff
    Route::delete('teaching-staffs/destroy', 'TeachingStaffController@massDestroy')->name('teaching-staffs.massDestroy');
    Route::post('teaching-staffs/parse-csv-import', 'TeachingStaffController@parseCsvImport')->name('teaching-staffs.parseCsvImport');
    Route::post('teaching-staffs/process-csv-import', 'TeachingStaffController@processCsvImport')->name('teaching-staffs.processCsvImport');
    Route::resource('teaching-staffs', 'TeachingStaffController');

    // Non Teaching Staff
    Route::delete('non-teaching-staffs/destroy', 'NonTeachingStaffController@massDestroy')->name('non-teaching-staffs.massDestroy');
    Route::post('non-teaching-staffs/parse-csv-import', 'NonTeachingStaffController@parseCsvImport')->name('non-teaching-staffs.parseCsvImport');
    Route::post('non-teaching-staffs/process-csv-import', 'NonTeachingStaffController@processCsvImport')->name('non-teaching-staffs.processCsvImport');
    Route::resource('non-teaching-staffs', 'NonTeachingStaffController');

    // Teaching Type
    Route::delete('teaching-types/destroy', 'TeachingTypeController@massDestroy')->name('teaching-types.massDestroy');
    Route::resource('teaching-types', 'TeachingTypeController');

    // Examstaff
    Route::delete('examstaffs/destroy', 'ExamstaffController@massDestroy')->name('examstaffs.massDestroy');
    Route::resource('examstaffs', 'ExamstaffController');

    // Add Conference
    Route::delete('add-conferences/destroy', 'AddConferenceController@massDestroy')->name('add-conferences.massDestroy');
    Route::post('add-conferences/parse-csv-import', 'AddConferenceController@parseCsvImport')->name('add-conferences.parseCsvImport');
    Route::post('add-conferences/process-csv-import', 'AddConferenceController@processCsvImport')->name('add-conferences.processCsvImport');
    Route::resource('add-conferences', 'AddConferenceController');

    // Entrance Exams
    Route::delete('entrance-exams/destroy', 'EntranceExamsController@massDestroy')->name('entrance-exams.massDestroy');
    Route::post('entrance-exams/parse-csv-import', 'EntranceExamsController@parseCsvImport')->name('entrance-exams.parseCsvImport');
    Route::post('entrance-exams/process-csv-import', 'EntranceExamsController@processCsvImport')->name('entrance-exams.processCsvImport');
    Route::resource('entrance-exams', 'EntranceExamsController');

    // Guest Lecture
    Route::delete('guest-lectures/destroy', 'GuestLectureController@massDestroy')->name('guest-lectures.massDestroy');
    Route::post('guest-lectures/parse-csv-import', 'GuestLectureController@parseCsvImport')->name('guest-lectures.parseCsvImport');
    Route::post('guest-lectures/process-csv-import', 'GuestLectureController@processCsvImport')->name('guest-lectures.processCsvImport');
    Route::resource('guest-lectures', 'GuestLectureController');

    // Industrial Training
    Route::delete('industrial-trainings/destroy', 'IndustrialTrainingController@massDestroy')->name('industrial-trainings.massDestroy');
    Route::post('industrial-trainings/parse-csv-import', 'IndustrialTrainingController@parseCsvImport')->name('industrial-trainings.parseCsvImport');
    Route::post('industrial-trainings/process-csv-import', 'IndustrialTrainingController@processCsvImport')->name('industrial-trainings.processCsvImport');
    Route::resource('industrial-trainings', 'IndustrialTrainingController');

    // Intern
    Route::delete('interns/destroy', 'InternController@massDestroy')->name('interns.massDestroy');
    Route::post('interns/parse-csv-import', 'InternController@parseCsvImport')->name('interns.parseCsvImport');
    Route::post('interns/process-csv-import', 'InternController@processCsvImport')->name('interns.processCsvImport');
    Route::resource('interns', 'InternController');

    // Industrial Experience
    Route::delete('industrial-experiences/destroy', 'IndustrialExperienceController@massDestroy')->name('industrial-experiences.massDestroy');
    Route::post('industrial-experiences/parse-csv-import', 'IndustrialExperienceController@parseCsvImport')->name('industrial-experiences.parseCsvImport');
    Route::post('industrial-experiences/process-csv-import', 'IndustrialExperienceController@processCsvImport')->name('industrial-experiences.processCsvImport');
    Route::resource('industrial-experiences', 'IndustrialExperienceController');

    // Iv
    Route::delete('ivs/destroy', 'IvController@massDestroy')->name('ivs.massDestroy');
    Route::resource('ivs', 'IvController');

    // Online Course
    Route::delete('online-courses/destroy', 'OnlineCourseController@massDestroy')->name('online-courses.massDestroy');
    Route::post('online-courses/parse-csv-import', 'OnlineCourseController@parseCsvImport')->name('online-courses.parseCsvImport');
    Route::post('online-courses/process-csv-import', 'OnlineCourseController@processCsvImport')->name('online-courses.processCsvImport');
    Route::resource('online-courses', 'OnlineCourseController');

    // Documents
    Route::delete('documents/destroy', 'DocumentsController@massDestroy')->name('documents.massDestroy');
    Route::post('documents/media', 'DocumentsController@storeMedia')->name('documents.storeMedia');
    Route::post('documents/ckmedia', 'DocumentsController@storeCKEditorImages')->name('documents.storeCKEditorImages');
    Route::post('documents/parse-csv-import', 'DocumentsController@parseCsvImport')->name('documents.parseCsvImport');
    Route::post('documents/process-csv-import', 'DocumentsController@processCsvImport')->name('documents.processCsvImport');
    Route::resource('documents', 'DocumentsController');

    // Seminar
    Route::delete('seminars/destroy', 'SeminarController@massDestroy')->name('seminars.massDestroy');
    Route::post('seminars/parse-csv-import', 'SeminarController@parseCsvImport')->name('seminars.parseCsvImport');
    Route::post('seminars/process-csv-import', 'SeminarController@processCsvImport')->name('seminars.processCsvImport');
    Route::resource('seminars', 'SeminarController');

    // Saboticals
    Route::delete('saboticals/destroy', 'SaboticalsController@massDestroy')->name('saboticals.massDestroy');
    Route::post('saboticals/parse-csv-import', 'SaboticalsController@parseCsvImport')->name('saboticals.parseCsvImport');
    Route::post('saboticals/process-csv-import', 'SaboticalsController@processCsvImport')->name('saboticals.processCsvImport');
    Route::resource('saboticals', 'SaboticalsController');

    // Sponser
    Route::delete('sponsers/destroy', 'SponserController@massDestroy')->name('sponsers.massDestroy');
    Route::post('sponsers/parse-csv-import', 'SponserController@parseCsvImport')->name('sponsers.parseCsvImport');
    Route::post('sponsers/process-csv-import', 'SponserController@processCsvImport')->name('sponsers.processCsvImport');
    Route::resource('sponsers', 'SponserController');

    // Sttp
    Route::delete('sttps/destroy', 'SttpController@massDestroy')->name('sttps.massDestroy');
    Route::post('sttps/parse-csv-import', 'SttpController@parseCsvImport')->name('sttps.parseCsvImport');
    Route::post('sttps/process-csv-import', 'SttpController@processCsvImport')->name('sttps.processCsvImport');
    Route::resource('sttps', 'SttpController');

    // Workshop
    Route::delete('workshops/destroy', 'WorkshopController@massDestroy')->name('workshops.massDestroy');
    Route::post('workshops/parse-csv-import', 'WorkshopController@parseCsvImport')->name('workshops.parseCsvImport');
    Route::post('workshops/process-csv-import', 'WorkshopController@processCsvImport')->name('workshops.processCsvImport');
    Route::resource('workshops', 'WorkshopController');

    // Patents
    Route::delete('patents/destroy', 'PatentsController@massDestroy')->name('patents.massDestroy');
    Route::resource('patents', 'PatentsController');

    // Awards
    Route::delete('awards/destroy', 'AwardsController@massDestroy')->name('awards.massDestroy');
    Route::resource('awards', 'AwardsController');

    // Asset Category
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Location
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Status
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Asset
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::resource('assets', 'AssetController');

    // Assets History
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Task Status
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tag
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Task
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendar
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');

    // Expense Category
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Income Category
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expense
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::resource('expenses', 'ExpenseController');

    // Income
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::resource('incomes', 'IncomeController');

    // Expense Report
    Route::delete('expense-reports/destroy', 'ExpenseReportController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('expense-reports', 'ExpenseReportController');

    // Courses
    Route::delete('courses/destroy', 'CoursesController@massDestroy')->name('courses.massDestroy');
    Route::post('courses/media', 'CoursesController@storeMedia')->name('courses.storeMedia');
    Route::post('courses/ckmedia', 'CoursesController@storeCKEditorImages')->name('courses.storeCKEditorImages');
    Route::resource('courses', 'CoursesController');

    // Lessons
    Route::delete('lessons/destroy', 'LessonsController@massDestroy')->name('lessons.massDestroy');
    Route::post('lessons/media', 'LessonsController@storeMedia')->name('lessons.storeMedia');
    Route::post('lessons/ckmedia', 'LessonsController@storeCKEditorImages')->name('lessons.storeCKEditorImages');
    Route::resource('lessons', 'LessonsController');

    // Tests
    Route::delete('tests/destroy', 'TestsController@massDestroy')->name('tests.massDestroy');
    Route::resource('tests', 'TestsController');

    // Questions
    Route::delete('questions/destroy', 'QuestionsController@massDestroy')->name('questions.massDestroy');
    Route::post('questions/media', 'QuestionsController@storeMedia')->name('questions.storeMedia');
    Route::post('questions/ckmedia', 'QuestionsController@storeCKEditorImages')->name('questions.storeCKEditorImages');
    Route::resource('questions', 'QuestionsController');

    // Question Options
    Route::delete('question-options/destroy', 'QuestionOptionsController@massDestroy')->name('question-options.massDestroy');
    Route::resource('question-options', 'QuestionOptionsController');

    // Test Results
    Route::delete('test-results/destroy', 'TestResultsController@massDestroy')->name('test-results.massDestroy');
    Route::resource('test-results', 'TestResultsController');

    // Test Answers
    Route::delete('test-answers/destroy', 'TestAnswersController@massDestroy')->name('test-answers.massDestroy');
    Route::resource('test-answers', 'TestAnswersController');

    // Leave Type
    Route::delete('leave-types/destroy', 'LeaveTypeController@massDestroy')->name('leave-types.massDestroy');
    Route::post('leave-types/parse-csv-import', 'LeaveTypeController@parseCsvImport')->name('leave-types.parseCsvImport');
    Route::post('leave-types/process-csv-import', 'LeaveTypeController@processCsvImport')->name('leave-types.processCsvImport');
    Route::resource('leave-types', 'LeaveTypeController');

    // Leave Staff Allocation
    Route::delete('leave-staff-allocations/destroy', 'LeaveStaffAllocationController@massDestroy')->name('leave-staff-allocations.massDestroy');
    Route::post('leave-staff-allocations/parse-csv-import', 'LeaveStaffAllocationController@parseCsvImport')->name('leave-staff-allocations.parseCsvImport');
    Route::post('leave-staff-allocations/process-csv-import', 'LeaveStaffAllocationController@processCsvImport')->name('leave-staff-allocations.processCsvImport');
    Route::resource('leave-staff-allocations', 'LeaveStaffAllocationController');

    // College Block
    Route::delete('college-blocks/destroy', 'CollegeBlockController@massDestroy')->name('college-blocks.massDestroy');
    Route::resource('college-blocks', 'CollegeBlockController');

    // Scholorship
    Route::delete('scholorships/destroy', 'ScholorshipController@massDestroy')->name('scholorships.massDestroy');
    Route::post('scholorships/parse-csv-import', 'ScholorshipController@parseCsvImport')->name('scholorships.parseCsvImport');
    Route::post('scholorships/process-csv-import', 'ScholorshipController@processCsvImport')->name('scholorships.processCsvImport');
    Route::resource('scholorships', 'ScholorshipController');

    // Leave Status
    Route::post('leave-statuses/parse-csv-import', 'LeaveStatusController@parseCsvImport')->name('leave-statuses.parseCsvImport');
    Route::post('leave-statuses/process-csv-import', 'LeaveStatusController@processCsvImport')->name('leave-statuses.processCsvImport');
    Route::resource('leave-statuses', 'LeaveStatusController', ['except' => ['destroy']]);

    // Od Master
    Route::delete('od-masters/destroy', 'OdMasterController@massDestroy')->name('od-masters.massDestroy');
    Route::post('od-masters/parse-csv-import', 'OdMasterController@parseCsvImport')->name('od-masters.parseCsvImport');
    Route::post('od-masters/process-csv-import', 'OdMasterController@processCsvImport')->name('od-masters.processCsvImport');
    Route::resource('od-masters', 'OdMasterController');

    // Class Rooms
    Route::delete('class-rooms/destroy', 'ClassRoomsController@massDestroy')->name('class-rooms.massDestroy');
    Route::post('class-rooms/parse-csv-import', 'ClassRoomsController@parseCsvImport')->name('class-rooms.parseCsvImport');
    Route::post('class-rooms/process-csv-import', 'ClassRoomsController@processCsvImport')->name('class-rooms.processCsvImport');
    Route::resource('class-rooms', 'ClassRoomsController');

    // Email Settings
    Route::delete('email-settings/destroy', 'EmailSettingsController@massDestroy')->name('email-settings.massDestroy');
    Route::post('email-settings/parse-csv-import', 'EmailSettingsController@parseCsvImport')->name('email-settings.parseCsvImport');
    Route::post('email-settings/process-csv-import', 'EmailSettingsController@processCsvImport')->name('email-settings.processCsvImport');
    Route::resource('email-settings', 'EmailSettingsController');

    // Sms Settings
    Route::delete('sms-settings/destroy', 'SmsSettingsController@massDestroy')->name('sms-settings.massDestroy');
    Route::post('sms-settings/parse-csv-import', 'SmsSettingsController@parseCsvImport')->name('sms-settings.parseCsvImport');
    Route::post('sms-settings/process-csv-import', 'SmsSettingsController@processCsvImport')->name('sms-settings.processCsvImport');
    Route::resource('sms-settings', 'SmsSettingsController');

    // Sms Templates
    Route::delete('sms-templates/destroy', 'SmsTemplatesController@massDestroy')->name('sms-templates.massDestroy');
    Route::post('sms-templates/parse-csv-import', 'SmsTemplatesController@parseCsvImport')->name('sms-templates.parseCsvImport');
    Route::post('sms-templates/process-csv-import', 'SmsTemplatesController@processCsvImport')->name('sms-templates.processCsvImport');
    Route::resource('sms-templates', 'SmsTemplatesController');

    // Settings
    Route::delete('settings/destroy', 'SettingsController@massDestroy')->name('settings.massDestroy');
    Route::post('settings/parse-csv-import', 'SettingsController@parseCsvImport')->name('settings.parseCsvImport');
    Route::post('settings/process-csv-import', 'SettingsController@processCsvImport')->name('settings.processCsvImport');
    Route::resource('settings', 'SettingsController');

    // Take Attentance Student
    Route::delete('take-attentance-students/destroy', 'TakeAttentanceStudentController@massDestroy')->name('take-attentance-students.massDestroy');
    Route::post('take-attentance-students/parse-csv-import', 'TakeAttentanceStudentController@parseCsvImport')->name('take-attentance-students.parseCsvImport');
    Route::post('take-attentance-students/process-csv-import', 'TakeAttentanceStudentController@processCsvImport')->name('take-attentance-students.processCsvImport');
    Route::resource('take-attentance-students', 'TakeAttentanceStudentController');

    // Email Templates
    Route::delete('email-templates/destroy', 'EmailTemplatesController@massDestroy')->name('email-templates.massDestroy');
    Route::post('email-templates/parse-csv-import', 'EmailTemplatesController@parseCsvImport')->name('email-templates.parseCsvImport');
    Route::post('email-templates/process-csv-import', 'EmailTemplatesController@processCsvImport')->name('email-templates.processCsvImport');
    Route::resource('email-templates', 'EmailTemplatesController');

    // Od Request
    Route::delete('od-requests/destroy', 'OdRequestController@massDestroy')->name('od-requests.massDestroy');
    Route::post('od-requests/parse-csv-import', 'OdRequestController@parseCsvImport')->name('od-requests.parseCsvImport');
    Route::post('od-requests/process-csv-import', 'OdRequestController@processCsvImport')->name('od-requests.processCsvImport');
    Route::resource('od-requests', 'OdRequestController');

    // Internship Request
    Route::delete('internship-requests/destroy', 'InternshipRequestController@massDestroy')->name('internship-requests.massDestroy');
    Route::post('internship-requests/parse-csv-import', 'InternshipRequestController@parseCsvImport')->name('internship-requests.parseCsvImport');
    Route::post('internship-requests/process-csv-import', 'InternshipRequestController@processCsvImport')->name('internship-requests.processCsvImport');
    Route::resource('internship-requests', 'InternshipRequestController');

    // College Calender
    Route::delete('college-calenders/destroy', 'CollegeCalenderController@massDestroy')->name('college-calenders.massDestroy');
    Route::post('college-calenders/parse-csv-import', 'CollegeCalenderController@parseCsvImport')->name('college-calenders.parseCsvImport');
    Route::post('college-calenders/process-csv-import', 'CollegeCalenderController@processCsvImport')->name('college-calenders.processCsvImport');
    Route::resource('college-calenders', 'CollegeCalenderController');

    // Hrm Request Permission
    Route::delete('hrm-request-permissions/destroy', 'HrmRequestPermissionController@massDestroy')->name('hrm-request-permissions.massDestroy');
    Route::post('hrm-request-permissions/parse-csv-import', 'HrmRequestPermissionController@parseCsvImport')->name('hrm-request-permissions.parseCsvImport');
    Route::post('hrm-request-permissions/process-csv-import', 'HrmRequestPermissionController@processCsvImport')->name('hrm-request-permissions.processCsvImport');
    Route::resource('hrm-request-permissions', 'HrmRequestPermissionController');

    // Hrm Request Leave
    Route::delete('hrm-request-leaves/destroy', 'HrmRequestLeaveController@massDestroy')->name('hrm-request-leaves.massDestroy');
    Route::post('hrm-request-leaves/parse-csv-import', 'HrmRequestLeaveController@parseCsvImport')->name('hrm-request-leaves.parseCsvImport');
    Route::post('hrm-request-leaves/process-csv-import', 'HrmRequestLeaveController@processCsvImport')->name('hrm-request-leaves.processCsvImport');
    Route::resource('hrm-request-leaves', 'HrmRequestLeaveController');

    // Payment Gateway
    Route::delete('payment-gateways/destroy', 'PaymentGatewayController@massDestroy')->name('payment-gateways.massDestroy');
    Route::post('payment-gateways/parse-csv-import', 'PaymentGatewayController@parseCsvImport')->name('payment-gateways.parseCsvImport');
    Route::post('payment-gateways/process-csv-import', 'PaymentGatewayController@processCsvImport')->name('payment-gateways.processCsvImport');
    Route::resource('payment-gateways', 'PaymentGatewayController');

    // Staff Transfer Info
    Route::delete('staff-transfer-infos/destroy', 'StaffTransferInfoController@massDestroy')->name('staff-transfer-infos.massDestroy');
    Route::post('staff-transfer-infos/parse-csv-import', 'StaffTransferInfoController@parseCsvImport')->name('staff-transfer-infos.parseCsvImport');
    Route::post('staff-transfer-infos/process-csv-import', 'StaffTransferInfoController@processCsvImport')->name('staff-transfer-infos.processCsvImport');
    Route::resource('staff-transfer-infos', 'StaffTransferInfoController');


     // Staff Salary
     Route::delete('staff-salaries/destroy', 'StaffSalaryController@massDestroy')->name('staff-salaries.massDestroy');
     Route::post('staff-salaries/parse-csv-import', 'StaffSalaryController@parseCsvImport')->name('staff-salaries.parseCsvImport');
     Route::post('staff-salaries/process-csv-import', 'StaffSalaryController@processCsvImport')->name('staff-salaries.processCsvImport');
     Route::resource('staff-salaries', 'StaffSalaryController');


    // Fundingdetalis
    Route::delete('fundingdetalis/destroy', 'FundingdetalisController@massDestroy')->name('fundingdetalis.massDestroy');
    Route::resource('fundingdetalis', 'FundingdetalisController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});


Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Tools Degree Type
    Route::delete('tools-degree-types/destroy', 'ToolsDegreeTypeController@massDestroy')->name('tools-degree-types.massDestroy');
    Route::resource('tools-degree-types', 'ToolsDegreeTypeController');

    // Academic Year
    Route::delete('academic-years/destroy', 'AcademicYearController@massDestroy')->name('academic-years.massDestroy');
    Route::resource('academic-years', 'AcademicYearController');

    // Batch
    Route::delete('batches/destroy', 'BatchController@massDestroy')->name('batches.massDestroy');
    Route::resource('batches', 'BatchController');


    Route::resource('tools', 'ToolsController');

    // Tools Course
    Route::delete('tools-courses/destroy', 'ToolsCourseController@massDestroy')->name('tools-courses.massDestroy');
    Route::resource('tools-courses', 'ToolsCourseController');

    // Tools Department
    Route::delete('tools-departments/destroy', 'ToolsDepartmentController@massDestroy')->name('tools-departments.massDestroy');
    Route::resource('tools-departments', 'ToolsDepartmentController');

    // Section
    Route::delete('sections/destroy', 'SectionController@massDestroy')->name('sections.massDestroy');
    Route::resource('sections', 'SectionController');

    // Semester
    Route::delete('semesters/destroy', 'SemesterController@massDestroy')->name('semesters.massDestroy');
    Route::resource('semesters', 'SemesterController');

    // Course Enroll Master
    Route::delete('course-enroll-masters/destroy', 'CourseEnrollMasterController@massDestroy')->name('course-enroll-masters.massDestroy');
    Route::resource('course-enroll-masters', 'CourseEnrollMasterController');

    // Toolssyllabus Year
    Route::delete('toolssyllabus-years/destroy', 'ToolssyllabusYearController@massDestroy')->name('toolssyllabus-years.massDestroy');
    Route::resource('toolssyllabus-years', 'ToolssyllabusYearController');

    // Academic Details
    Route::delete('academic-details/destroy', 'AcademicDetailsController@massDestroy')->name('academic-details.massDestroy');
    Route::resource('academic-details', 'AcademicDetailsController');

    // Personal Details
    Route::delete('personal-details/destroy', 'PersonalDetailsController@massDestroy')->name('personal-details.massDestroy');
    Route::resource('personal-details', 'PersonalDetailsController');

    // Educational Details
    Route::delete('educational-details/destroy', 'EducationalDetailsController@massDestroy')->name('educational-details.massDestroy');
    Route::resource('educational-details', 'EducationalDetailsController');

    // Nationality
    Route::delete('nationalities/destroy', 'NationalityController@massDestroy')->name('nationalities.massDestroy');
    Route::resource('nationalities', 'NationalityController');

    // Religion
    Route::delete('religions/destroy', 'ReligionController@massDestroy')->name('religions.massDestroy');
    Route::resource('religions', 'ReligionController');

    // Blood Group
    Route::delete('blood-groups/destroy', 'BloodGroupController@massDestroy')->name('blood-groups.massDestroy');
    Route::resource('blood-groups', 'BloodGroupController');

    // Community
    Route::delete('communities/destroy', 'CommunityController@massDestroy')->name('communities.massDestroy');
    Route::resource('communities', 'CommunityController');

    // Mother Tongue
    Route::delete('mother-tongues/destroy', 'MotherTongueController@massDestroy')->name('mother-tongues.massDestroy');
    Route::resource('mother-tongues', 'MotherTongueController');

    // Education Board
    Route::delete('education-boards/destroy', 'EducationBoardController@massDestroy')->name('education-boards.massDestroy');
    Route::resource('education-boards', 'EducationBoardController');

    // Student
    Route::delete('students/destroy', 'StudentController@massDestroy')->name('students.massDestroy');
    Route::resource('students', 'StudentController');

    // Education Type
    Route::delete('education-types/destroy', 'EducationTypeController@massDestroy')->name('education-types.massDestroy');
    Route::resource('education-types', 'EducationTypeController');

    // Scholarship
    Route::delete('scholarships/destroy', 'ScholarshipController@massDestroy')->name('scholarships.massDestroy');
    Route::resource('scholarships', 'ScholarshipController');

    // Subject
    Route::delete('subjects/destroy', 'SubjectController@massDestroy')->name('subjects.massDestroy');
    Route::resource('subjects', 'SubjectController');

    // Mediumof Studied
    Route::delete('mediumof-studieds/destroy', 'MediumofStudiedController@massDestroy')->name('mediumof-studieds.massDestroy');
    Route::resource('mediumof-studieds', 'MediumofStudiedController');

    // Address
    Route::delete('addresses/destroy', 'AddressController@massDestroy')->name('addresses.massDestroy');
    Route::resource('addresses', 'AddressController');

    // Parent Details
    Route::delete('parent-details/destroy', 'ParentDetailsController@massDestroy')->name('parent-details.massDestroy');
    Route::resource('parent-details', 'ParentDetailsController');

    // Bank Account Details
    Route::delete('bank-account-details/destroy', 'BankAccountDetailsController@massDestroy')->name('bank-account-details.massDestroy');
    Route::resource('bank-account-details', 'BankAccountDetailsController');

    // Experience Details
    Route::delete('experience-details/destroy', 'ExperienceDetailsController@massDestroy')->name('experience-details.massDestroy');
    Route::resource('experience-details', 'ExperienceDetailsController');

    // Teaching Staff
    Route::delete('teaching-staffs/destroy', 'TeachingStaffController@massDestroy')->name('teaching-staffs.massDestroy');
    Route::resource('teaching-staffs', 'TeachingStaffController');

    // Non Teaching Staff
    Route::delete('non-teaching-staffs/destroy', 'NonTeachingStaffController@massDestroy')->name('non-teaching-staffs.massDestroy');
    Route::resource('non-teaching-staffs', 'NonTeachingStaffController');

    // Teaching Type
    Route::delete('teaching-types/destroy', 'TeachingTypeController@massDestroy')->name('teaching-types.massDestroy');
    Route::resource('teaching-types', 'TeachingTypeController');

    // Examstaff
    Route::delete('examstaffs/destroy', 'ExamstaffController@massDestroy')->name('examstaffs.massDestroy');
    Route::resource('examstaffs', 'ExamstaffController');

    // Add Conference
    Route::delete('add-conferences/destroy', 'AddConferenceController@massDestroy')->name('add-conferences.massDestroy');
    Route::resource('add-conferences', 'AddConferenceController');

    // Entrance Exams
    Route::delete('entrance-exams/destroy', 'EntranceExamsController@massDestroy')->name('entrance-exams.massDestroy');
    Route::resource('entrance-exams', 'EntranceExamsController');

    // Guest Lecture
    Route::delete('guest-lectures/destroy', 'GuestLectureController@massDestroy')->name('guest-lectures.massDestroy');
    Route::resource('guest-lectures', 'GuestLectureController');

    // Industrial Training
    Route::delete('industrial-trainings/destroy', 'IndustrialTrainingController@massDestroy')->name('industrial-trainings.massDestroy');
    Route::resource('industrial-trainings', 'IndustrialTrainingController');

    // Intern
    Route::delete('interns/destroy', 'InternController@massDestroy')->name('interns.massDestroy');
    Route::resource('interns', 'InternController');

    // Industrial Experience
    Route::delete('industrial-experiences/destroy', 'IndustrialExperienceController@massDestroy')->name('industrial-experiences.massDestroy');
    Route::resource('industrial-experiences', 'IndustrialExperienceController');

    // Iv
    Route::delete('ivs/destroy', 'IvController@massDestroy')->name('ivs.massDestroy');
    Route::resource('ivs', 'IvController');

    // Online Course
    Route::delete('online-courses/destroy', 'OnlineCourseController@massDestroy')->name('online-courses.massDestroy');
    Route::resource('online-courses', 'OnlineCourseController');

    // Documents
    Route::delete('documents/destroy', 'DocumentsController@massDestroy')->name('documents.massDestroy');
    Route::post('documents/media', 'DocumentsController@storeMedia')->name('documents.storeMedia');
    Route::post('documents/ckmedia', 'DocumentsController@storeCKEditorImages')->name('documents.storeCKEditorImages');
    Route::resource('documents', 'DocumentsController');

    // Seminar
    Route::delete('seminars/destroy', 'SeminarController@massDestroy')->name('seminars.massDestroy');
    Route::resource('seminars', 'SeminarController');

    // Saboticals
    Route::delete('saboticals/destroy', 'SaboticalsController@massDestroy')->name('saboticals.massDestroy');
    Route::resource('saboticals', 'SaboticalsController');

    // Sponser
    Route::delete('sponsers/destroy', 'SponserController@massDestroy')->name('sponsers.massDestroy');
    Route::resource('sponsers', 'SponserController');

    // Sttp
    Route::delete('sttps/destroy', 'SttpController@massDestroy')->name('sttps.massDestroy');
    Route::resource('sttps', 'SttpController');

    // Workshop
    Route::delete('workshops/destroy', 'WorkshopController@massDestroy')->name('workshops.massDestroy');
    Route::resource('workshops', 'WorkshopController');

    // Patents
    Route::delete('patents/destroy', 'PatentsController@massDestroy')->name('patents.massDestroy');
    Route::resource('patents', 'PatentsController');

    // Awards
    Route::delete('awards/destroy', 'AwardsController@massDestroy')->name('awards.massDestroy');
    Route::resource('awards', 'AwardsController');

    // Asset Category
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Location
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Status
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Asset
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::resource('assets', 'AssetController');

    // Assets History
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Task Status
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tag
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Task
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendar
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');

    // Expense Category
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Income Category
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expense
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::resource('expenses', 'ExpenseController');

    // Income
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::resource('incomes', 'IncomeController');

    // Courses
    Route::delete('courses/destroy', 'CoursesController@massDestroy')->name('courses.massDestroy');
    Route::post('courses/media', 'CoursesController@storeMedia')->name('courses.storeMedia');
    Route::post('courses/ckmedia', 'CoursesController@storeCKEditorImages')->name('courses.storeCKEditorImages');
    Route::resource('courses', 'CoursesController');

    // Lessons
    Route::delete('lessons/destroy', 'LessonsController@massDestroy')->name('lessons.massDestroy');
    Route::post('lessons/media', 'LessonsController@storeMedia')->name('lessons.storeMedia');
    Route::post('lessons/ckmedia', 'LessonsController@storeCKEditorImages')->name('lessons.storeCKEditorImages');
    Route::resource('lessons', 'LessonsController');

    // Tests
    Route::delete('tests/destroy', 'TestsController@massDestroy')->name('tests.massDestroy');
    Route::resource('tests', 'TestsController');

    // Questions
    Route::delete('questions/destroy', 'QuestionsController@massDestroy')->name('questions.massDestroy');
    Route::post('questions/media', 'QuestionsController@storeMedia')->name('questions.storeMedia');
    Route::post('questions/ckmedia', 'QuestionsController@storeCKEditorImages')->name('questions.storeCKEditorImages');
    Route::resource('questions', 'QuestionsController');

    // Question Options
    Route::delete('question-options/destroy', 'QuestionOptionsController@massDestroy')->name('question-options.massDestroy');
    Route::resource('question-options', 'QuestionOptionsController');

    // Test Results
    Route::delete('test-results/destroy', 'TestResultsController@massDestroy')->name('test-results.massDestroy');
    Route::resource('test-results', 'TestResultsController');

    // Test Answers
    Route::delete('test-answers/destroy', 'TestAnswersController@massDestroy')->name('test-answers.massDestroy');
    Route::resource('test-answers', 'TestAnswersController');

    // Leave Type
    Route::delete('leave-types/destroy', 'LeaveTypeController@massDestroy')->name('leave-types.massDestroy');
    Route::resource('leave-types', 'LeaveTypeController');

    // Leave Staff Allocation
    Route::delete('leave-staff-allocations/destroy', 'LeaveStaffAllocationController@massDestroy')->name('leave-staff-allocations.massDestroy');
    Route::resource('leave-staff-allocations', 'LeaveStaffAllocationController');

    // College Block
    Route::delete('college-blocks/destroy', 'CollegeBlockController@massDestroy')->name('college-blocks.massDestroy');
    Route::resource('college-blocks', 'CollegeBlockController');

    // Scholorship
    Route::delete('scholorships/destroy', 'ScholorshipController@massDestroy')->name('scholorships.massDestroy');
    Route::resource('scholorships', 'ScholorshipController');

    // Leave Status
    Route::resource('leave-statuses', 'LeaveStatusController', ['except' => ['destroy']]);

    // Od Master
    Route::delete('od-masters/destroy', 'OdMasterController@massDestroy')->name('od-masters.massDestroy');
    Route::resource('od-masters', 'OdMasterController');

    // Class Rooms
    Route::delete('class-rooms/destroy', 'ClassRoomsController@massDestroy')->name('class-rooms.massDestroy');
    Route::resource('class-rooms', 'ClassRoomsController');

    // Email Settings
    Route::delete('email-settings/destroy', 'EmailSettingsController@massDestroy')->name('email-settings.massDestroy');
    Route::resource('email-settings', 'EmailSettingsController');

    // Sms Settings
    Route::delete('sms-settings/destroy', 'SmsSettingsController@massDestroy')->name('sms-settings.massDestroy');
    Route::resource('sms-settings', 'SmsSettingsController');

    // Sms Templates
    Route::delete('sms-templates/destroy', 'SmsTemplatesController@massDestroy')->name('sms-templates.massDestroy');
    Route::resource('sms-templates', 'SmsTemplatesController');

    // Settings
    Route::delete('settings/destroy', 'SettingsController@massDestroy')->name('settings.massDestroy');
    Route::resource('settings', 'SettingsController');

    // Take Attentance Student
    Route::delete('take-attentance-students/destroy', 'TakeAttentanceStudentController@massDestroy')->name('take-attentance-students.massDestroy');
    Route::resource('take-attentance-students', 'TakeAttentanceStudentController');

    // Email Templates
    Route::delete('email-templates/destroy', 'EmailTemplatesController@massDestroy')->name('email-templates.massDestroy');
    Route::resource('email-templates', 'EmailTemplatesController');

    // Od Request
    Route::delete('od-requests/destroy', 'OdRequestController@massDestroy')->name('od-requests.massDestroy');
    Route::resource('od-requests', 'OdRequestController');

    // Internship Request
    Route::delete('internship-requests/destroy', 'InternshipRequestController@massDestroy')->name('internship-requests.massDestroy');
    Route::resource('internship-requests', 'InternshipRequestController');

    // College Calender
    Route::delete('college-calenders/destroy', 'CollegeCalenderController@massDestroy')->name('college-calenders.massDestroy');
    Route::resource('college-calenders', 'CollegeCalenderController');

    // Hrm Request Permission
    Route::delete('hrm-request-permissions/destroy', 'HrmRequestPermissionController@massDestroy')->name('hrm-request-permissions.massDestroy');
    Route::resource('hrm-request-permissions', 'HrmRequestPermissionController');

    // Hrm Request Leave
    Route::delete('hrm-request-leaves/destroy', 'HrmRequestLeaveController@massDestroy')->name('hrm-request-leaves.massDestroy');
    Route::resource('hrm-request-leaves', 'HrmRequestLeaveController');

    // Payment Gateway
    Route::delete('payment-gateways/destroy', 'PaymentGatewayController@massDestroy')->name('payment-gateways.massDestroy');
    Route::resource('payment-gateways', 'PaymentGatewayController');

    // Staff Transfer Info
    Route::delete('staff-transfer-infos/destroy', 'StaffTransferInfoController@massDestroy')->name('staff-transfer-infos.massDestroy');
    Route::resource('staff-transfer-infos', 'StaffTransferInfoController');

    // Fundingdetalis
    Route::delete('fundingdetalis/destroy', 'FundingdetalisController@massDestroy')->name('fundingdetalis.massDestroy');
    Route::resource('fundingdetalis', 'FundingdetalisController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');

});
