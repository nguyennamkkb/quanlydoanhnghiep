<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Input\InputRepositoryInterface;
use App\Http\Resources\InputResource;
use App\Models\Code;
use App\Http\Requests\InputRequest;
use Illuminate\Support\Facades\DB;

class InputController extends Controller
{
    protected $InputRepository;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(InputRepositoryInterface $InputRepository)
    {
        $this->InputRepository = $InputRepository;
    }
    public function index(Request $request)
    {
        // $keyword = $request->keyword;
        // $address = $request->address;
        // $phone = $request->phone;
        // $limit = $request->limit;
        // $list = $this->InputRepository->findBy($keyword,$address, $phone)->paginate($limit);
        // return InputResource::collection($list);
    }
    
    public function store(InputRequest $request)
    {
        $req = $request->validated();
        DB::beginTransaction();
        try {
            $this->InputRepository->insertGetId([
                'date' => $req['date'],
                'supplier_id' => $req['supplier_id'],
                'totalweight_id' => $req['totalweight_id'],
                'importer_id' => $req['importer_id'],
                'carrier_id' => $req['carrier_id'],
            ]);
            DB::commit();
            return response()->json(['status' => true], 200);  
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false], 422);
        }
    }
    public function update(InputRequest $request, $id)
    {
        $req = $request->validated();
        DB::beginTransaction();
        try {
            $this->InputRepository->update($id,[
                'date' => $req['date'],
                'supplier_id' => $req['supplier_id'],
                'totalweight_id' => $req['totalweight_id'],
                'importer_id' => $req['importer_id'],
                'carrier_id' => $req['carrier_id'],
            ]);
            DB::commit();
            return response()->json(['status' => true], 200);  
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false], 422);
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

       $resp = $this->InputRepository->delete($id);

        if($resp) {
            return response()->json(['status' => true], 200);    
        }else {
            return response()->json(['status' => false], 422);
        }
    
    }
}
