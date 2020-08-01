<?php

use Illuminate\Database\Seeder;
use Modules\Backend\Entities\Setting;

class SettingSeeder extends Seeder
{
    protected $settings = [
        //site general details
        [
            'key'                       =>  'site_title',
            'value'                     =>  'Daruuri',
        ],
        [
            'key'                       =>  'email_address',
            'value'                     =>  'kylife.bd@gmail.com',
        ],
        [
            'key'                       =>  'contact_number',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'contact_address',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'google_map_iframe',
            'value'                     =>  '',
        ],

        //site logo & favicon

        [
            'key'                       =>  'site_logo',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'site_favicon',
            'value'                     =>  '',
        ],

        //footer & seo details
        [
            'key'                       =>  'footer_copyright_text',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'footer_description',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'seo_meta_title',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'seo_meta_description',
            'value'                     =>  '',
        ],

       
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::insert($this->settings);
    }
}
