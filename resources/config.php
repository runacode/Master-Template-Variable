<?php

KformConfig::setConfig(array(
    "isWordpress" => false,
    "apiLoginId" => "os_api",
    "apiPassword" => 'p@$$w0rd123123',
   "authString"=>"48b85251948d21097c7880cf0fbc948a",
	"autoUpdate_allowedIps"=>array("80.248.30.133"),
	"campaignId"=>7,
	"resourceDir"=>"resources/"));




/* 
!---------------------------------IMPORTANT-----------------------------------!

Documentation:
	
	-Full documentation on landing pages can be found at 

Auto-Update Feature:

	-The auto-update feature will automatically update settings on your landing page
	when you make changes to your campaign within the konnektive CRM. Use this feature
	to keep your landing page up-to-date concerning new coupons / shipping options
	and product changes.

	-To use the campaign auto-update feature, the apache or ngix user 
	(depending on your httpd software) must have write access to this file
	
	-If you are not using the auto-update feature, you will need to manually 
	replace this file after making changes to the campaign	
	
!---------------------------------IMPORTANT-----------------------------------!
*/

class KFormConfig
{
	
	public $isWordpress = false;
	public $apiLoginId = '';
	public $apiPassword = '';
	public $resourceDir;
	public $baseDir;
	
	
	public $mobileRedirectUrl;
	public $desktopRedirectUrl;
	
	
	public $continents;
	public $countries;
	public $coupons;
	public $currencySymbol;
	public $insureShipPrice;
	public $landerType;
	public $offers;
	public $upsells;
	public $products;
	public $shipProfiles;
	public $states;
	public $taxes;
	public $termsOfService;
	public $webPages;
	
	static $instance = NULL;
	static $options;
	static $campaignData;
	// class constructor to set the variable values	
	
	static function setConfig($options)
	{
		self::$options = $options;	
	}
	
	public function __construct()
	{
		if(!empty(self::$instance))
			throw new Exception("cannot recreated KFormConfig");
		
		foreach((array) self::$options as $k=>$v)
			$this->$k = $v;
			
		if($this->isWordpress)
		{
			$options = get_option('konnek_options');
			foreach((array)$options as $k=>$v)
				$this->$k = $v;
		
			$data = json_decode(get_option('konnek_campaign_data'));
			foreach($data as $k=>$v)
				$this->$k = $v;
		}
		elseif(!empty(self::$campaignData))
		{
			if(json_decode(self::$campaignData) === NULL)
			{
				echo 'JSON in config.php is broken!';
				die;
			}
			else
				$data = (array)json_decode(self::$campaignData);


			foreach($data as $k=>$v)
				$this->$k = $v;
		}

		self::$instance = $this;
		
	
	}
}

/* 
!---------------------------------IMPORTANT-----------------------------------!

	ABSOLUTELY DO NOT EDIT BELOW THIS LINE
	
!---------------------------------IMPORTANT-----------------------------------!
*/
$requestUri = $_SERVER['REQUEST_URI'];
$baseFile = basename(__FILE__);

