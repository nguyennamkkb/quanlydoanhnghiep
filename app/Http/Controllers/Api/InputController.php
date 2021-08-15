<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Input\InputRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Price\PriceRepositoryInterface;
use App\Repositories\Employee\EmployeeRepositoryInterface;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Unit\UnitRepositoryInterface;
use App\Http\Resources\InputResource;
use App\Models\Code;
use App\Http\Requests\InputRequest;
use Illuminate\Support\Facades\DB;

class InputController extends Controller
{
    protected $InputRepository;
    protected $categoryRepository;
    protected $PriceRepository;
    protected $EmployeeRepository;
    protected $CustomerRepository;
    protected $UnitRepository;
    // protected $InputRepository;
    // protected $InputRepository;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(
        InputRepositoryInterface $InputRepository,
        PriceRepositoryInterface $PriceRepository,
        EmployeeRepositoryInterface $EmployeeRepository,
        CustomerRepositoryInterface $CustomerRepository,
        CategoryRepositoryInterface $categoryRepository,
        UnitRepositoryInterface $UnitRepository
        )
    {
        $this->InputRepository = $InputRepository;
        $this->PriceRepository = $PriceRepository;
        $this->EmployeeRepository = $EmployeeRepository;
        $this->CustomerRepository = $CustomerRepository;
        $this->categoryRepository = $categoryRepository;
        $this->UnitRepository = $UnitRepository;
    }
    public function index()
    {
        $input = InputResource::collection($this->InputRepository->all());
        $price = InputResource::collection($this->PriceRepository->all());
        $employee = InputResource::collection($this->EmployeeRepository->all());
        $customer = InputResource::collection($this->CustomerRepository->all());
        $category = InputResource::collection($this->categoryRepository->all());
        $unit = InputResource::collection($this->UnitRepository->all());

        return response()->json(
            ['input' => $input,
            'price' => $price,
            'employee' => $employee,
            'customer' => $customer,
            'category' => $category,
            'unit' => $unit,
            ], 200);
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
