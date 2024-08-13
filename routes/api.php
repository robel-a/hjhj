<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConstraintController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentOrderController;
use App\Http\Controllers\InventoryEntryController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\GuestOrderController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\InventoryRequestController;
use App\Http\Controllers\AssignmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\TeacherAssignmentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ScheduleRequestController;
use App\Http\Controllers\CourseMaterialController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BuyingPriceController;
use App\Http\Controllers\CustomTaxController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/sign-in', [AuthController::class, 'signIn']);
Route::post('/products/buying-price', [BuyingPriceController::class, 'store']);
Route::post('/custom-taxes', [CustomTaxController::class, 'store']);
// Route::prefix('auth')->group(
//     function () {
//         //api/auth/ ..
//         Route::prefix('admin')->group(
//             function () {

//             Route::post('/addEmployee', [AuthController::class, 'addEmployee'])->middleware(['auth:sanctum', 'admin']);
//             Route::get('/getEmployee', [AuthController::class, 'getEmployee'])->middleware(['auth:sanctum', 'admin']);
//             Route::get('/fetchStudents', [AuthController::class, 'fetchStudents'])->middleware(['auth:sanctum', 'admin']);
//             Route::post('/updateEmployee/{id}', [AuthController::class, 'updateEmployee'])->middleware(['auth:sanctum', 'admin']);
//             Route::post('/deleteEmployee/{id}', [AuthController::class, 'deleteEmployee'])->middleware(['auth:sanctum', 'admin']);
//             Route::post('/resetEmployeePassword/{id}', [AuthController::class, 'resetEmployeePassword'])->middleware(['auth:sanctum', 'admin']);
//             Route::post('/register', [AuthController::class, 'registerAdmin']);
//             Route::post('/login', [AuthController::class, 'loginAdmin']);

//             Route::post('/upload-course', [AuthController::class, 'courseUpload'])->middleware(['auth:sanctum', 'admin']);
//         }
//         );
//         Route::post('/register', [AuthController::class, 'register']);
//         Route::post('/login', [AuthController::class, 'login']);
//         Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
//     }
// );

Route::post('/products', [ProductController::class, 'store']);