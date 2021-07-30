<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CodeRequest;
use App\Interfaces\CodeInterface;
use App\Models\Code;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CodeResource;
use App\Repositories\Code\CodeRepositoryInterface;
use App\Http\Controllers\CmdController;

class CodeController extends Controller
{
    protected $codeRepository;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(CodeRepositoryInterface $codeRepository)
    {
        $this->codeRepository = $codeRepository;
    }
    public function index()
    {
        return  $this->codeRepository->getAll();
    }

    public function store()
    {
        
        // Transaction DB
        DB::beginTransaction();
        try {
            $resp = $this->codeRepository->insertGetId([
                'code' => CmdController::getCode(),
                'isUsed'=> false
            ]);
            DB::commit();
            return new CodeResource($this->codeRepository->find($resp));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Xảy ra khi thêm mới mã!'], 422);
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

       $resp = $this->codeRepository->delete($id);

        if($resp) {
            return response()->json(['status' => true], 200);    
        }else {
            return response()->json(['status' => false], 422);
        }
    
    }
}
