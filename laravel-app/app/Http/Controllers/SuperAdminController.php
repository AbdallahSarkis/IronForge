<?php

namespace App\Http\Controllers;

use App\Support\ModuleCatalog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{
    /** GET /super-admin/stats — platform-wide KPI numbers */
    public function stats(Request $request): JsonResponse
    {
        $totalUsers         = DB::table('users')->count();
        $totalMembers       = DB::table('users')->where('role', 'member')->count();
        $totalCoaches       = DB::table('users')->where('role', 'coach')->count();
        $totalAdmins        = DB::table('users')->where('role', 'admin')->count();
        $totalNutrition     = DB::table('users')->where('role', 'nutrition-specialist')->count();
        $totalOrders        = DB::table('orders')->count();
        $totalRevenue       = (float) DB::table('orders')->sum('total');
        $totalCheckIns      = DB::table('check_ins')->count();
        $todayCheckIns      = DB::table('check_ins')->whereDate('check_in_time', now()->toDateString())->count();
        $totalNutritionLogs = DB::table('nutrition_entries')->count();
        $totalWorkouts      = DB::table('workouts')->count();
        $totalProducts      = DB::table('products')->count();

        return response()->json([
            'total_users'          => $totalUsers,
            'total_members'        => $totalMembers,
            'total_coaches'        => $totalCoaches,
            'total_admins'         => $totalAdmins,
            'total_nutrition_specialists' => $totalNutrition,
            'total_orders'         => $totalOrders,
            'total_revenue'        => $totalRevenue,
            'total_check_ins'      => $totalCheckIns,
            'today_check_ins'      => $todayCheckIns,
            'total_nutrition_logs' => $totalNutritionLogs,
            'total_workouts'       => $totalWorkouts,
            'total_products'       => $totalProducts,
        ]);
    }

    /** GET /super-admin/modules — list all configurable modules */
    public function modules(Request $request): JsonResponse
    {
        return response()->json([
            'modules' => collect(ModuleCatalog::all())
                ->map(fn (string $label, string $key): array => [
                    'key' => $key,
                    'label' => $label,
                ])
                ->values()
                ->all(),
            'modules_by_role' => ModuleCatalog::byRole(),
        ]);
    }

    /** GET /super-admin/gyms — all gym/admin accounts */
    public function gyms(Request $request): JsonResponse
    {
        $gyms = DB::table('users')
            ->where('role', 'admin')
            ->orderBy('name')
            ->get(['id', 'name', 'email', 'gym_name', 'gym_open_time', 'gym_close_time', 'location_address', 'created_at'])
            ->map(fn (object $g): array => [
                'id'             => (int) $g->id,
                'owner_name'     => $g->name,
                'email'          => $g->email,
                'gym_name'       => $g->gym_name ?: 'Unnamed Gym',
                'gym_open'       => $g->gym_open_time,
                'gym_close'      => $g->gym_close_time,
                'address'        => $g->location_address,
                'member_count'   => DB::table('coach_member')->distinct()->count(), // placeholder
                'joined'         => $g->created_at ? date('M j, Y', strtotime((string) $g->created_at)) : '—',
            ])
            ->values()
            ->all();

        return response()->json(['gyms' => $gyms]);
    }

    /** GET /super-admin/users — all users across all roles */
    public function users(Request $request): JsonResponse
    {
        $role   = $request->query('role', '');
        $search = trim((string) $request->query('search', ''));

        $query = DB::table('users')->orderBy('role')->orderBy('name');

        if ($role && $role !== 'all') {
            $query->where('role', $role);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->get(['id', 'name', 'email', 'role', 'gender', 'date_of_birth', 'module_access', 'created_at'])
            ->map(fn (object $u): array => [
                'id'       => (int) $u->id,
                'name'     => $u->name,
                'email'    => $u->email,
                'role'     => $u->role,
                'gender'   => $u->gender,
                'dob'      => $u->date_of_birth,
                'module_access' => json_decode((string) ($u->module_access ?: 'null'), true),
                'joined'   => $u->created_at ? date('M j, Y', strtotime((string) $u->created_at)) : '—',
            ])
            ->values()
            ->all();

        return response()->json(['users' => $users, 'total' => count($users)]);
    }

    /** GET /super-admin/coaches — all coaches with client count */
    public function coaches(Request $request): JsonResponse
    {
        $coaches = DB::table('users')
            ->join('coaches', 'coaches.user_id', '=', 'users.id')
            ->where('users.role', 'coach')
            ->orderBy('users.name')
            ->get([
                'users.id', 'users.name', 'users.email', 'users.gender',
                'coaches.specialization', 'coaches.experience_years',
                'coaches.rating', 'coaches.phone_number',
            ])
            ->map(function (object $c): array {
                $clientCount = DB::table('coach_member')->where('coach_id', $c->id)->count();
                return [
                    'id'               => (int) $c->id,
                    'name'             => $c->name,
                    'email'            => $c->email,
                    'gender'           => $c->gender,
                    'specialization'   => $c->specialization,
                    'experience_years' => (int) $c->experience_years,
                    'rating'           => $c->rating ? (float) $c->rating : null,
                    'phone'            => $c->phone_number,
                    'client_count'     => $clientCount,
                ];
            })
            ->values()
            ->all();

        return response()->json(['coaches' => $coaches]);
    }

    /** GET /super-admin/reports — revenue, check-ins, orders by date */
    public function reports(Request $request): JsonResponse
    {
        // Last 30 days check-ins per day
        $checkIns = DB::table('check_ins')
            ->selectRaw('DATE(check_in_time) as day, COUNT(*) as total')
            ->where('check_in_time', '>=', now()->subDays(29)->startOfDay())
            ->groupBy('day')
            ->orderBy('day')
            ->get()
            ->map(fn ($r) => ['day' => $r->day, 'total' => (int) $r->total])
            ->values()
            ->all();

        // Orders by status
        $ordersByStatus = DB::table('orders')
            ->selectRaw('status, COUNT(*) as count, SUM(total) as revenue')
            ->groupBy('status')
            ->get()
            ->map(fn ($r) => ['status' => $r->status, 'count' => (int) $r->count, 'revenue' => (float) $r->revenue])
            ->values()
            ->all();

        // Top 5 products by quantity sold
        $topProducts = DB::table('order_items')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->selectRaw('products.name, SUM(order_items.quantity) as qty_sold, SUM(order_items.quantity * order_items.price) as revenue')
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('qty_sold')
            ->limit(5)
            ->get()
            ->map(fn ($r) => ['name' => $r->name, 'qty_sold' => (int) $r->qty_sold, 'revenue' => (float) $r->revenue])
            ->values()
            ->all();

        // Role distribution
        $roleDistribution = DB::table('users')
            ->selectRaw('role, COUNT(*) as count')
            ->groupBy('role')
            ->get()
            ->map(fn ($r) => ['role' => $r->role, 'count' => (int) $r->count])
            ->values()
            ->all();

        return response()->json([
            'check_ins'         => $checkIns,
            'orders_by_status'  => $ordersByStatus,
            'top_products'      => $topProducts,
            'role_distribution' => $roleDistribution,
        ]);
    }

    /** POST /super-admin/users/{id}/role — change a user's role */
    public function changeUserRole(Request $request, int $id): JsonResponse
    {
        $data = $request->validate([
            'role' => ['required', 'string', 'in:user,member,coach,admin,nutrition-specialist'],
        ]);

        $affected = DB::table('users')->where('id', $id)->where('role', '!=', 'super-admin')->update(['role' => $data['role'], 'updated_at' => now()]);

        if (! $affected) {
            return response()->json(['message' => 'User not found or cannot change super-admin role.'], 404);
        }

        return response()->json(['message' => 'Role updated successfully.']);
    }

    /** POST /super-admin/users/{id}/modules — set user module access */
    public function updateUserModules(Request $request, int $id): JsonResponse
    {
        $user = DB::table('users')->where('id', $id)->first(['id', 'role']);

        if (! $user || $user->role === 'super-admin') {
            return response()->json(['message' => 'User not found or cannot update super-admin modules.'], 404);
        }

        $allowedModules = ModuleCatalog::keysForRole((string) $user->role);
        $validator = Validator::make($request->all(), [
            'modules' => ['nullable', 'array'],
            'modules.*' => ['string', 'in:'.implode(',', $allowedModules)],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid modules for selected user role.',
                'errors' => $validator->errors(),
                'allowed_modules' => $allowedModules,
            ], 422);
        }

        $data = $validator->validated();

        $modules = array_values(array_unique($data['modules'] ?? []));

        DB::table('users')
            ->where('id', $id)
            ->update([
                'module_access' => json_encode($modules),
                'updated_at' => now(),
            ]);

        return response()->json([
            'message' => 'Module access updated successfully.',
            'available_modules' => $allowedModules,
            'module_access' => $modules,
        ]);
    }

    /** DELETE /super-admin/users/{id} — delete any non-super-admin user */
    public function deleteUser(Request $request, int $id): JsonResponse
    {
        $user = DB::table('users')->where('id', $id)->where('role', '!=', 'super-admin')->first();

        if (! $user) {
            return response()->json(['message' => 'User not found or cannot delete super-admin.'], 404);
        }

        DB::table('users')->where('id', $id)->delete();

        return response()->json(['message' => 'User deleted successfully.']);
    }
}
