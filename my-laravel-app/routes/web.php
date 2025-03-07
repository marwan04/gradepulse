<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CustomRegisterController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\InstructorDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

// ✅ مسارات تسجيل الدخول والتسجيل
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [CustomAuthController::class, 'login']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [CustomRegisterController::class, 'register']);

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
 */
Route::get('/student-dashboard', function () {
    if (!Auth::guard('student')->check()) {
        return redirect('/login')->with('error', 'Access denied.');
    }
    return app(StudentDashboardController::class)->index();
})->name('student.dashboard');

/*
|--------------------------------------------------------------------------
| Instructor Routes (Manual Authentication)
|--------------------------------------------------------------------------
*/
Route::get('/instructor-dashboard', function () {
    $user = Auth::guard('instructor')->user();
    if (!$user) {
        return redirect('/login')->with('error', 'Access denied.');
    }
    return app(InstructorDashboardController::class)->index();
})->name('instructor.dashboard');

// ✅ رفع ملف إكسل
Route::post('/instructor/upload-excel', function () {
    $user = Auth::guard('instructor')->user();
    if (!$user) {
        return redirect('/login')->with('error', 'Access denied.');
    }
    return app(InstructorController::class)->uploadExcel(request());
})->name('instructor.uploadExcel');

/*
|--------------------------------------------------------------------------
| Admin Routes (Manual Role Verification)
|--------------------------------------------------------------------------
*/
Route::get('/admin-dashboard', function () {
    $user = Auth::guard('instructor')->user();
    if (!$user || $user->RoleID != 1) {
        return redirect('/instructor-dashboard')->with('error', 'Access denied.');
    }
    return app(AdminDashboardController::class)->index();
})->name('admin.dashboard');

Route::group(['prefix' => 'admin'], function () {
    /*
    |--------------------------------------------------------------------------
    | Courses Management
    |--------------------------------------------------------------------------
    */
    Route::get('/courses', function () {
        $user = Auth::guard('instructor')->user();
        if (!$user || $user->RoleID != 1) {
            return redirect('/instructor-dashboard')->with('error', 'Access denied.');
        }
        return app(CourseController::class)->index();
    })->name('admin.courses.index');

    Route::get('/courses/create', function () {
        $user = Auth::guard('instructor')->user();
        if (!$user || $user->RoleID != 1) {
            return redirect('/instructor-dashboard')->with('error', 'Access denied.');
        }
        return app(CourseController::class)->create();
    })->name('admin.courses.create');

    Route::post('/courses', function () {
        $user = Auth::guard('instructor')->user();
        if (!$user || $user->RoleID != 1) {
            return redirect('/instructor-dashboard')->with('error', 'Access denied.');
        }
        return app(CourseController::class)->store(request());
    })->name('admin.courses.store');

    Route::get('/courses/{id}/edit', function ($id) {
        $user = Auth::guard('instructor')->user();
        if (!$user || $user->RoleID != 1) {
            return redirect('/instructor-dashboard')->with('error', 'Access denied.');
        }
        return app(CourseController::class)->edit($id);
    })->name('admin.courses.edit');

    Route::put('/courses/{id}', function ($id) {
        $user = Auth::guard('instructor')->user();
        if (!$user || $user->RoleID != 1) {
            return redirect('/instructor-dashboard')->with('error', 'Access denied.');
        }
        return app(CourseController::class)->update(request(), $id);
    })->name('admin.courses.update');

    Route::delete('/courses/{id}', function ($id) {
        $user = Auth::guard('instructor')->user();
        if (!$user || $user->RoleID != 1) {
            return redirect('/instructor-dashboard')->with('error', 'Access denied.');
        }
        return app(CourseController::class)->destroy($id);
    })->name('admin.courses.destroy');

/*
|--------------------------------------------------------------------------
| Sections Management
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'sections'], function () {
    Route::get('/', [SectionController::class, 'index'])->name('admin.sections.index');

    Route::get('/create', [SectionController::class, 'create'])->name('admin.sections.create');

    Route::post('/', [SectionController::class, 'store'])->name('admin.sections.store');

    Route::get('/{id}/edit', [SectionController::class, 'edit'])->name('admin.sections.edit');

    Route::put('/{id}', [SectionController::class, 'update'])->name('admin.sections.update');

    Route::delete('/{id}', [SectionController::class, 'destroy'])->name('admin.sections.destroy');
});
 /*
    |--------------------------------------------------------------------------
    | Roles Management
    |--------------------------------------------------------------------------
    */
    Route::get('/roles', function () {
        $user = Auth::guard('instructor')->user();
        if (!$user || $user->RoleID != 1) {
            return redirect('/instructor-dashboard')->with('error', 'Access denied.');
        }
        return app(RoleController::class)->index();
    })->name('admin.roles.index');

    Route::get('/roles/create', function () {
        $user = Auth::guard('instructor')->user();
        if (!$user || $user->RoleID != 1) {
            return redirect('/instructor-dashboard')->with('error', 'Access denied.');
        }
        return app(RoleController::class)->create();
    })->name('admin.roles.create');

    Route::post('/roles', function () {
        $user = Auth::guard('instructor')->user();
        if (!$user || $user->RoleID != 1) {
            return redirect('/instructor-dashboard')->with('error', 'Access denied.');
        }
        return app(RoleController::class)->store(request());
    })->name('admin.roles.store');

    // ✅ مسار تعديل الدور
    Route::get('/roles/{id}/edit', function ($id) {
        $user = Auth::guard('instructor')->user();
        if (!$user || $user->RoleID != 1) {
            return redirect('/instructor-dashboard')->with('error', 'Access denied.');
        }
        return app(RoleController::class)->edit($id);
    })->name('admin.roles.edit');

    // ✅ مسار تحديث بيانات الدور
    Route::put('/roles/{id}', function ($id) {
        $user = Auth::guard('instructor')->user();
        if (!$user || $user->RoleID != 1) {
            return redirect('/instructor-dashboard')->with('error', 'Access denied.');
        }
        return app(RoleController::class)->update(request(), $id);
    })->name('admin.roles.update');

    // ✅ مسار حذف الدور
    Route::delete('/roles/{id}', function ($id) {
        $user = Auth::guard('instructor')->user();
        if (!$user || $user->RoleID != 1) {
            return redirect('/instructor-dashboard')->with('error', 'Access denied.');
        }
        return app(RoleController::class)->destroy($id);
    })->name('admin.roles.destroy');
});
/*
|--------------------------------------------------------------------------
| Logout Route
|--------------------------------------------------------------------------
*/
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

