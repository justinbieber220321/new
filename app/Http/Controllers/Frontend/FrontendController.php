<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController as BaseFrontendController;
use Illuminate\Support\Facades\Mail;

class FrontendController extends BaseFrontendController
{
    public function index()
    {
        return view('frontend.user.account');
    }

    public function support()
    {
        return view('frontend.support.index');
    }

    public function getTestSendMail()
    {
        return view('frontend.test-send-mail');
    }

    public function postTestSendMail()
    {
        $data = [];
        $email = request('email');
        $name = extractNameFromEmail($email);

        try {
            Mail::send('frontend.email_template.test-send-mail', $data, function($message) use ($email, $name)
            {
                $message->to($email, $name)->subject(getSiteName() . ' test send mail');
            });

            if( count(Mail::failures()) > 0 ) {
                logError("Module test send mail: Email $email is not exits");
                return backSystemError(transMessage('setting_send_mail_error'));
            }

            return backSuccess(transMessage('test_send_mail_success'));
        } catch (\Exception $e) {
            logError($e);
            return backSystemError(transMessage('system_error'));
        }
    }

    public function showTrangChu()
    {
        return redirect()->to('https://whalerich.com/');
    }

    public function showTrangAffiliate()
    {
        return view('frontend.affiliate');
    }
}