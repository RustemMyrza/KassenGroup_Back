<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Http\Resources\PartnerResource;
use App\Http\Resources\NavBarResource;
use App\Http\Resources\LogoResource;
use App\Http\Resources\FooterContactsResource;
use App\Models\Pages\MainPage;
use App\Models\Pages\AboutUsPage;
use App\Models\Pages\GrainExportsPage;
use App\Models\Pages\GrainPurchasePage;
use App\Models\Pages\ElevatorServicesPage;
use App\Models\Pages\ContactsPage;
use App\Models\NavBar;
use App\Models\Logo;
use App\Models\Partner;
use App\Models\FooterContact;
use App\Models\FormsContent\ApplicationFormContent;
use App\Models\FormsContent\SubscriptionFormContent;
use Illuminate\Http\Request;
use App\Library\ResourcePaginator;;
use stdClass;

use function Ramsey\Uuid\v1;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function navbar ()
    {
        $navbar = NavBar::query()->with('getName')->get();
        return NavBarResource::collection($navbar);
    }

    private function applicationFormContent ()
    {
        $applicationFormContent = ApplicationFormContent::query()->with('getTitle', 'getContent')->get();
        $form = new stdClass;

        foreach ($applicationFormContent as $key => $value)
        {
            switch($key)
            {
                case 0:
                    $title = $value ? new PageResource($value) : '';
                    break;
                case 1:
                    $form->namePlaceholder = $value ? new PageResource($value) : '';
                    break;
                case 2:
                    $form->phonePlaceholder = $value ? new PageResource($value) : '';
                    break;
                case 3:
                    $form->submitButton = $value ? new PageResource($value) : '';
                    break;
                case 4:
                    $image = $value ? new PageResource($value) : '';
                    break;
            }
        }
        $applicationFormApi = new stdClass;
        $applicationFormApi->title = $title;
        $applicationFormApi->form = $form;
        $applicationFormApi->image = $image;
        return $applicationFormApi;
    }

    private function subscriptionFormContent ()
    {
        $subscriptionFormContent = SubscriptionFormContent::query()->with('getTitle', 'getContent')->get();

        foreach ($subscriptionFormContent as $key => $value)
        {
            switch($key)
            {
                case 0:
                    $description = $value ? new PageResource($value) : '';
                    break;
                case 1:
                    $emailPlaceholder = $value ? new PageResource($value) : '';
                    break;
            }
        }
        $subscriptionFormApi = new stdClass;
        $subscriptionFormApi->description = $description;
        $subscriptionFormApi->emailPlaceholder = $emailPlaceholder;
        return $subscriptionFormApi;
    }

    private function footerContacts ()
    {
        $footerContactTexts = FooterContact::query()->with('getText')->get();
        $emails = new stdClass;
        $phoneNumbers = new stdClass;
        foreach($footerContactTexts as $key => $value)
        {
            switch($key)
            {
                case 0:
                    $phoneNumbers->salesDepartment = $value ? new FooterContactsResource($value) : '';
                    break;
                case 1:
                    $phoneNumbers->reception = $value ? new FooterContactsResource($value) : '';
                    break;
                case 2:
                    $emails->elevator = $value ? new FooterContactsResource($value) : '';
                    break;
                case 3:
                    $emails->agroNan = $value ? new FooterContactsResource($value) : '';
                    break;
                case 4:
                    $phoneNumbers->deputyDirector = $value ? new FooterContactsResource($value) : '';
                    break;
                case 5:
                    $phoneNumbers->director = $value ? new FooterContactsResource($value) : '';
                    break;
            }
        }
        $footerContactsApi = new stdClass;
        $footerContactsApi->phoneNumbers = $phoneNumbers;
        $footerContactsApi->emails = $emails;
        return $footerContactsApi;
    }
    
    public function mainPage ()
    {
        $mainPageContent = MainPage::query()->with('getTitle', 'getContent')->get();
        $partners = Partner::query()->get();
        $partners = PartnerResource::collection($partners);
        foreach ($partners as $item)
        {
            if ($item->type == 1)
            {
                $type_1[] = $item;
            }
            else if ($item->type == 2)
            {
                $type_2[] = $item;
            }
            else
            {
                $type_3[] = $item;
            }
        }
        
        $banner = new stdClass;
        $production = new stdClass;
        $aboutCompany = new stdClass;
        $elevator = new stdClass;
        $exportGrain = new stdClass;
        $advantage = new stdClass;
        $ourPartners = new stdClass;
        $ourPartners->type_1 = new stdClass;
        $ourPartners->type_2 = new stdClass;
        $ourPartners->type_3 = new stdClass;

        foreach ($mainPageContent as $key => $value)
        {
            switch ($key)
            {
                case 0:
                    $banner->backgroundImage = $value ? new PageResource($value) : '';
                    break;
                case 1:
                    $banner->mainBlock = $value ? new PageResource($value) : '';
                    break;
                case 2:
                    $banner->applicationButton = $value ? new PageResource($value) : '';
                    break;
                case 3:
                    $production->aboutButton = $value ? new PageResource($value) : '';
                    break;
                case 4:
                    $production->block = $value ? new PageResource($value) : '';
                    break;
                case 5:
                    $production->readMoreButton = $value ? new PageResource($value) : '';
                    break;
                case 6:
                    $production->images[] = $value ? new PageResource($value) : '';
                    break;
                case 7:
                    $production->images[] = $value ? new PageResource($value) : '';
                    break;
                case 8:
                    $production->images[] = $value ? new PageResource($value) : '';
                    break;
                case 9:
                    $production->images[] = $value ? new PageResource($value) : '';
                    break;
                case 10:
                    $production->images[] = $value ? new PageResource($value) : '';
                    break;
                case 11:
                    $aboutCompany->title = $value ? new PageResource($value) : '';
                    break;
                case 12:
                    $aboutCompany->text_1 = $value ? new PageResource($value) : '';
                    break;
                case 13:
                    $aboutCompany->text_2 = $value ? new PageResource($value) : '';
                    break;
                case 14:
                    $aboutCompany->cityBlock = $value ? new PageResource($value) : '';
                    break;
                case 15:
                    $elevator->block = $value ? new PageResource($value) : '';
                    break;
                case 16:
                    $elevator->toSiteButton = $value ? new PageResource($value) : '';
                    break;
                case 17:
                    $exportGrain->backgroundImage = $value ? new PageResource($value) : '';
                    break;
                case 18:
                    $exportGrain->block = $value ? new PageResource($value) : '';
                    break;
                case 19:
                    $advantage->title = $value ? new PageResource($value) : '';
                    break;
                case 20:
                    $advantage->advantageBlocks[] = $value ? new PageResource($value) : '';
                    break;
                case 21:
                    $advantage->advantageBlocks[] = $value ? new PageResource($value) : '';
                    break;
                case 22:
                    $advantage->advantageBlocks[] = $value ? new PageResource($value) : '';
                    break;
                case 23:
                    $advantage->advantageBlocks[] = $value ? new PageResource($value) : '';
                    break;
                case 24:
                    $advantage->advantageBlocks[] = $value ? new PageResource($value) : '';
                    break;
                case 25:
                    $advantage->advantageBlocks[] = $value ? new PageResource($value) : '';
                    break;
                case 26:
                    $ourPartners->title = $value ? new PageResource($value) : '';
                    break;
                case 27:
                    $ourPartners->type_1->title = $value ? new PageResource($value) : '';
                    break;
                case 28:
                    $ourPartners->type_2->title = $value ? new PageResource($value) : '';
                    break;
                case 29:
                    $ourPartners->type_3->title = $value ? new PageResource($value) : '';
                    break;
            }
        }
        $ourPartners->type_1->partners = isset($type_1) ? $type_1 : [];
        $ourPartners->type_2->partners = isset($type_2) ? $type_2 : [];
        $ourPartners->type_3->partners = isset($type_3) ? $type_3 : [];

        $mainPageApi = new stdClass;
        $mainPageApi->banner = $banner;
        $mainPageApi->production = $production;
        $mainPageApi->aboutCompany = $aboutCompany;
        $mainPageApi->elevator = $elevator;
        $mainPageApi->exportGrain = $exportGrain;
        $mainPageApi->advantage = $advantage;
        $mainPageApi->ourPartners = $ourPartners;
        return $mainPageApi;
    }

    public function aboutUsPage ()
    {
        $aboutUsPageContent = AboutUsPage::query()->with('getTitle', 'getContent')->get();
        foreach ($aboutUsPageContent as $key => $value)
        {
            switch($key)
            {
                case 0:
                    $panel = $value ? new PageResource($value) : '';
                    break;
                case 1:
                    $aboutKassen = $value ? new PageResource($value) : '';
                    break;
                case 2:
                    $aboutAgroNan = $value ? new PageResource($value) : '';
                    break;
                case 3:
                    $aboutCompanies = $value ? new PageResource($value) : '';
                    break;
                case 4:
                    $triticum = $value ? new PageResource($value) : '';
                    break;
                case 5:
                    $barley = $value ? new PageResource($value) : '';
                    break;
            }
        }
        $aboutUsPageApi = new stdClass;
        $aboutUsPageApi->panel = $panel;
        $aboutUsPageApi->aboutKassen = $aboutKassen;
        $aboutUsPageApi->aboutAgroNan = $aboutAgroNan;
        $aboutUsPageApi->aboutCompanies = $aboutCompanies;
        $aboutUsPageApi->triticum = $triticum;
        $aboutUsPageApi->barley = $barley;
        return $aboutUsPageApi;
    }

    public function grainExportsPage ()
    {
        $grainExportsPageContent = GrainExportsPage::query()->with('getTitle', 'getContent')->get();
        $questions = new stdClass;
        $ourDirections = new stdClass;
        foreach ($grainExportsPageContent as $key => $value)
        {
            switch($key)
            {
                case 0:
                    $panel = $value ? new PageResource($value) : '';
                    break;
                case 1:
                    $questions->grainCollecting = $value ? new PageResource($value) : '';
                    break;
                case 2:
                    $questions->grainExport = $value ? new PageResource($value) : '';
                    break;
                case 3:
                    $ourDirections->title = $value ? new PageResource($value) : '';
                    break;
                case 4:
                    $ourDirections->direct = $value ? new PageResource($value) : '';
                    break;
            }
        }
        $grainExportsPageApi = new stdClass;
        $grainExportsPageApi->panel = $panel;
        $grainExportsPageApi->questions = $questions;
        $grainExportsPageApi->ourDirections = $ourDirections;
        return $grainExportsPageApi;
    }

    public function grainPurchasePage ()
    {
        $grainPurchasePageContent = GrainPurchasePage::query()->with('getTitle', 'getContent')->get();
        $workScheme = new stdClass;
        foreach ($grainPurchasePageContent as $key => $value)
        {
            switch($key)
            {
                case 0:
                    $panel = $value ? new PageResource($value) : '';
                    break;
                case 1:
                    $workScheme->title = $value ? new PageResource($value) : '';
                    break;
                case 2:
                    $workScheme->goodsPurchase = $value ? new PageResource($value) : '';
                    break;
                case 3:
                    $workScheme->grainStorage = $value ? new PageResource($value) : '';
                    break;
                case 4:
                    $workScheme->transportation = $value ? new PageResource($value) : '';
                    break;
                case 5:
                    $grainExports = $value ? new PageResource($value) : '';
                    break;
            }
        }
        $grainPurchasePageApi = new stdClass;
        $grainPurchasePageApi->panel = $panel;
        $grainPurchasePageApi->workScheme = $workScheme;
        $grainPurchasePageApi->grainExports = $grainExports;
        return $grainPurchasePageApi;
    }

    public function elevatorServicesPage ()
    {
        $elevatorServicesPageContent = ElevatorServicesPage::query()->with('getTitle', 'getContent')->get();
        $elevatorCompany = new stdClass;
        $elevatorCompany->statistic = new stdClass;
        foreach ($elevatorServicesPageContent as $key => $value)
        {
            switch($key)
            {
                case 0:
                    $panel = $value ? new PageResource($value) : '';
                    break;
                case 1:
                    $elevatorCompany->title = $value ? new PageResource($value) : '';
                    break;
                case 2:
                    $elevatorCompany->points[] = $value ? new PageResource($value) : '';
                    break;
                case 3:
                    $elevatorCompany->points[] = $value ? new PageResource($value) : '';
                    break;
                case 4:
                    $elevatorCompany->points[] = $value ? new PageResource($value) : '';
                    break;
                case 5:
                    $elevatorCompany->points[] = $value ? new PageResource($value) : '';
                    break;
                case 6:
                    $elevatorCompany->points[] = $value ? new PageResource($value) : '';
                    break;
                case 7:
                    $elevatorCompany->points[] = $value ? new PageResource($value) : '';
                    break;
                case 8:
                    $elevatorCompany->points[] = $value ? new PageResource($value) : '';
                    break;
                case 9:
                    $elevatorCompany->points[] = $value ? new PageResource($value) : '';
                    break;
                case 10:
                    $elevatorCompany->aboutBlock = $value ? new PageResource($value) : '';
                    break;
                case 11:
                    $elevatorCompany->goToSiteButton = $value ? new PageResource($value) : '';
                    break;
                case 12:
                    $elevatorCompany->statistic->title = $value ? new PageResource($value) : '';
                    break;
                case 13:
                    $elevatorCompany->statistic->years[] = $value ? new PageResource($value) : '';
                    break;
                case 14:
                    $elevatorCompany->statistic->years[] = $value ? new PageResource($value) : '';
                    break;
                case 15:
                    $elevatorCompany->statistic->years[] = $value ? new PageResource($value) : '';
                    break;
                case 16:
                    $elevatorCompany->statistic->years[] = $value ? new PageResource($value) : '';
                    break;
                case 17:
                    $productionCharacteristics = $value ? new PageResource($value) : '';
                    break;
            }
        }
        $elevatorServicesPageApi = new stdClass;
        $elevatorServicesPageApi->panel = $panel;
        $elevatorServicesPageApi->elevatorCompany = $elevatorCompany;
        $elevatorServicesPageApi->productionCharacteristics = $productionCharacteristics;
        return $elevatorServicesPageApi;
    }

    public function contactsPage ()
    {
        $contactsPageContent = ContactsPage::query()->with('getTitle', 'getContent')->get();
        $contacts = new stdClass;
        foreach ($contactsPageContent as $key => $value)
        {
            switch($key)
            {
                case 0:
                    $panel = $value ? new PageResource($value) : '';
                    break;
                case 1:
                    $title = $value ? new PageResource($value) : '';
                    break;
                case 2:
                    $contacts->director = $value ? new PageResource($value) : '';
                    break;
                case 3:
                    $contacts->deputyDirector_1 = $value ? new PageResource($value) : '';
                    break;
                case 4:
                    $contacts->deputyDirector_2 = $value ? new PageResource($value) : '';
                    break;
                case 5:
                    $contacts->email = $value ? new PageResource($value) : '';
                    break;
                case 6:
                    $contacts->reception = $value ? new PageResource($value) : '';
                    break;
                case 7:
                    $contacts->salesDepartment = $value ? new PageResource($value) : '';
                    break;
            }
        }
        $contactsPageApi = new stdClass;
        $contactsPageApi->panel = $panel;
        $contactsPageApi->title = $title;
        $contactsPageApi->contacts = $contacts;
        return $contactsPageApi;
    }

    public function header ()
    {
        $logo = Logo::first();
        $headerApi = new stdClass;
        $headerApi->logo = $logo ? new LogoResource($logo) : '';
        $headerApi->navbar = $this->navbar();
        return $headerApi;
    }

    public function footer ()
    {
        $forms = new stdClass;
        $forms->application = $this->applicationFormContent();
        $forms->subscription = $this->subscriptionFormContent();
        $footerApi = new stdClass;
        $footerApi->forms = $forms;
        $footerApi->navbar = $this->navbar();
        $footerApi->contacts = $this->footerContacts();
        return $footerApi;
    }
}
