<?php namespace App\Console\Commands;

use App\Model\Entities\User;
use App\Services\TRXService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Cronjob2 extends Command
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
    protected $signature = 'insert-to-user-list';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'Handle insert data to user table by call api from another system';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handle insert data to user table by call api from another system';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::beginTransaction();
        try {

            $dateTo = date('Y-m-d', strtotime('+0 day', time()));
            $dataApi = callApi("https://login.nuxgame.com/api/stat/user_list?company_id=a37c5f23-7181-44cb-9702-35886ef7b696&date_from=$dateTo&date_to=$dateTo");

            foreach ($dataApi as $key => $item) {
                $user = User::delFlagOn()->where('email', arrayGet($item, 'email'))->first();
                if (!empty($user)) {
                    continue;
                }

                $user = new User();
                $user->user_id = arrayGet($item, 'user_id');
                $user->username = arrayGet($item, 'username') ? arrayGet($item, 'username') : extractNameFromEmail(arrayGet($item, 'email'));
                $user->email = arrayGet($item, 'email');
                $user->balance = arrayGet($item, 'balance');
                $user->parent_id = arrayGet($item, 'parent_id');
                $user->player_code = (int)arrayGet($item, 'player_code');
                $user->status = userStatusWaitingActiveEmail();
                $user->save();

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
