<?php

namespace App\Support;

class ModuleCatalog
{
    /**
     * @return array<string, string>
     */
    public static function all(): array
    {
        return [
            'explore' => 'Explore',
            'near-gyms' => 'Near Gyms',
            'near-coaches' => 'Near Coaches',
            'schedule' => 'Schedule',
            'checkin' => 'Check-In',
            'workouts' => 'Workouts',
            'coaches' => 'Coaches',
            'nutrition' => 'Nutrition',
            'supplements' => 'Supplements Shop',
            'clients' => 'Clients',
            'members' => 'Members',
            'inventory' => 'Inventory',
        ];
    }

    /**
     * @return array<int, string>
     */
    public static function keys(): array
    {
        return array_keys(self::all());
    }

    /**
     * @return array<string, array<int, string>>
     */
    public static function byRole(): array
    {
        return [
            'user' => ['explore', 'near-gyms', 'near-coaches'],
            'member' => ['schedule', 'checkin', 'workouts', 'coaches', 'nutrition', 'supplements'],
            'coach' => ['clients', 'workouts'],
            'nutrition-specialist' => ['members'],
            'admin' => ['coaches', 'members', 'inventory'],
            'super-admin' => [],
        ];
    }

    /**
     * @return array<int, string>
     */
    public static function keysForRole(string $role): array
    {
        return self::byRole()[$role] ?? [];
    }

    /**
     * @return array<int, array{key: string, label: string}>
     */
    public static function modulesForRole(string $role): array
    {
        $all = self::all();
        $keys = self::keysForRole($role);

        return array_values(array_map(static fn (string $key): array => [
            'key' => $key,
            'label' => $all[$key] ?? $key,
        ], $keys));
    }
}
