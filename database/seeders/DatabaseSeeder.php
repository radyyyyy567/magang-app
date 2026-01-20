<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Attendance;
use App\Models\Division;
use App\Models\InternshipApplication;
use App\Models\InternshipPosition;
use App\Models\ProfileInternship;
use App\Models\ProfileMentor;
use App\Models\ScheduleAttendance;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@magang.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Mentor Users
        $mentor1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@magang.test',
            'password' => Hash::make('password'),
            'role' => 'mentor',
        ]);

        $mentor2 = User::create([
            'name' => 'Siti Rahayu',
            'email' => 'siti@magang.test',
            'password' => Hash::make('password'),
            'role' => 'mentor',
        ]);

        // Create Intern Users
        $intern1 = User::create([
            'name' => 'Andi Wijaya',
            'email' => 'andi@magang.test',
            'password' => Hash::make('password'),
            'role' => 'intern',
        ]);

        $intern2 = User::create([
            'name' => 'Dewi Lestari',
            'email' => 'dewi@magang.test',
            'password' => Hash::make('password'),
            'role' => 'intern',
        ]);

        $intern3 = User::create([
            'name' => 'Rudi Hartono',
            'email' => 'rudi@magang.test',
            'password' => Hash::make('password'),
            'role' => 'intern',
        ]);

        // Create Mentor Profiles
        ProfileInternship::create([
            'mentor_id' => $mentor1->id,
            'nomor_induk' => 1001,
            'foto' => 'default.jpg',
            'no_telp' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 10, Jakarta',
            'jabatan' => 'Senior Developer',
        ]);

        ProfileInternship::create([
            'mentor_id' => $mentor2->id,
            'nomor_induk' => 1002,
            'foto' => 'default.jpg',
            'no_telp' => '081234567891',
            'alamat' => 'Jl. Sudirman No. 20, Jakarta',
            'jabatan' => 'HR Manager',
        ]);

        // Create Intern Profiles
        ProfileMentor::create([
            'intern_id' => $intern1->id,
            'nomor_induk' => 2001,
            'foto' => 'default.jpg',
            'no_telp' => '081234567892',
            'alamat' => 'Jl. Gatot Subroto No. 5, Jakarta',
            'instansi' => 'Universitas Indonesia',
            'awal_magang' => now(),
            'akhir_magang' => now()->addMonths(3),
        ]);

        ProfileMentor::create([
            'intern_id' => $intern2->id,
            'nomor_induk' => 2002,
            'foto' => 'default.jpg',
            'no_telp' => '081234567893',
            'alamat' => 'Jl. Thamrin No. 15, Jakarta',
            'instansi' => 'Universitas Gadjah Mada',
            'awal_magang' => now(),
            'akhir_magang' => now()->addMonths(3),
        ]);

        ProfileMentor::create([
            'intern_id' => $intern3->id,
            'nomor_induk' => 2003,
            'foto' => 'default.jpg',
            'no_telp' => '081234567894',
            'alamat' => 'Jl. Kuningan No. 25, Jakarta',
            'instansi' => 'Institut Teknologi Bandung',
            'awal_magang' => now(),
            'akhir_magang' => now()->addMonths(3),
        ]);

        // Create Divisions
        $divIT = Division::create([
            'name' => 'IT & Development',
            'description' => 'Divisi yang menangani pengembangan perangkat lunak dan infrastruktur teknologi informasi.',
        ]);

        $divHR = Division::create([
            'name' => 'Human Resources',
            'description' => 'Divisi yang menangani manajemen sumber daya manusia dan pengembangan karyawan.',
        ]);

        $divMarketing = Division::create([
            'name' => 'Marketing',
            'description' => 'Divisi yang menangani pemasaran dan promosi produk perusahaan.',
        ]);

        $divFinance = Division::create([
            'name' => 'Finance',
            'description' => 'Divisi yang menangani keuangan dan akuntansi perusahaan.',
        ]);

        // Create Activities
        $activity1 = Activity::create([
            'division_id' => $divIT->id,
            'mentor_id' => $mentor1->id,
            'title' => 'Pengembangan Website E-Commerce',
            'description' => 'Proyek pengembangan website e-commerce menggunakan Laravel dan Vue.js.',
            'quota' => 5,
            'status' => 'open',
        ]);

        $activity2 = Activity::create([
            'division_id' => $divIT->id,
            'mentor_id' => $mentor1->id,
            'title' => 'Implementasi API RESTful',
            'description' => 'Membuat API RESTful untuk aplikasi mobile menggunakan Laravel.',
            'quota' => 3,
            'status' => 'open',
        ]);

        $activity3 = Activity::create([
            'division_id' => $divHR->id,
            'mentor_id' => $mentor2->id,
            'title' => 'Rekrutmen Karyawan Baru',
            'description' => 'Membantu proses rekrutmen dan seleksi karyawan baru.',
            'quota' => 2,
            'status' => 'open',
        ]);

        $activity4 = Activity::create([
            'division_id' => $divMarketing->id,
            'mentor_id' => $mentor2->id,
            'title' => 'Kampanye Media Sosial',
            'description' => 'Merancang dan melaksanakan kampanye pemasaran di media sosial.',
            'quota' => 4,
            'status' => 'closed',
        ]);

        // Create Schedule Attendances
        $days = ['senin', 'selasa', 'rabu', 'kamis', 'jumat'];
        foreach ($days as $day) {
            ScheduleAttendance::create([
                'day_of_week' => $day,
                'start_time' => now()->setTime(8, 0),
                'end_time' => now()->setTime(17, 0),
                'status' => 'active',
            ]);
        }

        // Create Attendance Records (InternshipPosition)
        for ($i = 0; $i < 5; $i++) {
            InternshipPosition::create([
                'intern_id' => $intern1->id,
                'date' => now()->subDays($i),
                'check_in_time' => now()->subDays($i)->setTime(8, rand(0, 30)),
                'check_out_time' => now()->subDays($i)->setTime(17, rand(0, 30)),
                'status' => $i === 0 ? 'late' : 'present',
            ]);

            InternshipPosition::create([
                'intern_id' => $intern2->id,
                'date' => now()->subDays($i),
                'check_in_time' => now()->subDays($i)->setTime(8, rand(0, 15)),
                'check_out_time' => now()->subDays($i)->setTime(17, rand(0, 15)),
                'status' => 'present',
            ]);
        }

        // Create Internship Applications (Activity Submissions)
        InternshipApplication::create([
            'mentor_id' => $mentor1->id,
            'intern_id' => $intern1->id,
            'title' => 'Laporan Mingguan - Pengembangan Modul Login',
            'description' => 'Telah menyelesaikan pengembangan modul login dengan fitur autentikasi dua faktor.',
            'activity_date' => now()->subDays(2),
        ]);

        InternshipApplication::create([
            'mentor_id' => $mentor1->id,
            'intern_id' => $intern2->id,
            'title' => 'Laporan Mingguan - Desain Database',
            'description' => 'Telah menyelesaikan desain database untuk sistem e-commerce.',
            'activity_date' => now()->subDays(1),
        ]);

        InternshipApplication::create([
            'mentor_id' => $mentor2->id,
            'intern_id' => $intern3->id,
            'title' => 'Laporan Mingguan - Analisis Kebutuhan',
            'description' => 'Telah menyelesaikan analisis kebutuhan untuk sistem rekrutmen.',
            'activity_date' => now(),
        ]);

        $this->command->info('Database seeded successfully!');
        $this->command->info('Login credentials:');
        $this->command->info('Admin: admin@magang.test / password');
        $this->command->info('Mentor: budi@magang.test / password');
        $this->command->info('Intern: andi@magang.test / password');
    }
}
