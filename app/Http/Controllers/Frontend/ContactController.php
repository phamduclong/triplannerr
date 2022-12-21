<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Contact\SendContactRequest;
use App\Mail\Frontend\Contact\SendContact;
use Illuminate\Support\Facades\Mail;
use SendinBlue;
use GuzzleHttp;

/**
 * Class ContactController.
 */
class ContactController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.contact');
    }

    /**
     * @param SendContactRequest $request
     *
     * @return mixed
     */
    public function send(SendContactRequest $request)
    {
        // $this->configcontact();
        // die;
        Mail::send(new SendContact($request));

        return redirect()->back()->withFlashSuccess(__('alerts.frontend.contact.sent'));
    }

    // public function configcontact(){
        
    //     require_once(base_path() . '/vendor/autoload.php');
    //     // Configure API key authorization: api-key
    //     $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
    //     $apiInstance = new SendinBlue\Client\Api\ContactsApi(
    //         new GuzzleHttp\Client(),
    //         $config
    //     );
    //     $createContact = new \SendinBlue\Client\Model\CreateContact(); // Values to create a contact
    //     $createContact['email'] = 'developer.wdp@gmail.com';
    //     $createContact['listIds'] = [1];
    //     //echo "<pre>";
    //     //print_r($apiInstance );die;
    //     try {
    //         $result = $apiInstance->createContact($createContact);
    //         print_r($result);
    //     } catch (Exception $e) {
    //             print_r($e);
    //         echo 'Exception when calling ContactsApi->createContact: ', $e->getMessage(), PHP_EOL;
    //     }
        /*
        $api_instance = new SendinBlue\Client\Api\EmailCampaignsApi();
        $emailCampaigns = new \SendinBlue\Client\Model\CreateEmailCampaign();
        # Define the campaign settings\
        $email_campaigns['name'] = "Campaign sent via the API";
        $email_campaigns['subject'] = "My subject";
        $email_campaigns['sender'] = array("name": "From name", "email":"dario@findandsharetravel.com");
        $email_campaigns['type'] = "classic";
        # Content that will be sent\
        "htmlContent"=> "Congratulations! You successfully sent this example campaign via the Sendinblue API.",
        # Select the recipients\
        "recipients"=> array("listIds"=> [2, 7]),
        # Schedule the sending in one hour\
        "scheduledAt"=> "2018-01-01 00:00:01"
        );
        # Make the call to the client\
        try {
        $result = $api_instance->createEmailCampaign($emailCampaigns);
        print_r($result);
        }
        */
    //}

}
