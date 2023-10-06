<?php

namespace App\Providers;

use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryEloquent;
use App\Repositories\Appointment\AppointmentRepository;
use App\Repositories\Appointment\AppointmentRepositoryEloquent;
use App\Repositories\CaseHistory\CaseHistoryRepository;
use App\Repositories\CaseHistory\CaseHistoryRepositoryEloquent;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryEloquent;
use App\Repositories\Department\DepartmentRepository;
use App\Repositories\Department\DepartmentRepositoryEloquent;
use App\Repositories\Frame\FrameRepository;
use App\Repositories\Frame\FrameRepositoryEloquent;
use App\Repositories\Medicine\MedicineRepository;
use App\Repositories\Medicine\MedicineRepositoryEloquent;
use App\Repositories\Prescription\PrescriptionRepository;
use App\Repositories\Prescription\PrescriptionRepositoryEloquent;
use App\Repositories\PrescriptionMedicine\PrescriptionMedicineRepository;
use App\Repositories\PrescriptionMedicine\PrescriptionMedicineRepositoryEloquent;
use App\Repositories\QrCode\QrCodeRepository;
use App\Repositories\QrCode\QrCodeRepositoryEloquent;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleRepositoryEloquent;
use App\Repositories\Schedule\ScheduleRepository;
use App\Repositories\Schedule\ScheduleRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(AppointmentRepository::class, AppointmentRepositoryEloquent::class);
        $this->app->bind(CaseHistoryRepository::class, CaseHistoryRepositoryEloquent::class);
        $this->app->bind(CategoryRepository::class, CategoryRepositoryEloquent::class);
        $this->app->bind(DepartmentRepository::class, DepartmentRepositoryEloquent::class);
        $this->app->bind(FrameRepository::class, FrameRepositoryEloquent::class);
        $this->app->bind(MedicineRepository::class, MedicineRepositoryEloquent::class);
        $this->app->bind(PrescriptionRepository::class, PrescriptionRepositoryEloquent::class);
        $this->app->bind(PrescriptionMedicineRepository::class, PrescriptionMedicineRepositoryEloquent::class);
        $this->app->bind(QrCodeRepository::class, QrCodeRepositoryEloquent::class);
        $this->app->bind(RoleRepository::class, RoleRepositoryEloquent::class);
        $this->app->bind(ScheduleRepository::class, ScheduleRepositoryEloquent::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

