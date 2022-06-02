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
     * @return array|LengthAwarePaginator
     */
    public function all(string $orderBy = 'created_at')
    {
        if ($orderBy === 'purchase')
            return $this->orderByMostPurchases();

        if ($orderBy === 'most_comment')
            return $this->orderByCommentCount();

        if ($orderBy === 'most_review')
            return $this->orderByReviewCount();

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
    protected function orderByMostPurchases(): LengthAwarePaginator
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
     * @param RequestInterface $request
     * @return void
     */
    public function changeRole(User $user , RequestInterface $request)
    {
        $role = $request->validated()['role'];

        $user->assignRole($role);
    }


    /**
     * @return array
     */
    protected function orderByCommentCount()
    {
        return DB::select($this->sqlCommandForOrdering('users' , 'comments'));
    }


    /**
     * @return array
     */
    protected function orderByReviewCount()
    {
        return DB::select($this->sqlCommandForOrdering('users' , 'reviews'));
    }


    /**
     * @param string $table1
     * @param string $table2
     * @return string
     */
    protected function sqlCommandForOrdering(string $table1 , string $table2): string
    {
        return "SELECT $table1.id , $table1.name , $table1.number , $table1.created_at , $table1.email, COUNT(DISTINCT $table2.id) as $table2
        FROM $table1
        JOIN $table2 on $table2.user_id = users.id
        GROUP BY $table1.id , $table1.name , $table1.number , $table1.created_at , $table1.email
        HAVING MAX($table2.created_at) >= last_day(now()) + interval 1 day - interval 2 month
        ORDER BY $table2 DESC";
    }
}
