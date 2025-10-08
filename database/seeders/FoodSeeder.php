<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    public function run()
    {
        $foods = [
            [
                'name' => 'گوشت قرمز',
                'allowed_units' => ['گرم',],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                ]
            ],
            [
                'name' => 'گوشت مرغ',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                ]
            ],
            [
                'name' => 'ماهی',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                ]
            ],
            [
                'name' => 'سوسیس',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                ]
            ],
            [
                'name' => 'کالباس',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                    'تکه' => ['min' => 1, 'max' => 10]
                ]
            ],

            [
                'name' => 'هویج',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                ]
            ],
            [
                'name' => 'سیب زمینی',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                ]
            ],
            [
                'name' => 'گوجه فرنگی',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                ]
            ],
            [
                'name' => 'خیار',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                ]
            ],
            [
                'name' => 'کاهو',
                'allowed_units' => ['گرم', 'برگ'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                    'برگ' => ['min' => 1, 'max' => 10],
                ]
            ],
            [
                'name' => 'کلم',
                'allowed_units' => ['گرم', 'برگ'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                    'برگ' => ['min' => 1, 'max' => 20]
                ]
            ],
            [
                'name' => 'فلفل دلمه‌ای',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                ]
            ],
            [
                'name' => 'بادمجان',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                ]
            ],
            [
                'name' => 'پیاز',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                ]
            ],
            [
                'name' => 'سیر',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                ]
            ],

            [
                'name' => 'سیب',
                'allowed_units' => ['گرم', 'تعداد'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                    'تعداد' => ['min' => 1, 'max' => 10],
                ]
            ],
            [
                'name' => 'موز',
                'allowed_units' => ['گرم', 'تعداد'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                    'تعداد' => ['min' => 1, 'max' => 10],
                ]
            ],
            [
                'name' => 'پرتقال',
                'allowed_units' => ['گرم', 'تعداد'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                    'تعداد' => ['min' => 1, 'max' => 10],
                ]
            ],
            [
                'name' => 'انگور',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                ]
            ],
            [
                'name' => 'توت فرنگی',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                ]
            ],
            [
                'name' => 'کیوی',
                'allowed_units' => ['گرم', 'تعداد'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                    'تعداد' => ['min' => 1, 'max' => 10],

                ]
            ],
            [
                'name' => 'آناناس',
                'allowed_units' => ['گرم', 'تعداد'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                    'تعداد' => ['min' => 1, 'max' => 10],

                ]
            ],

            [
                'name' => 'نان',
                'allowed_units' => ['گرم', 'تکه', 'برش'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 500],
                    'تکه' => ['min' => 1, 'max' => 20],
                    'برش' => ['min' => 1, 'max' => 20]
                ]
            ],
            [
                'name' => 'برنج',
                'allowed_units' => ['گرم', 'لیوان', 'قاشق غذاخوری'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                    'لیوان' => ['min' => 1, 'max' => 10],
                    'قاشق غذاخوری' => ['min' => 1, 'max' => 100]
                ]
            ],
            [
                'name' => 'پاستا',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                ]
            ],
            [
                'name' => 'جو',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                ]
            ],
            [
                'name' => 'کیک',
                'allowed_units' => ['گرم', 'تکه'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                    'تکه' => ['min' => 1, 'max' => 20]
                ]
            ],
            [
                'name' => 'بیسکویت',
                'allowed_units' => ['گرم', 'تکه'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 500],
                    'تکه' => ['min' => 1, 'max' => 100]
                ]
            ],

            [
                'name' => 'آب',
                'allowed_units' => ['میلی‌لیتر', 'لیوان'],
                'unit_limits' => [
                    'میلی‌لیتر' => ['min' => 1, 'max' => 5000],
                    'لیوان' => ['min' => 1, 'max' => 20]
                ]
            ],
            [
                'name' => 'شیر',
                'allowed_units' => ['میلی‌لیتر', 'لیوان'],
                'unit_limits' => [
                    'میلی‌لیتر' => ['min' => 1, 'max' => 2000],
                    'لیوان' => ['min' => 1, 'max' => 10]
                ]
            ],
            [
                'name' => 'آب سیب',
                'allowed_units' => ['میلی‌لیتر', 'لیوان'],
                'unit_limits' => [
                    'میلی‌لیتر' => ['min' => 1, 'max' => 2000],
                    'لیوان' => ['min' => 1, 'max' => 10]
                ]
            ],
            [
                'name' => 'آب پرتقال',
                'allowed_units' => ['میلی‌لیتر', 'لیوان'],
                'unit_limits' => [
                    'میلی‌لیتر' => ['min' => 1, 'max' => 2000],
                    'لیوان' => ['min' => 1, 'max' => 10]
                ]
            ],
            [
                'name' => 'چای',
                'allowed_units' => ['میلی‌لیتر', 'لیوان', 'فنجان'],
                'unit_limits' => [
                    'میلی‌لیتر' => ['min' => 1, 'max' => 1000],
                    'لیوان' => ['min' => 1, 'max' => 5],
                    'فنجان' => ['min' => 1, 'max' => 5]
                ]
            ],
            [
                'name' => 'قهوه',
                'allowed_units' => ['میلی‌لیتر', 'لیوان', 'فنجان'],
                'unit_limits' => [
                    'میلی‌لیتر' => ['min' => 1, 'max' => 1000],
                    'لیوان' => ['min' => 1, 'max' => 5],
                    'فنجان' => ['min' => 1, 'max' => 5]
                ]
            ],
            [
                'name' => 'نوشابه',
                'allowed_units' => ['میلی‌لیتر', 'لیوان', 'قوطی'],
                'unit_limits' => [
                    'میلی‌لیتر' => ['min' => 1, 'max' => 2000],
                    'لیوان' => ['min' => 1, 'max' => 10],
                    'قوطی' => ['min' => 1, 'max' => 10]
                ]
            ],
            [
                'name' => 'دوغ',
                'allowed_units' => ['میلی‌لیتر', 'لیوان'],
                'unit_limits' => [
                    'میلی‌لیتر' => ['min' => 1, 'max' => 2000],
                    'لیوان' => ['min' => 1, 'max' => 10]
                ]
            ],
            [
                'name' => 'کفیر',
                'allowed_units' => ['میلی‌لیتر', 'لیوان'],
                'unit_limits' => [
                    'میلی‌لیتر' => ['min' => 1, 'max' => 1000],
                    'لیوان' => ['min' => 1, 'max' => 5]
                ]
            ],
            [
                'name' => 'آبمیوه',
                'allowed_units' => ['میلی‌لیتر', 'لیوان'],
                'unit_limits' => [
                    'میلی‌لیتر' => ['min' => 1, 'max' => 2000],
                    'لیوان' => ['min' => 1, 'max' => 10]
                ]
            ],

            [
                'name' => 'پنیر',
                'allowed_units' => ['گرم', 'تکه'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 500],
                    'تکه' => ['min' => 1, 'max' => 20]
                ]
            ],
            [
                'name' => 'ماست',
                'allowed_units' => ['گرم', 'قاشق غذاخوری'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                    'قاشق غذاخوری' => ['min' => 1, 'max' => 100]
                ]
            ],
            [
                'name' => 'کره',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 500],
                ]
            ],
            [
                'name' => 'پنیر خامه‌ای',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 500],
                ]
            ],
            [
                'name' => 'دوغ',
                'allowed_units' => ['گرم', 'لیوان'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                    'لیوان' => ['min' => 1, 'max' => 10]
                ]
            ],

            [
                'name' => 'لوبیا',
                'allowed_units' => ['گرم', 'لیوان', 'قاشق غذاخوری'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                    'لیوان' => ['min' => 1, 'max' => 10],
                    'قاشق غذاخوری' => ['min' => 1, 'max' => 100]
                ]
            ],
            [
                'name' => 'عدس',
                'allowed_units' => ['گرم', 'لیوان', 'قاشق غذاخوری'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                    'لیوان' => ['min' => 1, 'max' => 10],
                    'قاشق غذاخوری' => ['min' => 1, 'max' => 100]
                ]
            ],
            [
                'name' => 'نخود',
                'allowed_units' => ['گرم', 'لیوان', 'قاشق غذاخوری'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                    'لیوان' => ['min' => 1, 'max' => 10],
                    'قاشق غذاخوری' => ['min' => 1, 'max' => 100]
                ]
            ],
            [
                'name' => 'لپه',
                'allowed_units' => ['گرم', 'لیوان', 'قاشق غذاخوری'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 1000],
                    'لیوان' => ['min' => 1, 'max' => 10],
                    'قاشق غذاخوری' => ['min' => 1, 'max' => 100]
                ]
            ],

            [
                'name' => 'بادام',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 500],
                ]
            ],
            [
                'name' => 'پسته',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 500],
                ]
            ],
            [
                'name' => 'گردو',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 500],
                ]
            ],
            [
                'name' => 'فندق',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 500],
                ]
            ],
            [
                'name' => 'تخمه آفتابگردان',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 500],
                ]
            ],
            [
                'name' => 'تخمه کدو',
                'allowed_units' => ['گرم'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 500],
                ]
            ],
            [
                'name' => 'کنجد',
                'allowed_units' => ['گرم', 'قاشق غذاخوری'],
                'unit_limits' => [
                    'گرم' => ['min' => 1, 'max' => 500],
                    'قاشق غذاخوری' => ['min' => 1, 'max' => 50]
                ]
            ],
        ];

        foreach ($foods as $food) {
            Food::create($food);
        }
    }
}
