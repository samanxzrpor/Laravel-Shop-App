<?php

namespace App\Repositories\Admin\User;

use App\Http\Requests\RequestInterface;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{

    /**
     * @param string $orderBy
     * @return LengthAwarePaginator
     */
    public function all(string $orderBy = 'created_at')
    {
        if ($orderBy === 'purchase')
            return $this->orderByMostPurchases();

        return User::orderByDesc($orderBy)
            ->paginate(20);
    }


    /**
     * @param User $user
     * @return void
     */
    public function block(User $user)
    {
        $block = $user->block === 'no' ? 'yes' : 'no';

        $user->update([
            'block' => $block
        ]);
    }


    /**
     * @return LengthAwarePaginator
     */
    protected function orderByMostPurchases()
    {
        return User::with(['payments' => function($query){
            $query->orderByDesc('amount');
        }])->paginate(20);
    }
}
