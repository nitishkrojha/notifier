<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sms\Service;
use App\Models\Sms;
use App\Models\Template;
use App\Jobs\ProcessSms;

class SmsController extends Controller
{
    public function post(Request $request)
    {
        $request->validate([
            'template_id' => 'bail|required|integer',
            'template_params' => 'bail|array',
            'provider_id' => ['bail', 'integer', function ($attribute, $value, $fail) {
                if (!Service::isValidProvider($value)) {
                    $fail('The sms provider id is invalid.');
                }
            }],
            'provider_sender_id' => 'bail|required|string|size:6',
            // TODO: Use better library for phone number validation.
            'phone' => 'bail|required|string|min:10|max:15',
        ]);

        $template = Template::findOrFail($request->template_id);

        $sms = new Sms;
        $sms->client_id = $request->getAuthenticatedClient()->id;
        $sms->template_id = $request->template_id;
        $sms->provider_id = $request->provider_id;
        $sms->provider_sender_id = $request->provider_sender_id;
        $sms->phone = $request->phone;
        // TODO: Find a better templating library to use. This one does not do proper params validation.
        $sms->text = (new \StringTemplate\Engine)->render($template->text, $request->template_params);

        $sms->save();

        ProcessSms::dispatch($sms);

        return $sms;
    }

    public function list(Request $request)
    {
        $request->validate([
            'page' => 'bail|integer|min:1|max:10',
            'per_page' => 'bail|integer|min:10|max:25',
            // TODO: Move status validation to its place in Sms\Status.php file.
            'status' => 'bail|string|in:pending,success,failed',
        ]);

        $qb = Sms::forClient($request->getAuthenticatedClient());
        if ($request->has('status')) {
            $qb->where('status', $request->status);
        }

        return $qb->paginate($request->per_page ?? 10);
    }

    public function get(Request $request, string $id)
    {
        return Sms::forClient($request->getAuthenticatedClient())->findOrFail($id);
    }
}