if($_SERVER['REQUEST_METHOD']=='POST' && strstr($requestUri,$baseFile))
{
	
	$authString = filter_input(INPUT_POST,'authString',FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
	if(empty($authString))
		die(); //exit silently, don't want people to know that this file processes api requests if they are just sending random posts at it
	
	
	$remoteIp = $_SERVER['REMOTE_ADDR'];
	if (isset($_SERVER["HTTP_CF_CONNECTING_IP"]))
		  $remoteIp =  $_SERVER["HTTP_CF_CONNECTING_IP"];
	
	$allowedIps = KFormConfig::$options['autoUpdate_allowedIps'];
	if(!in_array($remoteIp,$allowedIps))
		die("ERROR: Invalid IP Address. Please confirm that the Konnektive IP Address is in the allowedIps array.");
	if($authString != KFormConfig::$options['authString'])
		die("ERROR: Could not authenticate authString. Please re-download code package and replace config file on your server.");

	$data = filter_input(INPUT_POST,'data');
	$data = trim($data);
	$data = utf8_encode($data);
	$decoded = json_decode($data);
	if($decoded != NULL)
	{
		$file = fopen(__FILE__,'r');
		if(empty($file))
			die("ERROR: File not writable");

		$new_file = '';

		while($line = fgets($file))
		{
			$new_file .= $line;

			if(strpos($line,"/*[DYNAMIC-DATA-TOKEN]") === 0)
				break;
		}
		fclose($file);

		$new_file .= "KFormConfig::\$campaignData = '$data';".PHP_EOL;
		$ret = file_put_contents(__FILE__,$new_file);


		if(is_int($ret))
			die("SUCCESS");
		else
			die("ERROR: File not writable");
	}
	else
	{
		die("ERROR: what data");
	}
}

/*[DYNAMIC-DATA-TOKEN] do not remove */

KFormConfig::$campaignData = '{
    "countries": {
        "US": "United States"
    },
    "states": {
        "US": {
            "AL": "Alabama",
            "AK": "Alaska",
            "AZ": "Arizona",
            "AR": "Arkansas",
            "CA": "California",
            "CO": "Colorado",
            "CT": "Connecticut",
            "DE": "Delaware",
            "DC": "District of Columbia",
            "FL": "Florida",
            "GA": "Georgia",
            "HI": "Hawaii",
            "ID": "Idaho",
            "IL": "Illinois",
            "IN": "Indiana",
            "IA": "Iowa",
            "KS": "Kansas",
            "KY": "Kentucky",
            "LA": "Louisiana",
            "ME": "Maine",
            "MD": "Maryland",
            "MA": "Massachusetts",
            "MI": "Michigan",
            "MN": "Minnesota",
            "MS": "Mississippi",
            "MO": "Missouri",
            "MT": "Montana",
            "NE": "Nebraska",
            "NV": "Nevada",
            "NH": "New Hampshire",
            "NJ": "New Jersey",
            "NM": "New Mexico",
            "NY": "New York",
            "NC": "North Carolina",
            "ND": "North Dakota",
            "OH": "Ohio",
            "OK": "Oklahoma",
            "OR": "Oregon",
            "PA": "Pennsylvania",
            "RI": "Rhode Island",
            "SC": "South Carolina",
            "SD": "South Dakota",
            "TN": "Tennessee",
            "TX": "Texas",
            "UT": "Utah",
            "VT": "Vermont",
            "VA": "Virginia",
            "WA": "Washington",
            "WV": "West Virginia",
            "WI": "Wisconsin",
            "WY": "Wyoming",
            "AS": "American Samoa",
            "FM": "Federated States of Micronesia",
            "GU": "Guam",
            "MP": "Northern Mariana Islands",
            "PR": "Puerto Rico",
            "MH": "Republic of Marshall Islands",
            "VI": "Virgin Islands of the U.S.",
            "AE": "Armed Forces Middle East",
            "AA": "Armed Forces Americas",
            "AP": "Armed Forces Pacific"
        }
    },
    "currencySymbol": "$",
    "shipOptions": [],
    "coupons": [],
    "products": [],
     "webPages": {
        "catalogPage": {
            "disableBack": 0,
            "url": "https:\/\/www.woweyelashserum.com\/"
        },
        "checkoutPage": {
            "disableBack": 0,
            "url": "https:\/\/www.woweyelashserum.com\/checkout.php",
            "autoImportLead": 1,
            "productId": null,
            "requireSig": 0,
            "sigType": 0,
            "cardinalAuth": 0,
            "paayApiKey": null
        },
        "thankyouPage": {
            "disableBack": 0,
            "url": "https:\/\/www.woweyelashserum.com\/thankyou.php",
            "createAccountDialog": 0,
            "reorderUrl": null,
            "allowReorder": 0
        },
        "upsellPage1": {
            "disableBack": 1,
            "url": "https:\/\/www.woweyelashserum.com\/upsell1.php",
            "createAccountDialog": 0,
            "requirePayInfo": 0,
            "productId": 22,
            "replaceProductId": null
        },
        "upsellPage2": {
            "disableBack": 1,
            "url": "https:\/\/www.woweyelashserum.com\/upsell2.php",
            "createAccountDialog": 0,
            "requirePayInfo": 0,
            "productId": 21,
            "replaceProductId": null
        },
        "upsellPage3": {
            "disableBack": 1,
            "url": "https:\/\/www.woweyelashserum.com\/upsell3.php",
            "createAccountDialog": 0,
            "requirePayInfo": 0,
            "productId": 23,
            "replaceProductId": null
        },
        "productDetails": {
            "url": "product-details.php"
        }
    },
    "landerType": "CART",
    "googleTrackingId": "UA-156009617-3",
    "enableFraudPlugin": 0,
    "autoTax": 0,
    "taxServiceId": null,
    "companyName": "optin_solutions_llc",
    "offers": {
        "19": {
            "productId": 19,
            "name": "Feg Serum - Eyelash Enhancer",
            "description": "*No description available",
            "imagePath": "https:\/\/www.woweyelashserum.com\/resources\/images\/smain-small.jpg",
            "imageId": 1,
            "price": "11.97",
            "shipPrice": "0.00",
            "category": "FEG"
        },
        "20": {
            "productId": 20,
            "name": "Feg Serum - Eyelash Enhancer - Free",
            "description": "*No description available",
            "imagePath": "https:\/\/www.woweyelashserum.com\/resources\/images\/smain-small.jpg",
            "imageId": 1,
            "price": "0.00",
            "shipPrice": "0.00",
            "category": "FEG"
        }
    },
    "upsells": {
        "21": {
            "productId": 21,
            "name": "Feg Serum - Eyelash Enhancer - Free Gift",
            "description": "*No description available",
            "imagePath": "https:\/\/www.woweyelashserum.com\/resources\/images\/upsell1.jpg",
            "imageId": 1,
            "price": "4.95",
            "shipPrice": "0.00",
            "category": "FEG"
        },
        "22": {
            "productId": 22,
            "name": "FEG - EyeBrown (2pcs - 2 months of treatment)",
            "description": "*No description available",
            "imagePath": "https:\/\/www.woweyelashserum.com\/resources\/images\/upsell2.jpg",
            "imageId": 2,
            "price": "9.95",
            "shipPrice": "0.00",
            "category": "FEG"
        },
        "23": {
            "productId": 23,
            "name": "Silicone Make-Up Sponge",
            "description": "*No description available",
            "imagePath": "https:\/\/www.woweyelashserum.com\/resources\/images\/upsell3.jpg",
            "imageId": 3,
            "price": "4.95",
            "shipPrice": "0.00",
            "category": "FEG"
        }
    },
    "shipProfiles": [],
    "continents": {
        "US": "NA"
    },
    "paypal": {
        "paypalBillerId": 6
    }
}';