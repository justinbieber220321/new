<?php namespace App\Console\Commands;

use App\Model\Entities\CoinAddress;
use App\Services\TRXService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CronjobInsertAddress extends Command
{
    protected $_TrxService;

    public function __construct(TRXService $TRXService)
    {
        $this->_TrxService = $TRXService;
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert-address';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'Add daa to address table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add daa to address table';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::beginTransaction();
        try {
            // add address to coin_address table
            $countAddressNotUsed = CoinAddress::where('status', getConfig('coin_address_status_not_used'))->count();
            if ($countAddressNotUsed <= 50) {
                $dataAddressStore = [];
                for ($i = 0; $i < 100; $i++) {
                    $address = $this->_TrxService->getListAddress();
                    if ($address) {
                        $tmp['private_key'] = $address->getPrivateKey();
                        $tmp['address'] = $address->getAddress(true);
                        array_push($dataAddressStore, $tmp);
                    }
                }
                CoinAddress::insert($dataAddressStore);
            }

            DB::commit(); // all good
            return 1;
        } catch (\Exception $e) {
            logError($e);
            DB::rollBack();
        }
        return 0;
    }
}