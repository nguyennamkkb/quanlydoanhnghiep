<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\Supplier\SupplierRepositoryInterface;
use App\Http\Requests\SupplierRequest;
use App\Http\Resources\SupplierResource;



class SupplierController extends Controller
{
    protected $supplierRepository;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $status = $request->isUsed;
        $limit = $request->limit;
        
        $list = $this->supplierRepository->findBy($status,$keyword)->paginate($limit);
        return SupplierResource::collection($list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        $req = $request->validated();
        $supplierInfo = $this->supplierRepository->where('name', $req['name'])->first();

        if ($supplierInfo != NULL) {
            return response()->json(['status' => false,'message' => 'Tên nhà cung cấp trùng!'], 200);
        }

        // Transaction DB
        DB::beginTransaction();
        try {
            $this->supplierRepository->insertGetId([
                'name' => $req['name'],
                'address' => $req['address'],
                'phone' => $req['phone'],
                'email' => $req['email'],
            ]);
            
            DB::commit();
            return response()->json(['status' => true], 200);    
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, $id)
    {
        $req = $request->validated();
        DB::beginTransaction();
        try {
            $this->supplierRepository->update( $id, [
                'name' => $req['name'],
                'address' => $req['address'],
                'phone' => $req['phone'],
                'email' => $req['email'],
            ]);
            
            DB::commit();
            return response()->json(['status' => true], 200);    
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resp = $this->supplierRepository->delete($id);

        if($resp) {
            return response()->json(['status' => true], 200);    
        }else {
            return response()->json(['status' => false], 422);
        }
    }
}
