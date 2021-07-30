<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterAuthRequest;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UseroController extends Controller
{
    protected $userRepository;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index()
    {
        return  UserResource::collection($this->userRepository->getAll());
    }

    public function store(UserRequest $requets)
    {
        $req = $requets->validated();
        $userInfo = $this->userRepository->where('email', $req['email'])->first();
        if ($userInfo != NULL) {
            return response()->json(['message' => 'Tài khoản đã tồn tại'], 422);
        }

        // Transaction DB
        DB::beginTransaction();
        try {
            $resp = $this->userRepository->insertGetId([
                'name' => $req['name'],
                'email' => $req['email'],
                'password' => Hash::make($req['password']),
                'code' => $req['code'],
            ]);

            // if (!empty($request['roles']) && $resp != NULL) {
            //     $roleId = $rolesModel->insertGetId([
            //         'user_id' => $resp,
            //         'role' => $request['roles']
            //     ]);
            //     if (!$roleId) {
            //         return response()->json(['message' => 'Xảy ra lỗi hệ thống khi thêm quyền người dùng!'], 422);
            //     }
            // }
            DB::commit();
            return new UserResource($this->userRepository->find($resp));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Xảy ra khi thêm mới người dùng!'], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

       $resp = $this->userRepository->delete($id);

        if($resp) {
            return response()->json(['status' => true], 200);    
        }else {
            return response()->json(['status' => false], 422);
        }
    
    }
}
