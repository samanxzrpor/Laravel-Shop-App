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

    public function all(string $orderBy = 'created_at')
    {
        $this->orderByMostPurchases($orderBy);

        $this->orderByCommentCount($orderBy);

        $this->orderByReviewCount($orderBy);

        return User::orderByDesc($orderBy)
            ->paginate(20);
    }


    public function block(User $user)
    {
        $block = $user->block === 'no' ? 'yes' : 'no';

        $user->update([
            'block' => $block
        ]);
    }


    public function changeRole(User $user , RequestInterface $request)
    {
        $role = $request->validated()['role'];

        $user->assignRole($role);
    }


    protected function orderByMostPurchases(string $orderBy)
    {
        if ($orderBy === 'purchase') {
            return User::orderByDesc(
                Order::select('total_amount')
                    ->whereColumn('user_id' , 'users.id')
                    ->orderBy('total_amount', 'ASC')
            )->get();
        }
    }


    protected function orderByCommentCount(string $orderBy)
    {
        if ($orderBy === 'most_comment')
            return DB::select($this->sqlCommandForOrdering('users' , 'comments'));
    }


    protected function orderByReviewCount(string $orderBy)
    {
        if ($orderBy === 'most_review')
            return DB::select($this->sqlCommandForOrdering('users' , 'reviews'));
    }


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
