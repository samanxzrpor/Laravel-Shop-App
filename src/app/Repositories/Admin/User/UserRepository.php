<?php

namespace App\Repositories\Admin\User;

use App\Http\Requests\API\Admin\Users\ChangeUserRoleRequest;
use App\Http\Requests\RequestInterface;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as StatusResponse;

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

        if ($orderBy === 'most_comment')
            return $this->orderByCommentCount();

        if ($orderBy === 'most_review')
            $this->orderByReviewCount();

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
        return User::orderByDesc(
            Order::select('total_amount')
                ->whereColumn('user_id' , 'users.id')
                ->orderBy('total_amount', 'ASC')
            )->addSelect([
            'buy_price' => Order::select('total_amount')->whereColumn('user_id' , 'users.id')->orderBy('total_amount', 'ASC')
            ])->get();

    }


    /**
     * @param User $user
     * @param string $role
     * @return JsonResponse|void
     */
    public function changeRole(User $user , RequestInterface $request)
    {
        $role = $request->validated()['role'];

        $user->assignRole($role);
    }


    protected function orderByCommentCount()
    {
        return DB::select("SELECT users.email, COUNT(DISTINCT comments.id) as comments
        FROM users
        JOIN comments on comments.user_id = users.id
        GROUP BY users.email
        HAVING MAX(comments.created_at) >= last_day(now()) + interval 1 day - interval 2 month
        ORDER BY comments DESC");
    }


    protected function orderByReviewCount()
    {
        return DB::select("SELECT users.email, COUNT(DISTINCT reviews.id) as reviews
        FROM users
        JOIN reviews on reviews.user_id = users.id
        GROUP BY users.email
        HAVING MAX(reviews.created_at) >= last_day(now()) + interval 1 day - interval 2 month
        ORDER BY reviews DESC");
    }
}
